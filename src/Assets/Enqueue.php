<?php

namespace CyanPlugin\Assets;

class Enqueue {

	private $css_file_name, $js_file_name;

	public function __construct() {
		$this->css_file_name = CYAN_PLUGIN_DEPLOY ? 'style.min.css' : 'style.css';
		$this->js_file_name = CYAN_PLUGIN_DEPLOY ? 'bundle.min.js' : 'bundle.js';
	}

	public function register() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_client_css' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_css' ] );

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_client_js' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_js' ] );

	}

	public function enqueue_client_css() {
		wp_enqueue_style( 'cyan-plugin-style', CYAN_PLUGIN_ASSETS . '/css/client/' . $this->css_file_name, [], CYAN_PLUGIN_VERSION );
	}

	public function enqueue_admin_css() {
		wp_enqueue_style( 'cyan-plugin-style', CYAN_PLUGIN_ASSETS . '/css/admin/' . $this->css_file_name, [], CYAN_PLUGIN_VERSION );
	}

	public function enqueue_client_js() {
		wp_enqueue_script( 'cyan-plugin-script', CYAN_PLUGIN_ASSETS . '/js/client/' . $this->js_file_name, [ 'jquery' ], CYAN_PLUGIN_VERSION, true );
	}

	public function enqueue_admin_js() {
		wp_enqueue_script( 'cyan-plugin-script', CYAN_PLUGIN_ASSETS . '/js/admin/' . $this->js_file_name, [ 'jquery' ], CYAN_PLUGIN_VERSION, true );
	}
}