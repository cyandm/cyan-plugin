<?php

namespace CyanPlugin\Admin;

class AdminMenu {
	public function register() {
		add_action( 'admin_menu', [ $this, 'add_admin_pages' ] );
	}

	public function add_admin_pages() {
		add_menu_page(
			'CyanPlugin',
			'Cyan Plugin',
			'manage_options',
			'cyan_plugin',
			[ $this, 'admin_index' ],
			'dashicons-admin-generic',
			110
		);
	}

	public function admin_index() {
		require_once CYAN_PLUGIN_TEMPLATES . '/admin.php';
	}
}