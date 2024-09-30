<?php

namespace CyanPlugin\Frontend;

class Shortcodes {
	public function register() {
		add_shortcode( 'cyan_items', [ $this, 'display_items' ] );
	}

	public function display_items() {
		$items = [ 'Item 1', 'Item 2', 'Item 3' ];
		$output = '<ul>';
		foreach ( $items as $item ) {
			$output .= '<li>' . esc_html( $item ) . '</li>';
		}
		$output .= '</ul>';
		return $output;
	}
}