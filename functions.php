<?php
/*
Author: Zhen Huang
URL: http://themefortress.com/

This place is much cleaner. Put your theme specific codes here,
anything else you may want to use plugins to keep things tidy.

*/

/*
1. lib/clean.php
  - head cleanup
	- post and images related cleaning
*/
require_once('lib/clean.php'); // do all the cleaning and enqueue here

/*
2. lib/enqueue-style.php
    - enqueue Foundation and cerulean CSS
*/
require_once('lib/enqueue-style.php');

/*
3. lib/foundation.php
	- add pagination
*/
require_once('lib/foundation.php'); // load Foundation specific functions like top-bar
/*
4. lib/nav.php
	- custom walker for top-bar and related
*/
require_once('lib/nav.php'); // filter default wordpress menu classes and clean wp_nav_menu markup
/*
5. lib/presstrends.php
    - add PressTrends, tracks how many people are using cerulean
*/
//require_once('lib/presstrends.php'); // load PressTrends to track the usage of cerulean across the web, comment this line if you don't want to be tracked

/**********************
Add theme supports
 **********************/
if( ! function_exists( 'cerulean_theme_support' ) ) {
    function cerulean_theme_support() {
        // Add language supports.
        load_theme_textdomain('cerulean', get_template_directory() . '/lang');

        // Add post thumbnail supports. http://codex.wordpress.org/Post_Thumbnails
        add_theme_support('post-thumbnails');
        // set_post_thumbnail_size(150, 150, false);
        add_image_size('fd-lrg', 1024, 99999);
        add_image_size('fd-med', 768, 99999);
        add_image_size('fd-sm', 320, 9999);

        // rss thingy
        add_theme_support('automatic-feed-links');

        // Add post formats support. http://codex.wordpress.org/Post_Formats
        add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

        // Add menu support. http://codex.wordpress.org/Function_Reference/register_nav_menus
        add_theme_support('menus');
        register_nav_menus(array(
            'primary' => __('Primary Navigation', 'cerulean'),
            'additional' => __('Additional Navigation', 'cerulean'),
            'utility' => __('Utility Navigation', 'cerulean')
        ));

        // Add custom background support
        add_theme_support( 'custom-background',
            array(
                'default-image' => '',  // background image default
                'default-color' => '', // background color default (dont add the #)
                'wp-head-callback' => '_custom_background_cb',
                'admin-head-callback' => '',
                'admin-preview-callback' => ''
            )
        );
    }
}
add_action('after_setup_theme', 'cerulean_theme_support'); /* end cerulean theme support */

// create widget areas: sidebar, footer
$sidebars = array('Sidebar');
foreach ($sidebars as $sidebar) {
    register_sidebar(array('name'=> $sidebar,
    	'id' => 'Sidebar',
        'before_widget' => '<article id="%1$s" class="panel widget %2$s">',
        'after_widget' => '</article>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
}
$sidebars = array('Footer');
foreach ($sidebars as $sidebar) {
    register_sidebar(array('name'=> $sidebar,
    	'id' => 'Footer',
        'before_widget' => '<div class="large-3 columns"><article id="%1$s" class="panel widget %2$s">',
        'after_widget' => '</article></div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
}

// return entry meta information for posts, used by multiple loops, you can override this function by defining them first in your child theme's functions.php file
if ( ! function_exists( 'cerulean_entry_meta' ) ) {
    function cerulean_entry_meta() {
        //echo '<span class="byline author">'. __('Written by', 'cerulean') .' <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .', </a></span>';
        echo '<time class="updated" datetime="'. get_the_time('c') .'" >'. get_the_time('F jS, Y') .'</time>';
    }
};

//*** start cerulean ***//

//remove admin bar
add_filter('show_admin_bar', '__return_false');


function get_featured_img_src( $size = 'full' ){
    $image = false;
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );
    if(!empty($image) && !empty($image[0])){
        return $image[0];
    }
}

function the_featured_image_src( $size = 'full' ){
    echo get_featured_img_src( $size );
}


function get_image_src_from_id( $id , $size = 'full' ){
    $image = false;
    $image =  wp_get_attachment_image_src( $id , $size );
    if(!empty($image) && !empty($image[0])){
        return $image[0];
    }
    return false;
}

function the_image_src_from_id( $id , $size = 'full' ){
    echo get_image_src_from_id( $id , $size );
}

if ( function_exists( 'get_field' ) ) {
    function get_field_img($field, $size = 'full' ){
        return get_image_src_from_id( get_field($field) , $size );
    }
    
    function the_field_img($field, $size = 'full' ){
        echo get_field_img($field, $size );
    }
}

if ( function_exists( 'get_sub_field' ) ) {
    function get_sub_field_img($field, $size = 'full' ){
        return get_image_src_from_id( get_sub_field($field) , $size );
    }
    
    function the_sub_field_img($field, $size = 'full' ){
        echo get_sub_field_img($field, $size );
    }
}

?>
