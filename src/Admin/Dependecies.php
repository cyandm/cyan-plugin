<?php

namespace CyanPlugin\Admin;

class Dependecies {

	// آرایه‌ای از پلاگین‌های وابسته
	private $required_plugins = [ 
		'advanced-custom-fields/acf.php', // ACF

	];

	public function __construct() {
		register_activation_hook( 'CYAN_PLUGIN_DIR', [ $this, 'check_dependencies' ] );
		add_action( 'init', [ $this, 'check_dependencies' ] );
		add_action( 'admin_notices', [ $this, 'display_admin_notice' ] );
	}

	public function check_dependencies() {
		// وارد کردن توابع پلاگین
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		$missing_plugins = [];

		foreach ( $this->required_plugins as $plugin ) {
			// بررسی اینکه آیا هر پلاگین وابسته فعال است
			if ( ! is_plugin_active( $plugin ) ) {
				$missing_plugins[] = $plugin;
			}
		}

		// اگر پلاگینی غیرفعال باشد، نوتیفیکیشن را نشان بده
		if ( ! empty( $missing_plugins ) ) {
			add_option( 'cyan_plugin_missing_plugins', $missing_plugins );
		}
	}

	public function display_admin_notice() {
		$missing_plugins = get_option( 'cyan_plugin_missing_plugins' );

		if ( ! empty( $missing_plugins ) ) {

			$install_url = admin_url( 'plugin-install.php' );

			echo '<div class="notice notice-error is-dismissible">';
			echo '<p>' . __( 'پلاگین سایان به پلاگین‌های وابسته نیاز دارد که نصب و فعال باشند:', 'cyan-plugin' ) . '</p>';
			echo '<ul>';

			foreach ( $missing_plugins as $plugin ) {
				echo '<li>' . esc_html( $plugin ) . ' <a href="' . esc_url( $install_url ) . '">' . __( '(نصب پلاگین)', 'cyan-plugin' ) . '</a></li>';
			}

			echo '</ul>';
			echo '</div>';

			// حذف گزینه پس از نمایش نوتیفیکیشن
			delete_option( 'cyan_plugin_missing_plugins' );
		}
	}
}