<?php

namespace CyanPlugin\Core;

class Init {
	public static function get_services() {
		return [ 
			Activator::class,
			FunctionsAutoload::class,
			/*Includes*/
			\CyanPlugin\Includes\ThirdPartyPluginManager::class,
			\CyanPlugin\Includes\CustomPostType::class,
			\CyanPlugin\Includes\MetaBox::class,
			\CyanPlugin\Includes\Columns::class,

			/*Assets */
			\CyanPlugin\Assets\Enqueue::class,
			/*Admin */
			\CyanPlugin\Admin\AdminMenu::class,
			/*Frontend */
			\CyanPlugin\Frontend\Shortcodes::class,
			/*ACF */
			\CyanPlugin\ACF\ACFField::class,
			\CyanPlugin\ACF\ACFFieldRegistrar::class,
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