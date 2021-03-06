<?php get_header(); ?>

<!-- Start the main container -->
<div class="container" role="document">
	<div class="row">
    <!-- Row for main content area -->
    	<div class="small-12 large-12 columns" id="content" role="main">
    	
    		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    			<header>
    				<h1 class="entry-title"><?php _e('File Not Found', 'cerulean'); ?></h1>
    			</header>
    			<div class="entry-content">
    				<div class="error">
    					<p class="bottom"><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'cerulean'); ?></p>
    				</div>
    				<p><?php _e('Please try the following:', 'cerulean'); ?></p>
    				<ul> 
    					<li><?php _e('Check your spelling', 'cerulean'); ?></li>
    					<li><?php printf(__('Return to the <a href="%s">home page</a>', 'cerulean'), home_url()); ?></li>
    					<li><?php _e('Click the <a href="javascript:history.back()">Back</a> button', 'cerulean'); ?></li>
    				</ul>
    			</div>
    		</article>
    
    	</div>
	</div><!-- Row End -->
</div><!-- Container End -->
		
<?php get_footer(); ?>