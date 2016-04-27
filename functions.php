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

require_once('lib/shortcodes.php');




/**
 * MaxMind Country codes
 *
 * AP, EU, AD, AE, AF, AG, AI, AL, AM, CW, AO, AQ, AR, AS, AT, AU, AW, AZ, BA, BB, BD, BE, BF, BG,
 * BH, BI, BJ, BM, BN, BO, BR, BS, BT, BV, BW, BY, BZ, CA, CC, CD, CF, CG, CH, CI, CK, CL, CM, CN,
 * CO, CR, CU, CV, CX, CY, CZ, DE, DJ, DK, DM, DO, DZ, EC, EE, EG, EH, ER, ES, ET, FI, FJ, FK, FM,
 * FO, FR, SX, GA, GB, GD, GE, GF, GH, GI, GL, GM, GN, GP, GQ, GR, GS, GT, GU, GW, GY, HK, HM, HN,
 * HR, HT, HU, ID, IE, IL, IN, IO, IQ, IR, IS, IT, JM, JO, JP, KE, KG, KH, KI, KM, KN, KP, KR, KW,
 * KY, KZ, LA, LB, LC, LI, LK, LR, LS, LT, LU, LV, LY, MA, MC, MD, MG, MH, MK, ML, MM, MN, MO, MP,
 * MQ, MR, MS, MT, MU, MV, MW, MX, MY, MZ, NA, NC, NE, NF, NG, NI, NL, NO, NP, NR, NU, NZ, OM, PA,
 * PE, PF, PG, PH, PK, PL, PM, PN, PR, PS, PT, PW, PY, QA, RE, RO, RU, RW, SA, SB, SC, SD, SE, SG,
 * SH, SI, SJ, SK, SL, SM, SN, SO, SR, ST, SV, SY, SZ, TC, TD, TF, TG, TH, TJ, TK, TM, TN, TO, TL,
 * TR, TT, TV, TW, TZ, UA, UG, UM, US, UY, UZ, VA, VC, VE, VG, VI, VN, VU, WF, WS, YE, YT, RS, ZA,
 * ZM, ME, ZW, A1, A2, O1, AX, GG, IM, JE, BL, MF, BQ, SS, O1
 */

//Array with structure MaxMind Code => WPML Code
global $language_mappings;
$language_mappings = array(

	'IT' => 'it', //ITALIA
	'GB' => 'en', //UK
	'US' => 'en', //USA
	'CA' => 'en',  //Canada
	//'SE' => 'sv', //Sweden
	//'NO' => 'nb', //Norway
	//'FI' => 'fi', //Finland
	//'DK' => 'da', //Denmark
);


require_once('lib/browser-redirect-geoip/wpml-geoip-browser-language-redirect.php');

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
        add_theme_support('post-thumbnails');
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
            //'primary_left' => __('Primary Navigation Left', 'cerulean'),
            //'primary_right' => __('Primary Navigation Right', 'cerulean'),
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
        echo '<time class="updated" datetime="'. get_the_time('c') .'" >'. get_the_time('d/m/Y') .'</time>';
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
add_filter('upload_mimes', 'cc_mime_types');


// remove emoji js 
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

remove_action( 'wp_head', array( $sitepress, 'meta_generator_tag', 20 ) );
if (defined('WPSEO_VERSION')){
  add_action('get_header',function (){ ob_start(function ($o){
  return preg_replace('/\n?<.*?yoast.*?>/mi','',$o); }); });
  add_action('wp_head',function (){ ob_end_flush(); }, 999);
}

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

function current_page_url($https=true) {
	$pageURL = 'http';
	if( isset($_SERVER["HTTPS"]) && $https) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
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


function grid_queries( $query ) {
    if ( is_admin() || ! $query->is_main_query() ) return;
    
    if ( ! is_admin() && in_array ( $query->get('post_type'), array('place-here-an-array-of-grid-post-type-slugs') ) ) {
        $query->set('posts_per_page', 9);
    }
  }
add_action( 'pre_get_posts', 'grid_queries' );


add_filter( 'pre_get_posts', 'no_sticky_posts' );

function no_sticky_posts( $query ) {

	if ( is_home() && $query->is_main_query() && !is_admin() ){
    	//$query->set('suppress_filter', true);
		//$query->set( 'post_type', array( 'post','i-viaggi-di-roberta', 'racconti-dai-blogger', 'i-villaggi', 'island-hopping' ) );
		$query->set('ignore_sticky_posts',true);
    }
		//$query->set( 'offset', array( 'post','i-viaggi-di-roberta', 'racconti-dai-blogger', 'i-villaggi', 'island-hopping' ) );

	return $query;
}

function change_sticky_class($classes) {
	$classes = array_diff($classes, array("sticky"));
	$classes[] = 'sticky-post';
	return $classes;
}
add_filter('post_class','change_sticky_class');


// Attach callback to 'tiny_mce_before_init' 
//add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 

function my_theme_add_editor_styles() {
    if (defined('PRODUCTION') && PRODUCTION == true && defined('UNCSS') && UNCSS == true) {
		add_editor_style( get_stylesheet_directory_uri() . '/css/style.clean.css' );
	} elseif (defined('PRODUCTION') && PRODUCTION == true ) {
		add_editor_style( get_stylesheet_directory_uri() . '/css/style.min.css' );
	}else{
		add_editor_style( get_stylesheet_directory_uri() . '/css/style.css' );
	}

}
add_action( 'init', 'my_theme_add_editor_styles' );




//echo '<pre>';
//var_dump($config_sass);
//echo '</pre>';



function mytheme_change_tinymce_colors( $init ) {
	$config_sass = json_decode( file_get_contents(get_template_directory()."/config_sass.json"), true );
	
    $default_colours = '
        "000000", "Black",
        "993300", "Burnt orange",
        "333300", "Dark olive",
        "003300", "Dark green",
        "003366", "Dark azure",
        "000080", "Navy Blue",
        "333399", "Indigo",
        "333333", "Very dark gray",
        "800000", "Maroon",
        "FF6600", "Orange",
        "808000", "Olive",
        "008000", "Green",
        "008080", "Teal",
        "0000FF", "Blue",
        "666699", "Grayish blue",
        "808080", "Gray",
        "FF0000", "Red",
        "FF9900", "Amber",
        "99CC00", "Yellow green",
        "339966", "Sea green",
        "33CCCC", "Turquoise",
        "3366FF", "Royal blue",
        "800080", "Purple",
        "999999", "Medium gray",
        "FF00FF", "Magenta",
        "FFCC00", "Gold",
        "FFFF00", "Yellow",
        "00FF00", "Lime",
        "00FFFF", "Aqua",
        "00CCFF", "Sky blue",
        "993366", "Brown",
        "C0C0C0", "Silver",
        "FF99CC", "Pink",
        "FFCC99", "Peach",
        "FFFF99", "Light yellow",
        "CCFFCC", "Pale green",
        "CCFFFF", "Pale cyan",
        "99CCFF", "Light sky blue",
        "CC99FF", "Plum",
        "FFFFFF", "White"
        ';
    $i = 0;
    $custom_colours = '';
    foreach($config_sass['color'] as $k => $v){
	    if( strpos($v, '$') === false ){
		    if($i != 0){
			    $custom_colours .= ',
			    ';
		    }
		    $custom_colours .= '"'.str_ireplace('#', '', $v).'", "'.str_ireplace('-', ' ', $k).'"';
		    $i++;
	    }
    }
    /*
    $custom_colours = '
		"'.str_ireplace('#', '', $config_sass['color']['dark-gray']).'", "dark gray",
        "'.str_ireplace('#', '', $config_sass['color']['medium-gray']).'", "medium gray",
        "'.str_ireplace('#', '', $config_sass['color']['light-gray']).'", "light gray",
        "'.str_ireplace('#', '', $config_sass['color']['primary']).'", "primary",
        "'.str_ireplace('#', '', $config_sass['color']['secondary']).'", "secondary",
        "'.str_ireplace('#', '', $config_sass['color']['info']).'", "info",
        "'.str_ireplace('#', '', $config_sass['color']['black']).'", "black",
        "'.str_ireplace('#', '', $config_sass['color']['success']).'", "success",
        "'.str_ireplace('#', '', $config_sass['color']['warning']).'", "warning"
        ';
    */
    //$init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';
    $init['textcolor_map'] = '['.$custom_colours.']';
    $init['textcolor_rows'] = 6; // expand colour grid to 6 rows
    //var_dump( str_ireplace('#', '', $config_sass['color']['dark-gray']));
	//exit;
	//echo $init['textcolor_map'];
    return $init;
}
add_filter('tiny_mce_before_init', 'mytheme_change_tinymce_colors');


function acf_set_featured_image( $value, $post_id, $field  ){
    
    if($value != ''){
	    //Add the value which is the image ID to the _thumbnail_id meta data for the current post
	    add_post_meta($post_id, '_thumbnail_id', $value);
    }
 
    return $value;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=featured_image', 'acf_set_featured_image', 10, 3);
 
/*
add_filter('acf/location/rule_types', 'acf_location_rules_types');
function acf_location_rules_types( $choices )
{
	var_dump($choices);
	exit;
    $choices['Basic']['user'] = 'User';

    return $choices;
}
*/

//add_filter('acf/location/rule_match/page', 'acf_location_rules_match_post', 10, 3);
add_filter('acf/location/rule_match/page', 'acf_location_rules_match_page', 10, 3);




function acf_location_rules_match_page( $match, $rule, $options ) {
	if( ! function_exists(icl_object_id)  ){
		return $match;
	}
	global $sitepress;
	//exit;
	// bail early if not a post
	if( !$options['post_id'] ) return false;
	
	
	// translate $rule['value']
	// - this variable will hold the original post_id, but $options['post_id'] will hold the translated version
	//if( function_exists('icl_object_id') )
	//{
	//	$rule['value'] = icl_object_id( $rule['value'], $options['post_type'], true );
	//}
	
	
	// compare
    if( $rule['operator'] == "==") {
    	
    	$match = ( icl_object_id($options['post_id'], 'page', $sitepress->get_default_language()) == icl_object_id($rule['value'], 'page', $sitepress->get_default_language()) );
    
    } elseif( $rule['operator'] == "!=") {
    	
    	$match = ( icl_object_id($options['post_id'], 'page', $sitepress->get_default_language()) != icl_object_id($rule['value'], 'page', $sitepress->get_default_language()) );
    
    }
    
    
    // return
    return $match;

}
	
	


// layouts support for foundation
// Define the name of your framework
add_filter('ddl-set_framework', function( $slug ){
    return 'foundation';
});
 
 
// Define the list of supported frameworks
add_filter('ddl-set_up_frameworks', function( $array ){
    $array['foundation'] = (object) array('label' => 'Foundation by ZURB');
    return $array;
});
 
// Define the CSS class that will be added to the container element
add_filter('ddl-get_container_class', function( $el ){
    return 'container';
});
 
// Define the CSS class that will be added to fluid container element
add_filter('ddl-get_container_fluid_class', function( $el ){
    return 'container-fluid';
});
 
// Define the CSS class that will be added to the row element in the grid
add_filter('ddl-get_row_class', function( $el ){
    return 'row';
});
 
// Define the offset prefix CSS class that will be added to the element in the grid
add_filter('ddl-get_offset_prefix', function( $el ){
    return 'offset-';
});
 
// Define the prefix CSS classes that will be added to the columns in the grid
add_filter('ddl-get-column-prefix', function( $el ){
    return array( 'large-');
});
 
// Define any additional CSS classes that need to be added to the columns in the grid
add_filter('ddl-get_additional_column_class', function( $el ){
    return 'columns';
});
 
// Define if framework supports native support for Layouts Image Box cell responsive images
add_filter('ddl-framework_supports_responsive_images', function( $bool ){
    return false;
});
 
// Define the CSS class for the thumbnail image
add_filter('ddl-get_thumbnail_class', function( $bool ){
    return 'th';
});

/*
add_filter('ddl-get_column_width', function( $width, $column_prefix, $this ){
	echo '<pre>';
	var_dump($width);
	var_dump($this);
	echo '</pre>';
});
*/

function include_files_by_folder( $tpls_dir = '' )
{
    $dir_str = dirname(__FILE__) . $tpls_dir;
    $dir = opendir( $dir_str );
    while( ( $currentFile = readdir($dir) ) !== false ) {
       if ( $currentFile == '.' || $currentFile == '..' || $currentFile[0] == '.' ) {
          continue;
       }

       include $dir_str.$currentFile;
    }
    closedir($dir);
}
include_files_by_folder('/lib/widgets/');

if( class_exists( 'WPDD_Layouts' ) && !function_exists( 'include_ddl_layouts' ) )
{
    
 
    include_files_by_folder('/lib/cell_layouts/');
}


/*amp support */
add_filter( 'amp_post_template_data', 'xyz_amp_set_site_icon_url' );

function xyz_amp_set_site_icon_url( $data ) {
    // Ideally a 32x32 image
    /*
    $image =  wp_get_attachment_image_src( get_field('logo','options') , 'fd-sm' );
    
    if(!empty($image) && !empty($image[0])){
        $data[ 'site_icon_url' ] = $image[0];
    }
    */
    $data[ 'site_icon_url' ] = get_stylesheet_directory_uri() . '/img/favicons/favicon-96x96.png';
    return $data;
}

add_action( 'amp_post_template_css', 'xyz_amp_my_additional_css_styles' );

function xyz_amp_my_additional_css_styles( $amp_template ) {
	$config_sass = json_decode( file_get_contents(get_template_directory()."/config_sass.json"), true );
	//var_dump( $config_sass["color"]["primary"]);
	//exit;
    // only CSS here please...
    ?>
    .amp-wp-byline amp-img {
        /* border-radius: 0; */ /* we don't want round avatars! */
    }
    body nav.amp-wp-title-bar {
	    
		background: <?php echo $config_sass["color"]["primary"];?>;
    }
    <?php
	    
}

add_filter('getarchives_join', 'my_custom_post_type_archive_join', 10, 2);
function my_custom_post_type_archive_join($join,$args){  
	$post_type = isset($args['post_type']) ? $args['post_type'] : 'post'; 
	$join = str_ireplace("t.element_type='post_post'", "t.element_type='post_$post_type'", $join);
	return  $join;
	
}

?>
