<?php

namespace CyanPlugin\Includes;

class Columns {

	public function register() {
		add_filter( 'manage_cta_posts_columns', [ $this, 'add_custom_column' ] );
		add_action( 'manage_cta_posts_custom_column', [ $this, 'custom_column_content' ], 10, 2 );
	}

	// اضافه کردن ستون جدید
	public function add_custom_column( $columns ) {
		$columns = [ 
			'title' => 'عنوان',
			'shortcode' => 'شورت کد'
		];
		return $columns;
	}

	// مقداردهی به ستون
	public function custom_column_content( $column, $post_id ) {
		if ( 'shortcode' === $column ) {
			include_once CYAN_PLUGIN_TEMPLATES . '/admin/cta-shortcode.php';
		}
	}
}