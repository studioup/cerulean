<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
						
	<header class="article-header text-center">
    	<div class="h5-like uppercase color-black"><strong><?php the_field('occhiello') ?></strong></div>
		<h1 class="page-title color-primary"><strong><?php the_title(); ?></strong></h1>
		<?php 
        if ( function_exists('yoast_breadcrumb') && !is_front_page()) {
           yoast_breadcrumb('<div id="breadcrumbs">','</div>');
        }
        ?>
	</header> <!-- end article header -->
					
    <section class="entry-content" itemprop="articleBody">
	    <?php the_content(); ?>
	    <?php wp_link_pages(); ?>
	</section> <!-- end article section -->
						
	<footer class="article-footer">
		
	</footer> <!-- end article footer -->
						    
	<?php //comments_template(); ?>
					
</article> <!-- end article -->