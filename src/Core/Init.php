<?php

namespace CyanPlugin\Core;

class Init {
	public static function get_services() {
		return [ 
			Activator::class,
			\CyanPlugin\Assets\Enqueue::class,
			\CyanPlugin\Admin\AdminMenu::class,
			\CyanPlugin\Frontend\Shortcodes::class,
		];
	}

	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	private static function instantiate( $class ) {
		return new $class();
	}
}