<?php
/*
Template Name: Sidebar
*/
get_header(); ?>

<!-- Start the main container -->
<div class="container" role="document">
	<div class="row">
    	
    <!-- Row for main content area -->
    	<div class="small-12 large-8 columns" id="content" role="main">
    	
    	<?php /* Start loop */ ?>
    	<?php while (have_posts()) : the_post(); ?>
    		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    			<header>
    				<h1 class="entry-title"><?php the_title(); ?></h1>
    				<?php 
                    if ( function_exists('yoast_breadcrumb') && !is_front_page()) {
                       yoast_breadcrumb('<div id="breadcrumbs">','</div>');
                    }
                    ?>
    				<?php //cerulean_entry_meta(); ?>
    			</header>
    			<div class="entry-content">
    				<?php the_content(); ?>
    			</div>
    			<footer>
    				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'cerulean'), 'after' => '</p></nav>' )); ?>
    			</footer>
    			<?php //comments_template(); ?>
    		</article>
    		
    	<?php endwhile; // End the loop ?>
    
    	</div>
    	<?php get_sidebar(); ?>
	</div><!-- Row End -->
</div><!-- Container End -->    	

<?php get_footer(); ?>