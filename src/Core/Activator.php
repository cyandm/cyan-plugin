<?php

namespace CyanPlugin\Core;

class Activator {
	public function register() {
		register_activation_hook( __FILE__, [ $this, 'activate' ] );
	}

	public function activate() {
		add_option( 'cyan_plugin_option', 'default value' );
	}
}