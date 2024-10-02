<?php

function cp_get_template( $scope, $file_name, $args = [] ) {
	$file_path = CYAN_PLUGIN_TEMPLATES . '/' . $scope . '/' . $file_name . '.php';

	if ( file_exists( $file_path ) ) {
		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args ); // متغیرها را استخراج می‌کند
		}

		include_once $file_path;
	} else {
		echo 'file is not exist!';
	}
}