<?php 
	
// [bartag foo="foo-value"]
function theme_button_shortcode( $atts , $content) {
    $a = shortcode_atts( array(
        'link' => null,
        'field' => null,
        'field_post_id' => null,
        'translate' => false,
        'classes' => '',
        'global_option' => false
    ), $atts );
    
    $link = '';
    if($a['field'] !== null ){
	    if($a['global_option'] === true || $a['global_option'] === 'true'){
		    add_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
	        $link = get_field($a['field'],$a['field_post_id']);
	        remove_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
	    	
	    }else{
		    $link = get_field($a['field'],$a['field_post_id']);
	    }
    }
    if(empty($link)){
	    $link =  $a['link'];
    }
    if(empty($link)){
	    $link = '#';
    }
    $modifier = '';
    
    $site_url = str_replace('https://', 'http://', get_site_url());
    global $sitepress;
	if($sitepress->get_default_language() != ICL_LANGUAGE_CODE){
		$lang='lang='.ICL_LANGUAGE_CODE;
	}else{
		$lang='';
	}
	$classes = $a['classes'];
    
    if($link == '#'){
	    $classes .= ' no-animation';
    }else if(  substr ( $link , 0,1 ) == '/' || substr ( $link , 0,1 ) == "\\" || str_ireplace($site_url, '', str_replace('https://', 'http://', $link) ) != str_replace('https://', 'http://', $link)){
	    if($a['translate'] !== false && !empty($lang)){
		    if(strpos($link, '?') !== false ){
		    	$link .= '&';
		    }else{
			    $link .= '?';
		    }
		    $link .= $lang;
	    }
    }else{
	    $modifier = ' target="_blank" rel="nofollow" ';
    }
	return '<a href="'.$link.'" '.$modifier.' class="button '.$classes.'" >'.do_shortcode($content).'</a>';
    //return "foo = {$a['foo']}";
}
add_shortcode( 'button', 'theme_button_shortcode' );



function theme_center_shortcode( $atts , $content) {
    $a = shortcode_atts( array(
        'classes' => ''
    ), $atts );    
    
    
    //return $content;
	return '<div class="text-center '.$classes.'" >'.do_shortcode($content).'</div>';
    //return "foo = {$a['foo']}";
}
add_shortcode( 'center', 'theme_center_shortcode' );

function theme_icon_arrow_shortcode( $atts , $content) {
    $a = shortcode_atts( array(
        'direction' => 'right',
        'extra_space' => '',
        'wrapper' => true
    ), $atts );    
    $classes = 'nuc ';
	
    switch ($a['direction']) {
	    case 'right':
	        $classes .= "nuc-s-chevron-right";
	        break;
	    case 'down':
	        $classes .= "nuc-s-chevron-down";
	        break;
	    case 'left':
	        $classes .= "nuc-s-chevron-left";
	        break;
	    case 'top':
	        $classes .= "nuc-s-chevron-top";
	        break;
	}
	if($a['extra_space'] == 'left'){
		$wrapper_classes = ' extra-left-space';
	}else if($a['extra_space'] == 'right'){
		$wrapper_classes = ' extra-right-space';
	}else{
		$wrapper_classes = '';
	}
    
    if($a['wrapper'] === 'true' || $a['wrapper'] === true){
	    return '<span class="arrow-wrapper '.$wrapper_classes.'"><i class="'.$classes.'" ></i></span>';
    }else{
    //return $content;
		return '<i class="'.$classes.'" ></i>';
	}
    //return "foo = {$a['foo']}";
}
add_shortcode( 'icon_arrow', 'theme_icon_arrow_shortcode' );

function interchange_img_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'field' => null,
        'field_fallback' => null,
        'fallback_post_id' => null,
        'global_fallback' => true,
        'post_id' => null,
        'id' => null,
        'size' => 'large-12'
    ), $atts );
	if($a['id'] != null){
		return get_img_interchange_from_id($a['id'],$a['size']);
	}else{
		return get_img_interchange_from_field($a['field'],$a['size'],$a['post_id'],$a['field_fallback'], $a['fallback_post_id'], $a['global_fallback']);
	}
    //return "foo = {$a['foo']}";
}
add_shortcode( 'interchange_img', 'interchange_img_shortcode' );


function the_field_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'field' => null,
        'post_id' => null,
    ), $atts );
	
	return get_field($a['field'],$a['post_id']);
	
    //return "foo = {$a['foo']}";
}
add_shortcode( 'the_field', 'the_field_shortcode' );
