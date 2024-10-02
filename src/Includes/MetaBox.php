<?php

namespace CyanPlugin\Includes;

class MetaBox {

	public function register() {
		add_action( 'add_meta_boxes', [ $this, 'addCTAShortcodeMetaBox' ] );
	}

	public function addCTAShortcodeMetaBox() {
		add_meta_box(
			'cta_shortcode_meta_box', // ID متاباکس
			'CTA شورت کد', // عنوان متاباکس
			[ $this, 'renderCTAShortcodeMetaBox' ], // تابع برای نمایش محتوا
			'cta', // نوع پست
			'side', // موقعیت
			'high' // اولویت
		);
	}

	public function renderCTAShortcodeMetaBox( $post ) {
		include_once CYAN_PLUGIN_TEMPLATES . '/admin/cta-shortcode.php';
	}

}