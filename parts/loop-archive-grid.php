<?php 
// Adjust the amount of rows in the grid
$grid_columns = 3; ?>

<?php //if( 0 === ( $wp_query->current_post  )  % $grid_columns ): ?>
<?php if( 0 === ( $wp_query->current_post  )):  ?>

    <div class="row archive-grid" data-equalizer="article-grid"> <!--Begin Row:--> 

<?php endif; ?> 

		<!--Item: -->
		<article class="large-4 medium-6 small-12 columns panel" data-equalizer-watch="article-grid"  role="article">
		
			<a id="post-<?php the_ID(); ?>" <?php post_class('text-center'); ?> href="<?php the_permalink() ?>">
			
				<section class="featured-image" itemprop="articleBody">
    				
    				<?php the_post_thumbnail('full'); ?>
				</section> <!-- end article section -->
			
				<header class="article-header">
					<h3 class="title color-black" ><?php the_title(); ?></h3>			
				</header> <!-- end article header -->	
								
				<section class="entry-content color-text" itemprop="articleBody">
    				<?php echo get_excerpt_chars(100);?>
					<?php //the_content('<button class="tiny">Read more...</button>'); ?> 
				</section> <!-- end article section -->
								    							
			</a> 
			
		</article><!-- end article -->
<?php //if( 0 === ( $wp_query->current_post + 1 )  % $grid_columns ||  ( $wp_query->current_post + 1 ) ===  $wp_query->post_count ): ?>
<?php if( $wp_query->current_post+1 == $wp_query->post_count ): ?>

   </div>  <!--End Row: --> 

<?php endif; ?>

