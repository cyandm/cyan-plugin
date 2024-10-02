<?php

namespace CyanPlugin\ACF;

class ACFField {

	public function registerLocalGroup( $title, $fields, $location ) {
		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group( [ 
				'key' => uniqid( 'group_', true ),
				'title' => $title,
				'fields' => $fields,
				'location' => $location,
			] );
		}
	}

	public function createTextField( $name, $label, $instructions = '', $placeholder = '', $required = 0 ) {
		return [ 
			'key' => 'field_' . $name,
			'label' => $label,
			'name' => $name,
			'type' => 'text',
			'instructions' => $instructions,
			'required' => $required,
			'default_value' => '',
			'placeholder' => $placeholder,
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
			'conditional_logic' => 0,
		];
	}

	public function createLinkField( $name, $label, $return_format = 'array', $instructions = '', $required = 0 ) {
		return [ 
			'key' => 'field_' . $name,
			'label' => $label,
			'name' => $name,
			'type' => 'link',
			'instructions' => $instructions,
			'required' => $required,
			'default_value' => [ 
				'url' => '',
				'title' => '',
				'target' => '_self',
			],
			'return_format' => $return_format, // می‌توانید 'array' یا 'url' را انتخاب کنید
		];
	}

	public function createImageField( $name, $label, $return_format = 'id', $instructions = '', $required = 0 ) {
		return [ 
			'key' => 'field_' . $name,
			'label' => $label,
			'name' => $name,
			'type' => 'image',
			'instructions' => $instructions,
			'required' => $required,
			'return_format' => $return_format, // می‌توانید 'array'، 'url' یا 'id' را انتخاب کنید
			'preview_size' => 'thumbnail', // اندازه پیش‌نمایش تصویر
			'library' => 'all', // می‌توانید 'all' یا 'uploadedTo' را انتخاب کنید
		];
	}

	public function getPostTypeLocation( $post_type, $operator = '==' ) {
		return [ 
			'param' => 'post_type',
			'operator' => $operator,
			'value' => $post_type,
		];
	}
}