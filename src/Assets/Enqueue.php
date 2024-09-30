<?php

namespace CyanPlugin\Assets;

class Enqueue {

	private $css_file_name, $js_file_name;

	public function __construct() {
		$this->css_file_name = CYAN_PLUGIN_DEPLOY ? 'style.min.css' : 'style.css';
		$this->js_file_name = CYAN_PLUGIN_DEPLOY ? 'bundle.js' : 'script.js';
	}

	public function register() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_css' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_js' ] );
	}

	public function enqueue_css() {
		wp_enqueue_style( 'cyan-plugin-style', CYAN_PLUGIN_ASSETS . '/css/' . $this->css_file_name, [], CYAN_PLUGIN_VERSION );
	}

	public function enqueue_js() {
		wp_enqueue_script( 'cyan-plugin-script', CYAN_PLUGIN_ASSETS . '/js/' . $this->js_file_name, [ 'jquery' ], CYAN_PLUGIN_VERSION, true );
	}
}