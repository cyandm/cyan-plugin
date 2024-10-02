<?php
namespace CyanPlugin\Core;

class FunctionsAutoload {

	public static function register() {
		// مشخص کردن پوشه‌ای که شامل فایل‌های توابع است
		$function_dir = CYAN_PLUGIN_PATH . './src/Helpers/';

		// بارگذاری فایل‌های توابع به صورت خودکار
		foreach ( glob( $function_dir . '*.php' ) as $file ) {
			require_once $file;
		}
	}
}