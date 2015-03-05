<?php get_header(); ?>
<!-- Start the main container -->
<div class="container" role="document">
	<div class="row">
    <!-- Row for main content area -->
    	<div class="small-12 large-12 columns" id="content" role="main">
    	
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
    				<?php reverie_entry_meta(); ?>
    			</header>
    			<div class="entry-content">
    				<?php the_content(); ?>
    			</div>
    			<footer>
    				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'reverie'), 'after' => '</p></nav>' )); ?>
    				<p class="entry-tags"><?php the_tags(); ?></p>
    				<?php edit_post_link('Edit this Post'); ?>
    			</footer>
    		</article>
    		<!-- <div class="entry-author panel">
    			<div class="row">
    				<div class="large-3 columns">
    					<?php echo get_avatar( get_the_author_meta('user_email'), 95 ); ?>
    				</div>
    				<div class="large-9 columns">
    					<h4><?php the_author_posts_link(); ?></h4>
    					<p class="cover-description"><?php the_author_meta('description'); ?></p>
    				</div>
    			</div>
    		</div> -->
    		<?php comments_template(); ?>
    	<?php endwhile; // End the loop ?>
    
    	</div>
	</div><!-- Row End -->
</div><!-- Container End -->
		
<?php get_footer(); ?>