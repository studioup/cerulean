<?php
/*********************
Enqueue the proper CSS
if you use Sass.
*********************/
if( ! function_exists( 'cerulean_enqueue_style' ) ) {
	function cerulean_enqueue_style()
	{
		// foundation stylesheet
		wp_register_style( 'cerulean-foundation-stylesheet', get_stylesheet_directory_uri() . '/css/app.css', array(), '' );

		// Register the main style
		wp_register_style( 'cerulean-stylesheet', get_stylesheet_directory_uri() . '/css/style.css', array(), '', 'all' );
		
		wp_enqueue_style( 'cerulean-foundation-stylesheet' );
		wp_enqueue_style( 'cerulean-stylesheet' );
		
	}
}
add_action( 'wp_enqueue_scripts', 'cerulean_enqueue_style' );
?>
