<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @subpackage cerulean
 * @since cerulean 4.0
 */
 global $sticky, $wp_query ;
 if($sticky){
	 $imgEq = 'large-3';
 }else{
	 $imgEq = 'large-6';
 }
 
?>
<div class="article-wrapper">
	<div class="article-card-img u-bgsize-cover o-box" <?php if ( has_post_thumbnail() ) { the_img_interchange_from_id(get_post_thumbnail_id(), $imgEq); }else{ the_img_interchange_from_id(get_global_option('default_article_image'), $imgEq); } ?> <?php /* data-equalizer-watch="article-<?php the_ID(); ?>" */ ?>>
	</div>
	<div class="article-content" data-equalizer-watch>
		<?php $categories = wp_get_post_terms( get_the_ID(), 'category' ); ?>
		<div class="article-categories">
		<?php if(is_array($categories) && count($categories)){?>
			<strong class="color-dark-gray"><?php echo $categories[0]->name; ?></strong>
		<?php } ?>
		</div>	 
		<div class="like-h5 color-black article-title" ><?php the_title(); ?></div>
	</div>

</div>
