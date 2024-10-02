<?php

namespace CyanPlugin\Admin;

class GithubUpdater {
	private $file;
	private $plugin;
	private $basename;
	private $active;

	public function __construct( $file ) {
		$this->file = $file;


		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}


		$this->plugin = get_plugin_data( $this->file );
		$this->basename = plugin_basename( $this->file );
		$this->active = is_plugin_active( $this->basename );

		add_filter( 'pre_set_site_transient_update_plugins', [ $this, 'check_for_update' ] );
		add_filter( 'plugins_api', [ $this, 'plugins_api_call' ], 10, 3 );
		add_filter( 'upgrader_post_install', [ $this, 'after_install' ], 10, 3 );
	}

	public function check_for_update( $transient ) {


		if ( empty( $transient->checked ) ) {
			return $transient;
		}

		// GitHub API URL
		$remote = wp_remote_get( 'https://api.github.com/repos/cyandm/cyan-plugin/releases/latest' );


		if ( ! is_wp_error( $remote ) ) {
			$remote = json_decode( wp_remote_retrieve_body( $remote ) );
			if ( $remote && version_compare( $this->plugin['Version'], $remote->tag_name, '<' ) ) {
				$response = new \stdClass();
				$response->slug = $this->basename;
				$response->new_version = $remote->tag_name;
				$response->package = $remote->zipball_url;
				$transient->response[ $this->basename ] = $response;
			}
		}

		return $transient;
	}

	public function plugins_api_call( $false, $action, $response ) {
		if ( is_object( $response ) && isset( $response->slug ) && $response->slug === $this->basename ) {
			$remote = wp_remote_get( 'https://api.github.com/repos/cyandm/cyan-plugin' );

			if ( ! is_wp_error( $remote ) ) {
				$remote_body = wp_remote_retrieve_body( $remote );
				$remote_data = json_decode( $remote_body );

				if ( isset( $remote_data->tag_name ) && isset( $remote_data->zipball_url ) ) {
					$response->new_version = $remote_data->tag_name;
					$response->package = $remote_data->zipball_url;
				} else {
					error_log( 'Invalid response structure from GitHub API' );
				}
			} else {
				error_log( 'Error fetching data from GitHub: ' . $remote->get_error_message() );
			}
		}

		return $response;
	}

	public function after_install( $response, $hook_extra, $result ) {
		global $wp_filesystem;
		$install_dir = plugin_dir_path( $this->file );
		$wp_filesystem->move( $result['destination'], $install_dir );
		$result['destination'] = $install_dir;

		if ( $this->active ) {
			activate_plugin( $this->basename );
		}

		return $result;
	}
}

