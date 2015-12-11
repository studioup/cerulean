<?php get_header(); ?>
			
    <div class="container" role="document">
    	<div class="row">
		
		    <main id="content" class="large-8 medium-8 columns" role="main">
			    
		    	<header>
		    		<h1 class="page-title"><?php echo post_type_archive_title(); ?></h1>
		    		<?php 
                    if ( function_exists('yoast_breadcrumb') && !is_front_page()) {
                       yoast_breadcrumb('<div id="breadcrumbs">','</div>');
                    }
                    ?>
					<?php the_archive_description('<div class="taxonomy-description">', '</div>');?>
		    	</header>
		
		    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			 
					<!-- To see additional archive styles, visit the /parts directory -->
					<?php get_template_part( 'parts/loop', 'archive' ); ?>
				    
				<?php endwhile; ?>	

					<?php /* Display navigation to next/previous pages when applicable */ ?>
                	<?php if ( function_exists('cerulean_pagination') ) { cerulean_pagination(); } else if ( is_paged() ) { ?>
                		<nav id="post-nav">
                			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'cerulean' ) ); ?></div>
                			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'cerulean' ) ); ?></div>
                		</nav>
                	<?php } ?>
					
				<?php else : ?>
											
					<?php get_template_part( 'parts/content', 'missing' ); ?>
						
				<?php endif; ?>
		
			</main> <!-- end #main -->
	
			<?php get_sidebar(); ?>
	    
	    </div> <!-- end #inner-content -->
	    
	</div> <!-- end #content -->

<?php get_footer(); ?>