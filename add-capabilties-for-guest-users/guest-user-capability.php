<?php
/**
 * Code Snippet: Add capability to logged-out or guest users.
 *
 * @return void
 * @package caps
 */

/**
 * Add capability to guest users.
 *
 * @return void
 */
function add_custom_capability_to_guest_users() {
	$user = wp_get_current_user();
	if ( ! $user->ID ) {

		// Add capability of your choice.
		$user->add_cap( 'moderate_comments' );
	}
}

// Set priority as per the requirement.
add_action( 'init', 'add_custom_capability_to_guest_users', 10 );
