<?php

// [bartag foo="foo-value"]


function get_the_post_thumbnail_src( $post_id=false , $size = 'full' ){
    if($post_id==false && $post && is_object( $post ) && $post->ID){
        $post_id = $post->ID;
    }
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
    if(!empty($image) && !empty($image[0])){
        return $image[0];
    }
}

function the_post_thumbnail_src( $post_id=false, $size = 'full' ){
    if($post_id==false && $post){
        $post_id = $post->ID;
    }
    echo get_the_post_thumbnail_src( $post_id, $size );
}


function get_image_src_from_id( $id , $size = 'full' ){
    $image =  wp_get_attachment_image_src( $id , $size );
    if(!empty($image) && !empty($image[0])){
        return $image[0];
    }
    return false;
}




function the_image_src_from_id( $id , $size = 'full' ){
    echo get_image_src_from_id( $id , $size );
}

function get_img_interchange_array_from_id($id,$size = 'large-12'){
    $interchange = false;
	
    
    switch ($size){
        case "off-grid":
            $sizes = array(
                'small' => 'fd-sm', // 0px < 511px                       512px
                'smallplus' => 'fd-md',
                'smallplusR' => 'fd-md',
                'medium' => 'fd-md', // 512px < 1023px                   1024px
                'mediumR' => 'fd-md', // retina 256px < 511px            1024px 
                'large' => 'fd-lg', // 1024 < 1199px                     1200px
                'largeR' => 'fd-lg', // retina 512px < 599px             1200px
                'xlarge' => 'fd-xl', // 1200 < 1439px                    1440px
                'xlargeR' => 'fd-xl', // retina 600px < 719px            1440px
                'xxlarge' => 'fd-xxl', // 1440 < 2047px                  2048px
                'xxlargeR' => 'fd-xxl', // retina 720px < 1023px         2048px
                //'xxxlarge' => 'fd-xxl' , // 2048+                        2048px
                //'xxxlargeR' => 'fd-xxl' , // retina 1024+                2048px
            );
            break;
        case "large-12": 
             $sizes = array(
                'small' => 'fd-sm', // 0px < 511px                       512px
                'smallplus' => 'fd-md',
                'smallplusR' => 'fd-md',
                'medium' => 'fd-md', // 512px < 1023px                   1024px
                'mediumR' => 'fd-md', // retina 256px < 511px            1024px 
                'large' => 'fd-lg', // 1024 < 1199px                     1200px
                'largeR' => 'fd-lg', // retina 512px < 599px             1200px
                'xlargeR' => 'fd-xl', // retina 600px < 719px            1440px
                'xxlargeR' => 'fd-xxl', // retina 720px < 1023px         2048px
            );
             
             
            break;
        case "large-6": 
        case "large-6 medium-6":
            $sizes = array(
                'small' => 'fd-sm', // 0px < 511px                       512px
                'smallplus' => 'fd-md',
                'smallplusR' => 'fd-md',
                'mediumR' => 'fd-md', // retina 256px < 511px            1024px
                'medium' => 'fd-sm', // 512px < 1023px                   512px
                'large' => 'fd-sm2', // 1024 < 1199px                  768px
                'largeR' => 'fd-sm', // retina 512px < 599px             5112px
                'xlargeR' => 'fd-sm2', // retina 600px < 719px           1024px // in questo casi si ferma a 1440px, in teoria sarebbero 1200 ma così copriamo a 3/4 di risoluzione anche i casi in medium-12
                'xxxlargeR' => 'fd-md', // retina 1024+                  1024px // controintuitivo, è 1/2 è quindi massimo metà griglia ~570 < ~600px meno margini vari
            );
            break;
        case "large-6 medium-12":
            $sizes = array(
                'small' => 'fd-sm', // 0px < 511px                       512px
                'smallplus' => 'fd-md',
                'smallplusR' => 'fd-md',
                'mediumR' => 'fd-md', // retina 256px < 511px            1024px
                'medium' => 'fd-md', // 512px < 1023px                   1024px
                'large' =>  'fd-sm2', // 1024 < 1199px                  768px
                'largeR' => 'fd-lg', // retina 512px < 599px             1200px
                'xlargeR' => 'fd-xl', // retina 600px < 719px            1440px // in questo casi si ferma a 1440px, in teoria sarebbero 1200 ma così copriamo a 3/4 di risoluzione anche i casi in medium-12
                'xxxlargeR' => 'fd-md', // retina 1024+                  1024px // controintuitivo, è 1/2 è quindi massimo metà griglia ~570 < ~600px meno margini vari
            );
            break;
        case "large-4": 
        case "large-4 medium-6":
            $sizes = array(
                'small' => 'fd-sm', // 0px < 511px                       512px
                'smallplus' => 'fd-md',
                'smallplusR' => 'fd-md',
                'medium' => 'fd-sm', // 512px < 1023px                   512px // massimo su medium sarà 1/2 invece che 1/3 e a salire diventa 1/3 per cui massimo 400px
                'mediumR' => 'fd-md', // retina 256px < 511px            1024px
                'largeR' => 'fd-lg', // retina 512px < 599px             512px // massimo su medium sarà 1/2 invece che 1/3 1/2 per ci massimo 600px circa
                'xxxlargeR' => 'fd-sm', // retina 1024+                  512px // controintuitivo, è 1/3 è quindi massimo 400px circa meno margini vari
            );
            break;
        case "large-4 medium-4": 
            $sizes = array(
                'small' => 'fd-sm', // 0px < 511px                       512px
                'smallplus' => 'fd-md',
                'smallplusR' => 'fd-md',
                'medium' => 'post-thumbnail', // 512px < 1023px               300px // 1/3 sarebbe circa 333px - margini
                'mediumR' => 'fd-md', // retina 256px < 511px            1024px
                'large' => 'fd-sm', // 1024 < 1199px                     512px // large è 1/3 è quindi massimo 400px circa meno margini vari
                'largeR' => 'fd-sm', // retina 512px < 599px             300px // medium 1/3 per cui massimo 400px circa - margini
                'xxxlargeR' => 'fd-sm', // retina 1024+                  512px // controintuitivo, è 1/3 è quindi massimo 400px circa meno margini vari
            );
        case "large-4 medium-12": 
            $sizes = array(
                'small' => 'fd-sm', // 0px < 511px                       512px
                'smallplus' => 'fd-md',
                'smallplusR' => 'fd-md',
                'medium' => 'fd-md', // 512px < 1023px                   1024px 
                'mediumR' => 'fd-md', // retina 256px < 511px            1024px
                'large' => 'fd-sm', // 1024 < 1199px                     512px // large è 1/3 è quindi massimo 400px circa meno margini vari
                'largeR' => 'fd-lg', // retina 512px < 599px             1200px 
                'xlargeR' => 'fd-xl', // retina 600px < 719px            1440px 
                'xxlarge' => 'fd-xxl', // 1440 < 2047px                  2048px
                'xxxlargeR' => 'fd-sm', // retina 1024+                  512px // controintuitivo, è 1/3 è quindi massimo 400px circa meno margini vari
            );
            break;
        case "large-3":
        case "large-3 medium-3":
            $sizes = array(
                'small' => 'fd-sm', // 0px < 511px                       512px
                'smallplus' => 'fd-md',
                'smallplusR' => 'fd-md',
                'medium' => 'post-thumbnail', // 512px < 1023px               300px
                'mediumR' => 'fd-md', // retina 256px < 511px            1024px 
                'large' => 'post-thumbnail', // 1024 < 1199px                 300px
                'largeR' => 'post-thumbnail', // retina 512px < 599px         300px
                'xlargeR' => 'fd-sm', // retina 600px < 719px            512px
                //'xxlargeR' => 'fd-sm', // retina 720px < 1023px          512px
            );
            break;
        
    }
        
    
    
    $img = wp_get_attachment_metadata($id);
    //var_dump($img);
    if($img){
        $interchange = array();
        foreach($sizes as $k => $size){
            $img_sized =  wp_get_attachment_image_src( $id , $size );
            if(isset( $img_sized[0] )){
                $interchange[$k] = $img_sized[0];
            }else{
	            //$interchange[$k] = '';
            }
            /*
            if(isset($img['sizes']) && isset($img['sizes'][$size]) ){
                $interchange[$k] = $img['sizes'][$size]['url'];
            }else{
                //get_img_src_from_id()
            }
            */
        }
        //echo '<pre>';
        //var_dump($interchange);
        //echo '</pre>';
    }else{

        foreach($sizes as $k => $size){
            $img_sized =  wp_get_attachment_image_src( $id , 'full' );
            if(isset( $img_sized[0] )){
                $interchange[$k] = $img_sized[0];
            }else{
	            //$interchange[$k] = '';
            }
            /*
            if(isset($img['sizes']) && isset($img['sizes'][$size]) ){
                $interchange[$k] = $img['sizes'][$size]['url'];
            }else{
                //get_img_src_from_id()
            }
            */
        }
	    
    }
    return $interchange; 
    /*
    wp_get_attachment_image_src( $id , $size );
    return ''
    [<?php the_field_img('img','fd-sm');?>, small], [<?php the_field_img('img','fd-md');?>, mediumR], [<?php the_field_img('img','fd-lg');?>, largeR], [<?php the_field_img('img','fd-xl');?>, xlargeR], [<?php the_field_img('img','fd-xxl');?>, xxlarge]    
    */
}

function get_img_interchange_from_id($id,$size = 'large-12'){

    $interchange_array = get_img_interchange_array_from_id($id,$size);
    //$dataInterchange = 'data-interchange="';
    foreach($interchange_array as $k => $size){
        $interchange_array[$k] = '['.$size.', '.$k.']';
    }
    return ' data-interchange="'. implode(',',$interchange_array).'" ' ;
}

function the_img_interchange_from_id($id,$size = 'large-12'){
    echo get_img_interchange_from_id($id,$size);
}


function get_img_interchange_from_field($field,$size ='large-12',$post_id = null, $field_fallback = null, $fallback_post_id = null, $global_fallback = true){

	$id = get_field($field,$post_id );
	if(empty($id)){
		if($global_fallback === true || $global_fallback === 'true'){
			$id = get_global_option($field_fallback);
		}else{
			$id = get_field($field_fallback ,$fallback_post_id );
		}
	}else if(is_array($id) && isset($id['ID'])){
		$id = $id['ID'];
	}
	return get_img_interchange_from_id($id,$size);
}

function the_img_interchange_from_field($field,$size ='large-12',$post_id = null, $field_fallback = null, $fallback_post_id = null, $global_fallback = true){
	echo get_img_interchange_from_field($field,$size,$post_id,$field_fallback,$fallback_post_id, $global_fallback);
}




if ( function_exists( 'get_field' ) ) {
    function get_global_option_img($field){
        return get_image_src_from_id( get_global_option($field) );
    }
    
    function the_global_option_img($field){
        echo get_global_option_img($field);
    }
    
    function get_field_img($field, $size = 'full' ){
        return get_image_src_from_id( get_field($field) , $size );
    }
    
    function the_field_img($field, $size = 'full' ){
        echo get_field_img($field, $size );
    }
}else{
    function get_global_option_img($field){
        return false;
    }
    
    function the_global_option_img($field){
        return false;
    }
    
    function get_field_img($field, $size = 'full' ){
        return false;
    }
    
    function the_field_img($field, $size = 'full' ){
        return false;
    }
}

if ( function_exists( 'get_sub_field' ) ) {
    function get_sub_field_img($field, $size = 'full' ){
        return get_image_src_from_id( get_sub_field($field) , $size );
    }
    
    function the_sub_field_img($field, $size = 'full' ){
        echo get_sub_field_img($field, $size );
    }
}else{
    function get_sub_field_img($field, $size = 'full' ){
        return false;
    }
    
    function the_sub_field_img($field, $size = 'full' ){
        return false;
    }
}





