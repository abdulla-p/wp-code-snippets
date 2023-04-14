<?php
/**
 * Code Snippet: Convert jpeg, jpg or png images to webp.
 * 
 * Important Note: This function uses php GD library. So make sure your PHP server supports GD library before using this snippet.
 * 
 * @package webp
 */

/**
 * Function to convert jpeg, jpg or png images to webp.
 *
 * @param string $input_image Url of the image.
 * @return void
 * 
 * @throws Exception Unsupported file extension.
 */
function lnwm_create_webp_version_of_image( $input_image ) {
	$output_image = $input_image . '.webp';
	
	// Get the file extension of the input image.
	$input_extension = strtolower( pathinfo( $input_image, PATHINFO_EXTENSION ) );

	// Load the input image using GD.
	switch ( $input_extension ) {
		case 'jpg':
		case 'jpeg':
			$image = imagecreatefromjpeg( $input_image );
			break;

		case 'png':
			$image = imagecreatefrompng( $input_image );
			break;

		default:
			throw new Exception( 'Unsupported file extension' );
	}

	imagepalettetotruecolor( $image );

	// Convert the image to WebP using GD.
	imagewebp( $image, $output_image, 90 );

	// Free up memory.
	imagedestroy( $image );
}
