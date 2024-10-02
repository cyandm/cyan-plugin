<?php

namespace CyanPlugin\ACF;


class ACFFieldRegistrar {

	private $acfField;

	public function __construct() {
		$this->acfField = new ACFField;
	}

	public function register() {
		add_action( 'acf/init', [ $this, 'registerFields' ] );
	}

	public function registerFields() {
		$this->CtaPostType();
	}

	private function CtaPostType() {

		$fields = [ 
			$this->acfField->createLinkField( 'cta_link', 'لینک کال تو اکشن' ),
			$this->acfField->createImageField( 'cta_desktop_image', 'تصویر کال تو اکشن در دسکتاپ' ),
			$this->acfField->createImageField( 'cta_mobile_image', 'تصویر کال تو اکشن در موبایل' ),
		];


		$location = [ 
			[ 
				$this->acfField->getPostTypeLocation( 'cta' ),
			]
		];


		$this->acfField->registerLocalGroup( 'تنظیمات', $fields, $location );
	}
}