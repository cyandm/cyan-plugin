<?php

namespace CyanPlugin\Includes;

class ThirdPartyPluginManager {
	private $plugins = [];

	public function __construct() {
		// تنظیم مسیر پلاگین‌ها
		$this->setPluginPath();
	}

	public function register() {
		$this->loadPlugins();
	}

	private function setPluginPath() {
		$this->plugins = [ 
			'advanced-custom-fields' => CYAN_PLUGIN_PATH . 'third-party-plugins/advanced-custom-fields/acf.php',
			// می‌توانید پلاگین‌های دیگر را به اینجا اضافه کنید
		];
	}

	public function loadPlugins() {
		foreach ( $this->plugins as $plugin_name => $plugin_file ) {
			if ( file_exists( $plugin_file ) ) {
				include_once $plugin_file;
				// در صورت نیاز، می‌توانید توابعی را برای هر پلاگین اضافه کنید
			} else {
				error_log( "Plugin file not found: " . $plugin_file );
			}
		}
	}
}