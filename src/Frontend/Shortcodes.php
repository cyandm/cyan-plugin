<?php

namespace CyanPlugin\Frontend;

class Shortcodes {
	public function register() {
		add_shortcode( 'cyan_cta', [ $this, 'display_cta' ] );
	}

	public function display_cta( $args ) {
		cp_get_template( 'client', 'display-cta', $args );
	}
}