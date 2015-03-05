<?php get_header(); ?>
<!-- Start the main container -->
<div class="container" role="document">
	<div class="row">
    <!-- Row for main content area -->
    	<div class="small-12 large-8 columns" id="content" role="main">
    	
    		<h2><?php _e('Search Results for', 'cerulean'); ?> "<?php echo get_search_query(); ?>"</h2>
            <?php 
            if ( function_exists('yoast_breadcrumb') && !is_front_page()) {
               yoast_breadcrumb('<div id="breadcrumbs">','</div>');
            }
            ?>
    	<?php if ( have_posts() ) : ?>
    	
    		<?php /* Start the Loop */ ?>
    		<?php while ( have_posts() ) : the_post(); ?>
    			<?php get_template_part( 'content', get_post_format() ); ?>
    		<?php endwhile; ?>
    		
    		<?php else : ?>
    			<?php get_template_part( 'content', 'none' ); ?>
    		
    	<?php endif; // end have_posts() check ?>
    	
    	<?php /* Display navigation to next/previous pages when applicable */ ?>
    	<?php if ( function_exists('cerulean_pagination') ) { cerulean_pagination(); } else if ( is_paged() ) { ?>
    		<nav id="post-nav">
    			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'cerulean' ) ); ?></div>
    			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'cerulean' ) ); ?></div>
    		</nav>
    	<?php } ?>
    
    	</div>
    	<?php get_sidebar(); ?>
	</div><!-- Row End -->
</div><!-- Container End -->
		
<?php get_footer(); ?>