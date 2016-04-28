<?php
/*********************
Start all the functions
at once for cerulean.
*********************/

// start all the functions
add_action('after_setup_theme','cerulean_startup');

if( ! function_exists( 'cerulean_startup ' ) ) {
	function cerulean_startup() {

	    // launching operation cleanup
	    add_action('init', 'cerulean_head_cleanup');
	    // remove WP version from RSS
	    add_filter('the_generator', 'cerulean_rss_version');
	    // remove pesky injected css for recent comments widget
	    add_filter( 'wp_head', 'cerulean_remove_wp_widget_recent_comments_style', 1 );
	    // clean up comment styles in the head
	    add_action('wp_head', 'cerulean_remove_recent_comments_style', 1);
	    // clean up gallery output in wp
	    add_filter('gallery_style', 'cerulean_gallery_style');

	    // enqueue base scripts and styles
	    add_action('wp_enqueue_scripts', 'cerulean_scripts_and_styles', 999);
	    // ie conditional wrapper
	    add_filter( 'style_loader_tag', 'cerulean_ie_conditional', 10, 2 );
	    
	    // additional post related cleaning
	    add_filter( 'img_caption_shortcode', 'cerulean_cleaner_caption', 10, 3 );
	    add_filter('get_image_tag_class', 'cerulean_image_tag_class', 0, 4);
	    add_filter('get_image_tag', 'cerulean_image_editor', 0, 4);
	    add_filter( 'the_content', 'cerulean_img_unautop', 30 );

	} /* end cerulean_startup */
}


/**********************
Clean up and mask links

**********************/


/*
function relative_url($url) {
	
	$parsed_url = parse_url($url);
	
	$url = $parsed_url['path'];
	
	if (isset($parsed_url['query']) && $parsed_url['query'] != '') {
		$url .= '?'.$parsed_url['query'];
	}
	
	return $url;
}
*/
function cerulean_template_directory_uri($template_dir_uri, $template, $theme_root_uri){
	//$template_dir_uri = preg_replace('/\/[a-zA-Z0-9\-\_]+\/themes\/[a-zA-Z0-9\-\_]+/i', '/template', $template_dir_uri);
	/*
	if(defined('RELATIVE_PATHS') && RELATIVE_PATHS == true ){
		$template_dir_uri = '/template';
	}else{
		$template_dir_uri = home_url( '/template', $_SERVER['SERVER_PROTOCOL'] ); 
	}
	*/
	$template_dir_uri = home_url( '/template', $_SERVER['SERVER_PROTOCOL'] ); 
	return $template_dir_uri;
}
function cerulean_stylesheet_uri($stylesheet_uri, $stylesheet_dir_uri){
	/*
	if(defined('RELATIVE_PATHS') && RELATIVE_PATHS == true ){
		$stylesheet_uri = '/template';
	}else{
		$stylesheet_uri = home_url( '/template', $_SERVER['SERVER_PROTOCOL'] ); 
	}
	*/
	$stylesheet_uri = home_url( '/template', $_SERVER['SERVER_PROTOCOL'] );
	return $stylesheet_uri;
}
function cerulean_stylesheet_directory_uri($stylesheet_dir_uri, $stylesheet, $theme_root_uri){
	/*
	if(defined('RELATIVE_PATHS') && RELATIVE_PATHS == true ){
		$stylesheet_dir_uri = '/template';
	}else{
		$stylesheet_dir_uri = home_url( '/template', $_SERVER['SERVER_PROTOCOL'] ); 
	}
	*/
	$stylesheet_dir_uri = home_url( '/template', $_SERVER['SERVER_PROTOCOL'] ); 
	return $stylesheet_dir_uri;
}
function cerulean_style_loader_src($src, $handle){
	$src = str_replace(WPINC ,trim(trim('includes'),'/')
												,$src);
	//if(defined('RELATIVE_PATHS') && RELATIVE_PATHS == true ){
	//	$src = relative_url($src);
	//}
	//var_dump($src);
	return  $src;
}
function cerulean_upload_dir($src){
	/*
	if(defined('RELATIVE_PATHS') && RELATIVE_PATHS == true ){
		$src['url'] = relative_url( $src['url']);
		$src['baseurl'] = relative_url( $src['baseurl']);
	}
	*/
	return $src;
}
if (defined('MASK_THEME_URL') && MASK_THEME_URL == true && !is_admin()) {
	
		add_filter('template_directory_uri','cerulean_template_directory_uri' , 100000, 3);
		add_filter('stylesheet_uri','cerulean_stylesheet_uri', 10, 2);
		add_filter('stylesheet_directory_uri','cerulean_stylesheet_directory_uri', 10, 3);
		//add_filter('script_loader_src',array( $this, 'script_loader_src' ), 10, 2);
		add_filter('style_loader_src','cerulean_style_loader_src' , 10, 2);
}
add_filter('upload_dir', 'cerulean_upload_dir' );


//add_action( 'template_redirect', 'relative_url' );


remove_action( 'wp_head', array( $sitepress, 'meta_generator_tag', 20 ) );
if (defined('WPSEO_VERSION')){
  add_action('get_header',function (){ ob_start(function ($o){
  return preg_replace('/\n?<.*?yoast.*?>/mi','',$o); }); });
  add_action('wp_head',function (){ ob_end_flush(); }, 999);
}




$filters = array(
    'bloginfo_url',
    'the_permalink',
    'wp_list_pages',
    'wp_list_categories',
    'the_content_more_link',
    'the_tags',
    'the_author_posts_link',
    'post_link',       // Normal post link
    'post_type_link',  // Custom post type link
    'page_link',       // Page link
    'attachment_link', // Attachment link
    'get_shortlink',   // Shortlink
    'post_type_archive_link',    // Post type archive link
    'get_pagenum_link',          // Paginated link
    'get_comments_pagenum_link', // Paginated comment link
    'term_link',   // Term link, including category, tag
    'search_link', // Search link
    'day_link',   // Date archive link
    'month_link',
    'year_link',

    // site location
    'option_siteurl',
    'blog_option_siteurl',
    'option_home',
    'admin_url',
    'get_admin_url',
    'get_site_url',
    'network_admin_url',
    'home_url',
    'includes_url',
    'site_url',
    'site_option_siteurl',
    'network_home_url',
    'network_site_url',

    // debug only filters
    'get_the_author_url',
    'get_comment_link',
    'wp_get_attachment_image_src',
    'wp_get_attachment_thumb_url',
    'wp_get_attachment_url',
    'wp_login_url',
    'wp_logout_url',
    'wp_lostpassword_url',
    'get_stylesheet_uri',
    // 'get_stylesheet_directory_uri',
    // 'plugins_url',
    // 'plugin_dir_url',
    // 'stylesheet_directory_uri',
    // 'get_template_directory_uri',
    // 'template_directory_uri',
    'get_locale_stylesheet_uri',
    'script_loader_src', // plugin scripts url
    'style_loader_src', // plugin styles url
    'get_theme_root_uri'
    // 'home_url'
  );

  // Thanks to https://wordpress.org/support/topic/request-only-replace-local-urls
$home_url = home_url();
$filter_fn = function( $link ) use ( $home_url ) {
    if ( !is_array($link) && strpos( $link, $home_url ) === 0 ) {
	    if(defined('RELATIVE_PATHS') && RELATIVE_PATHS == true ){
			return wp_make_link_relative( $link );
      	}else{
	      	return $link;
      	}
    } else {
      return $link;
    }
};

foreach ( $filters as $filter ) {
    add_filter( $filter, $filter_fn );
}



/**********************
WP_HEAD GOODNESS
The default WordPress head is
a mess. Let's clean it up.

Thanks for Bones
http://themble.com/bones/
**********************/

if( ! function_exists( 'cerulean_head_cleanup ' ) ) {
	function cerulean_head_cleanup() {
		// category feeds
		// remove_action( 'wp_head', 'feed_links_extra', 3 );
		// post and comment feeds
		// remove_action( 'wp_head', 'feed_links', 2 );
		// EditURI link
		remove_action( 'wp_head', 'rsd_link' );
		// windows live writer
		remove_action( 'wp_head', 'wlwmanifest_link' );
		// index link
		remove_action( 'wp_head', 'index_rel_link' );
		// previous link
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		// start link
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		// links for adjacent posts
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		// WP version
		remove_action( 'wp_head', 'wp_generator' );
	  // remove WP version from css
	  add_filter( 'style_loader_src', 'cerulean_remove_wp_ver_css_js', 9999 );
	  // remove Wp version from scripts
	  add_filter( 'script_loader_src', 'cerulean_remove_wp_ver_css_js', 9999 );

	} /* end head cleanup */
}

// remove WP version from RSS
if( ! function_exists( 'cerulean_rss_version ' ) ) {
	function cerulean_rss_version() { return ''; }
}

// remove WP version from scripts
if( ! function_exists( 'cerulean_remove_wp_ver_css_js ' ) ) {
	function cerulean_remove_wp_ver_css_js( $src ) {
	    if ( strpos( $src, 'ver=' ) )
	        $src = remove_query_arg( 'ver', $src );
	    return $src;
	}
}

// remove injected CSS for recent comments widget
if( ! function_exists( 'cerulean_remove_wp_widget_recent_comments_style ' ) ) {
	function cerulean_remove_wp_widget_recent_comments_style() {
	   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
	      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
	   }
	}
}

// remove injected CSS from recent comments widget
if( ! function_exists( 'cerulean_remove_recent_comments_style ' ) ) {
	function cerulean_remove_recent_comments_style() {
	  global $wp_widget_factory;
	  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
	    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	  }
	}
}

// remove injected CSS from gallery
if( ! function_exists( 'cerulean_gallery_style ' ) ) {
	function cerulean_gallery_style($css) {
	  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
	}
}

/**********************
Enqueue CSS and Scripts
**********************/

// loading modernizr and jquery, and reply script
if( ! function_exists( 'cerulean_scripts_and_styles ' ) ) {
	function cerulean_scripts_and_styles() {
	  if (!is_admin()) {


        wp_deregister_script( 'jquery' );
        wp_deregister_style( 'formidable' );
        wp_deregister_style( 'font-awesome-css' );
        
        //wp_register_script( 'jquery', ( 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js' ), false, null, true );

	    // modernizr (without media query polyfill)
	    //wp_register_script( 'cerulean-modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.6.2', false );

	    // register Google font
	    //wp_register_style('google-font', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Lora:400,700|Droid+Sans+Mono');

	    // ie-only style sheet
	    wp_register_style( 'cerulean-ie-only', get_template_directory_uri() . '/css/ie.css', array(), '' );
		
		if (defined('PRODUCTION') && PRODUCTION == true) {
			//wp_register_script( 'scripts', get_template_directory_uri() . '/js/combined.js' , array(  ), '', true );
			/*
			if (defined('JS_COMBINED') && JS_COMPILED == true) {
				wp_register_script( 'scripts', get_template_directory_uri() . '/js/combined.js' , array(  ), '', true );
			}else{
				*/
				wp_register_script( 'cerulean-base-js', get_template_directory_uri() . '/js/base.min.js' , array(  ), '', true );
				wp_register_script( 'foundation', get_template_directory_uri() . '/js/foundation.min.js' , array(  ), '', true );
				wp_register_script( 'scripts', get_template_directory_uri() . '/js/scripts.min.js' , array(  ), '', true );
			//}
			
		}else{
			wp_register_script( 'cerulean-base-js', get_template_directory_uri() . '/js/base.js' , array(  ), '', true );
			wp_register_script( 'foundation', get_template_directory_uri() . '/js/foundation.js' , array( 'cerulean-base-js' ), '', true );
			wp_register_script( 'scripts', get_template_directory_uri() . '/js/scripts.js' , array( 'cerulean-base-js', 'foundation' ), '', true );
			
		}
	    // comment reply script for threaded comments
        
	    //if( is_singular() && comments_open() && get_option( 'thread_comments' ) )  { wp_enqueue_script( 'comment-reply' ); }
	    
	    // adding Foundation scripts file in the footer
	    //wp_register_script( 'cerulean-js', get_template_directory_uri() . '/js/foundation.min.js', array( 'jquery' ), '', true );
	    
	    	    
	    global $is_IE;
	    if ($is_IE) {
	       wp_register_script ( 'html5shiv', "http://html5shiv.googlecode.com/svn/trunk/html5.js" , false, true);
	    }

	    // enqueue styles and scripts
	    //wp_enqueue_script( 'cerulean-modernizr' );
	    //wp_enqueue_style( 'google-font' );
	    wp_enqueue_style('cerulean-ie-only');
	    /*
	    I recommend using a plugin to call jQuery
	    using the google cdn. That way it stays cached
	    and your site will load faster.
	    */
	    //wp_enqueue_script( 'jquery' );
		
	    //wp_enqueue_script( 'cerulean-js' );
	    wp_enqueue_script( 'html5shiv' );
	    wp_enqueue_script( 'cerulean-base-js' );
	    wp_enqueue_script( 'foundation' );
		wp_enqueue_script( 'scripts' );

	  }
	}
}

// adding the conditional wrapper around ie stylesheet
// source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
if( ! function_exists( 'cerulean_ie_conditional ' ) ) {
	function cerulean_ie_conditional( $tag, $handle ) {
		if ( 'cerulean-ie-only' == $handle )
			$tag = '<!--[if lt IE 9]>' . "\n" . $tag . '<![endif]-->' . "\n";
		return $tag;
	}
}

/*********************
Post related cleaning
*********************/
/* Customized the output of caption, you can remove the filter to restore back to the WP default output. Courtesy of DevPress. http://devpress.com/blog/captions-in-wordpress/ */
if( ! function_exists( 'cerulean_cleaner_caption ' ) ) {
	function cerulean_cleaner_caption( $output, $attr, $content ) {

		/* We're not worried abut captions in feeds, so just return the output here. */
		if ( is_feed() )
			return $output;

		/* Set up the default arguments. */
		$defaults = array(
			'id' => '',
			'align' => 'alignnone',
			'width' => '',
			'caption' => ''
		);

		/* Merge the defaults with user input. */
		$attr = shortcode_atts( $defaults, $attr );

		/* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
		if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
			return $content;

		/* Set up the attributes for the caption <div>. */
		$attributes = ' class="figure ' . esc_attr( $attr['align'] ) . '"';

		/* Open the caption <div>. */
		$output = '<figure' . $attributes .'>';

		/* Allow shortcodes for the content the caption was created for. */
		$output .= do_shortcode( $content );

		/* Append the caption text. */
		$output .= '<figcaption>' . $attr['caption'] . '</figcaption>';

		/* Close the caption </div>. */
		$output .= '</figure>';

		/* Return the formatted, clean caption. */
		return $output;
		
	} /* end cerulean_cleaner_caption */
}

// Clean the output of attributes of images in editor. Courtesy of SitePoint. http://www.sitepoint.com/wordpress-change-img-tag-html/
if( ! function_exists( 'cerulean_image_tag_class ' ) ) {
	function cerulean_image_tag_class($class, $id, $align, $size) {
		$align = 'align' . esc_attr($align);
		return $align;
	} /* end cerulean_image_tag_class */
}

// Remove width and height in editor, for a better responsive world.
if( ! function_exists( 'cerulean_image_editor ' ) ) {
	function cerulean_image_editor($html, $id, $alt, $title) {
		return preg_replace(array(
				'/\s+width="\d+"/i',
				'/\s+height="\d+"/i',
				'/alt=""/i'
			),
			array(
				'',
				'',
				'',
				'alt="' . $title . '"'
			),
			$html);
	} /* end cerulean_image_editor */
}

// Wrap images with figure tag. Courtesy of Interconnectit http://interconnectit.com/2175/how-to-remove-p-tags-from-images-in-wordpress/
if( ! function_exists( 'cerulean_img_unautop ' ) ) {
	function cerulean_img_unautop($pee) {
	    $pee = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<figure>$1</figure>', $pee);
	    return $pee;
	} /* end cerulean_img_unautop */
}
?>