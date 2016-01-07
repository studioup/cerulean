<?php 
// Adjust the amount of rows in the grid
$grid_columns = 3; ?>

<?php if( 0 === ( $wp_query->current_post  )):  // % $grid_columns ?>

    <div class="row archive-grid" data-equalizer="article-grid"> <!--Begin Row:--> 

<?php endif; ?> 

		<!--Item: -->
		<article class="large-4 medium-6 small-12 columns panel xxlittle-vertical-margin wow fadeInRight" data-wow-delay="<?php echo ($wp_query->current_post%$grid_columns *0.2) + ( floor($wp_query->current_post/$grid_columns) * 0.1); ?>s" data-equalizer-watch="article-grid"  role="article">
		
			<a id="post-<?php the_ID(); ?>" <?php post_class('text-center little-vertical-padding xxlittle-horizontal-padding'); ?> href="<?php the_permalink() ?>">
			
				<section class="featured-image wow fadeIn" data-wow-delay="0.3s" itemprop="articleBody">
    				<img src="<?php the_field_img('icona') ?>">
    				<?php //the_post_thumbnail('full'); ?>
				</section> <!-- end article section -->
			
				<header class="article-header">
					<h3 class="title color-black" ><?php the_title(); ?></h3>	
					<?php //get_template_part( 'parts/content', 'byline' ); ?>				
				</header> <!-- end article header -->	
								
				<section class="entry-content color-text" itemprop="articleBody">
    				<?php the_field('descrizione_corta');?>
					<?php //the_content('<button class="tiny">Read more...</button>'); ?> 
				</section> <!-- end article section -->
								    							
			</a> <!-- end article -->
			
		</article>

<?php if( $wp_query->current_post+1 == $wp_query->post_count ): //if( 0 === ( $wp_query->current_post + 1 )  % $grid_columns ||  ( $wp_query->current_post + 1 ) ===  $wp_query->post_count ): ?>

   </div>  <!--End Row: --> 

<?php endif; ?>

