<?php
function add_defer_attribute( $tag, $handle ) {
	// Add script handles to the array below.
	// Similarly you can add async attribute as well. Or any other desired attribute of yours.
	$scripts_to_defer = array( 'script-handle-1', 'script-handle-2', 'script-handle-3' );
	if ( in_array( $scripts_to_defer, $handle, true ) ) {
		return str_replace( ' src', ' defer="defer" src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );
