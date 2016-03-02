<?php
function register_social_sharer_cell_init() {
  register_dd_layout_cell_type (
    'social-sharer',
     array ( 'name' => __('social sharer', 'cerulean'),
             'icon-css' => 'icon-font',
             'description' => __('A cell that displays social sharer.', 'cerulean'),
             'category' => __('Custom cells', 'cerulean'),
             'button-text' => __('Assign social sharer cell', 'cerulean'),
             'dialog-title-create' => __('Create a new social sharer cell', 'cerulean'),
             'dialog-title-edit' => __('Edit social sharer cell', 'cerulean'),
             //'dialog-template-callback' => 'reference_cell_dialog_template_callback',
             'cell-content-callback' => 'social_sharer_cell_content_callback',
             'cell-template-callback' => 'social_sharer_cell_template_callback',
             'cell-class' => 'social-sharer',
            //'register-styles' => array(array('reference-cell-style', get_template_directory_uri() . 'my-style.css')),
            //'register-scripts' => array(array('reference-cell-script', get_template_directory_uri() . 'my-style.js'))
 
            )
    );
}
add_action( 'init', 'register_social_sharer_cell_init' );


function social_sharer_cell_template_callback() {
 
  // This should return an empty string or the attribute to display.
  // In this case display the ‘text_data’ attribute in the cell template.
 
  return 'social sharer';
}

function social_sharer_cell_content_callback($cell_settings) {
    ob_start();
    ?> 
    <div class="social-sharer">
	    <h4><?php _e('Share this post','cerulean') ?></h4>
	    <ul class="">
	        <li>
	            <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo  urlencode(current_page_url(false)); ?>" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a>
	        </li>
	        <li>
	            <?php 
	            $twitterTitle= get_the_title().' - '. get_the_excerpt(); 
	            if( strlen($twitterTitle) > 140 -22- 22){
	                $twitterTitle = substr($twitterTitle, 0, 140-22-27 ).'...';
	            }
	
	            ?>
	            <a href="http://twitter.com/intent/tweet?status=<?php echo $twitterTitle?>%20<?php echo  urlencode(current_page_url(false)); ?><?php 
		            if( !empty( get_global_option('twitter_username')) ){ 
			            echo "%20-%20via%20@" . str_ireplace('@', '', get_global_option('twitter_username') ); 
				    } ?>" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a>
	        </li>
	        <li>
	            <?php 
	            global $head_post;
	            $pinImage = get_post_thumbnail_id( $head_post->ID );
	            if(empty($pinImage))
	                $pinImage = get_global_option('default_article_image');
	            ?>
	            <a href="http://plus.google.com/share?url=<?php echo  urlencode(current_page_url(false)); ?>" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" rel="nofollow"><i class="fa fa-google-plus"></i></a>
	        </li>
	        <!--
	        <li>
	            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo  urlencode(current_page_url(false)); ?>&summary=<?php echo get_the_title(); ?>&source=AequorSicurezza" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" rel="nofollow"><i class="fa fa-linkedin"></i></a>
	        </li>
	        <li>
	            <a href="mailto:?subject=Leggi l'articolo &quot;<?php echo get_the_title();?>&quot; su <?php echo esc_url( home_url( '/' ) )?>&amp;body=<?php echo get_the_title() .' - '. get_the_excerpt();?> - <?php echo  urlencode(current_page_url(false)); ?>" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" rel="nofollow"><i class="fa fa-envelope"></i></a>
	        </li>
			-->
	
	
	    </ul>
	</div>
 
    <?php
    return ob_get_clean();
}





