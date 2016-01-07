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

<div class="xxlittle-vertical-padding">
	<article id="post-<?php the_ID(); ?>" <?php post_class('index-card wow fadeInUp'); ?> data-wow-delay="<?php echo ($sticky) ? 0 : (0.1 * ( $wp_query->current_post + 1 ) ); ?>s">
		<div class="row collapse" data-equalizer="article-<?php the_ID(); ?>" data-equalize-on="medium">
			<div class="<?php if( $sticky ){?>large-7 medium-7 small-12<?php }else{?> large-5 medium-5 small-12<?php } ?> columns ">
				<a href="<?php the_permalink(); ?>" class="article-card-img u-bgsize-cover" <?php if ( has_post_thumbnail() ) { the_img_interchange_from_id(get_post_thumbnail_id(), $imgEq); }else{ the_img_interchange_from_id(get_global_option('default_article_image'), $imgEq); } ?> data-equalizer-watch="article-<?php the_ID(); ?>">
					
				</a>
			</div>
			<div class="<?php if( $sticky ){?>large-5 medium-5 small-12<?php }else{?> large-7 medium-7 small-12 <?php } ?> columns article-card-content" >
				<div class="xlittle-horizontal-padding xlittle-vertical-padding o-tbl" data-equalizer-watch="article-<?php the_ID(); ?>">
						<div class="o-tbl__row">
							<header class="o-tbl__cell vertical-align-top text-align-left xlittle-bottom-padding">

								<a href="<?php the_permalink(); ?>" >
									<?php cerulean_entry_meta(); ?>
									<h2 class="like-h3 color-black"><?php the_title(); ?></h2>
									<div class="color-text like-h6 entry-content"><?php echo get_excerpt_chars(100); ?></div>
								</a>
							</header>
						</div>
						<div class="o-tbl__row">
							<footer class="o-tbl__cell vertical-align-bottom text-align-left">
								<?php the_tags('<ul class="entry-tags inline-list "><li>', '</li><li>', '</li></ul>' ); ?>
							</footer>
						</div>

					
				</div>
			</div>
		</div>
	</article>
</div>