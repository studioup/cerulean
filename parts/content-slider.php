<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @subpackage cerulean
 * @since cerulean 4.0
 */
 global $sticky, $wp_query ;
 if($sticky){
	 $imgEq = 'large-12';
 }else{
	 $imgEq = 'large-6';
 }
 
?>

<article id="post-slider-<?php the_ID(); ?>" class="u-bgsize-cover o-box o-box--16_9" <?php if ( has_post_thumbnail() ) { the_img_interchange_from_id(get_post_thumbnail_id(), $imgEq); }else{ the_img_interchange_from_id(get_global_option('default_article_image'), $imgEq); } ?> >
	<a href="<?php the_permalink(); ?>" class="article-link "  <?php /* data-equalizer-watch="article-<?php the_ID(); ?>" */ ?>>
		<div class="article-content xlittle-vertical-padding xlittle-horizontal-padding">
			<div class="color-white article-meta">
				<?php $categories = wp_get_post_terms( get_the_ID(), 'category' ); ?>
				<?php if(is_array($categories) && count($categories)){?>
					<strong class=""><?php echo $categories[0]->name; ?></strong>
				<?php } ?>	
				<?php cerulean_entry_meta(); ?>
			</div>
			<div class="like-h4 color-white" ><?php the_title(); ?></div>
		</div>
	</a>
</article>
