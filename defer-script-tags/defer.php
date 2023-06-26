<?php
/**
 * This code snippet can be used to improve page loading time by adding neccessary attributes to the js files.
 * 
 * @package defer
 */

/**
 * Code Snippet: Add defer or async attributes to js script tags
 *
 * @param string $tag 
 * @param array  $handle 
 * 
 * @return string
 */
function add_defer_attribute( $tag, $handle ) {
	// Add script handles to the array below.
	$scripts_to_defer = array( 'script-handle-1', 'script-handle-2', 'script-handle-3' );
	
	if ( in_array( $scripts_to_defer, $handle, true ) ) {
		// Similarly you can add async attribute as well. Or any other desired attribute of yours.
		return str_replace( ' src', ' defer="defer" src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );
