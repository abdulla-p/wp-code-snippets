<?php
/**
 * This code snippet can be used to sanitise string input data or string variables.
 * This is an alternative to the php FILTER_SANITIZE_STRING constant which is deprecated.
 * Works exactly like FILTER_SANITIZE_STRING.
 * 
 * @package filter
 */

if ( ! function_exists( 'filter_string_polyfill' ) ) {
	/**
	 * Code Snippet: Sanitise input value.
	 *
	 * @param string $string string to sanitize.
	 * @return string
	 */
	function filter_string_polyfill( $string ) {
		$str = preg_replace( '/\x00|<[^>]*>?/', '', $string );
		return str_replace( array( "'", '"' ), array( '&#39;', '&#34;' ), $str );
	}
}

// Use case examples.
$use = filter_input( INPUT_GET, 'use', FILTER_CALLBACK, array( 'options' => 'pip_filter_string_polyfill' ) );
$use = filter_input( INPUT_POST, 'use', FILTER_CALLBACK, array( 'options' => 'pip_filter_string_polyfill' ) );
$use = filter_var( $use, FILTER_CALLBACK, array( 'options' => 'pip_filter_string_polyfill' ) );
