<?php
/*
Template Name: Full Width
*/
get_header(); ?>

<!-- Start the main container -->
<div class="container" role="document">
	<div class="row">

    <!-- Row for main content area -->
    	<div class="small-12 large-12 columns" id="content" role="main">
    	    <main id="main" class="" role="main">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php get_template_part( 'parts/loop', 'page' ); ?>
			    
			    <?php endwhile; endif; ?>							
			    					
			</main> <!-- end #main -->

    
    	</div>
    </div><!-- Row End -->
</div><!-- Container End -->
		
<?php get_footer(); ?>
