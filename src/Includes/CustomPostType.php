<?php

namespace CyanPlugin\Includes;

class CustomPostType {
	public function register() {
		add_action( 'init', [ $this, 'create_custom_cta_post_type' ] );
	}

	public function create_custom_cta_post_type() {
		$labels = [ 
			'name' => 'CTA ها',
			'singular_name' => 'CTA',
			'menu_name' => 'CTA ها',
			'name_admin_bar' => 'CTA',
			'add_new' => 'اضافه کردن جدید',
			'add_new_item' => 'اضافه کردن CTA جدید',
			'new_item' => 'CTA جدید',
			'edit_item' => 'ویرایش CTA',
			'view_item' => 'مشاهده CTA',
			'all_items' => 'تمام CTA ها',
			'search_items' => 'جستجوی CTA ها',
			'not_found' => 'هیچ CTA یافت نشد',
			'not_found_in_trash' => 'هیچ CTA در سطل زباله یافت نشد',
		];

		$args = [ 
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => [ 'slug' => 'cta' ],
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => null,
			'exclude_from_search' => true,
			'supports' => [ 'title' ],
		];

		register_post_type( 'cta', $args );
	}
}