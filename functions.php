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

/*
6. lib/img.php
	- custom walker for top-bar and related
*/
require_once('lib/img.php'); // filter default wordpress menu classes and clean wp_nav_menu markup

//remove wpml language selector css
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);

//disabilitare dimensioni di default di wordpress
function sgr_filter_image_sizes( $sizes) {
		
	unset( $sizes['thumbnail']);
	//unset( $sizes['medium']);
	//unset( $sizes['large']);
	
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'sgr_filter_image_sizes');


/**********************
Add theme supports
 **********************/
if( ! function_exists( 'cerulean_theme_support' ) ) {
    function cerulean_theme_support() {
        // Add language supports.
        load_theme_textdomain('cerulean', get_template_directory() . '/lang');

        // Add post thumbnail supports. http://codex.wordpress.org/Post_Thumbnails
        //add_theme_support('post-thumbnails');
        set_post_thumbnail_size(300, 999);
        //add_image_size('fd-xsm', 256, 9999);
        add_image_size('fd-sm', 512, 9999);
        add_image_size('fd-sm2', 768, 9999);
        add_image_size('fd-md', 1024, 99999);
        add_image_size('fd-lg', 1200, 99999);
        add_image_size('fd-xl', 1440, 99999);
        add_image_size('fd-xxl', 2048, 99999);
        

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


function cookie_consent(){
    if (isset($_COOKIE['ce-consent']) && $_COOKIE['ce-consent'] == 'Y'){
        return true;
    }
    echo '<div class="ce-blocked-iframe"></div>';
    return false;
}



add_filter('query_vars', 'add_my_var');
function add_my_var($public_query_vars) {
    $public_query_vars[] = 'modal';
    //$public_query_vars[] = 'subject';
    return $public_query_vars;
}


if( function_exists('acf_add_options_sub_page') )
{
    acf_add_options_page(array(
        //'title' => __('General options','cerulean'), // this seems to create an options page for every language
        'title' => 'Global options',
        'menu_slug' => 'global-options',
        'capability' => 'manage_options'
    ));
    
    if ( function_exists('icl_object_id') ) {
        acf_add_options_page(array(
            //'title' => __('General options','cerulean'), // this seems to create an options page for every language
            'title' => 'Options',
            'menu_slug' => 'translated-options',
            'capability' => 'manage_options'
        ));
    }
    
    
    function cl_set_global_options_pages($current_screen) {
        //var_dump($current_screen);
      // IDs of admin options pages that should be "global"
      $page_ids = array(
        "toplevel_page_global-options"
      );
    
      if (in_array($current_screen->id, $page_ids)) {
        add_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
      }
    }
    add_action( 'current_screen', 'cl_set_global_options_pages' );
    
    function cl_acf_set_language() {
      return acf_get_setting('default_language');
    }
    
    /**
     * Wrapper around get_field() to get the "global" option values.
     * This is the function you'll want to use in your templates instead of get_field() for "global" options.
     */
    function get_global_option($name) {
        add_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
        $option = get_field($name, 'option');
        remove_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
        return $option;
    }


    function get_forms(){
        ob_start();
        FrmFormsHelper::forms_dropdown( 'frm_add_form_id' );
        $forms = ob_get_contents();
        ob_end_clean();
        preg_match_all('/<option\svalue="([^"]*)" >([^>]*)<\/option>/', $forms, $matches);
        $result = array_combine($matches[1], $matches[2]);
        return $result;
    }
    /* auto populate acf field with form IDs */
    function load_forms_function( $field ){
        //exit;
        $result = get_forms();
        if( is_array($result) ){
            $field['choices'] = array();
            foreach( $result as $key=>$match ){
                $field['choices'][ $key ] = $match;
            }
        }
        return $field;
    }
    add_filter('acf/load_field/name=forms', 'load_forms_function');

}



//allow svg upload, commented out by default
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
//add_filter('upload_mimes', 'cc_mime_types');


// remove emoji js 
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


//excerpt counting chars instead of words
function get_excerpt_chars($count){
  global $post;
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = $excerpt.'...'; // <a href="'.$permalink.'">more</a>';
  return $excerpt;
}

add_action('template_redirect','show_sitemap');
function show_sitemap() {
  if (isset($_GET['show_sitemap'])) {
    $the_query = new WP_Query(array('post_type' => 'any', 'posts_per_page' => '-1', 'post_status' => 'publish', 'suppress_filters' => 1));
    $urls = array();
    while ($the_query->have_posts()) {
      $the_query->the_post();
      $urls[] = get_permalink().'#no-animate';
    }
    die(json_encode($urls));
  }
}


?>
