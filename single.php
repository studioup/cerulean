<?php get_header(); ?>
<!-- Start the main container -->
<div class="container default-vertical-padding" role="document">
	<div class="row">
    <!-- Row for main content area -->
    	<div class="small-12 large-9 medium-9 columns" id="content" role="main">
    	
    	<?php /* Start loop */ ?>
    	<?php while (have_posts()) : the_post(); ?>
    		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
    			<header class="text-center">
	    			
					<img <?php if ( has_post_thumbnail() ) { the_img_interchange_from_id(get_post_thumbnail_id(), 'large-12'); }else{ the_img_interchange_from_id(get_global_option('default_article_image'), 'large-12'); } ?> >

    				
    				<?php 
                    if ( function_exists('yoast_breadcrumb') && !is_front_page()) {
                       //yoast_breadcrumb('<div id="breadcrumbs">','</div>');
                    }
                    ?>
                    <div class="little-bottom-padding default-top-padding">
    					<?php cerulean_entry_meta(); ?>
	    				<h1 class="entry-title color-primary"><?php the_title(); ?></h1>
                    </div>
    			</header>
    			<div class="entry-content">
    				<?php the_content(); ?>
    			</div>
    			<footer>
    				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'cerulean'), 'after' => '</p></nav>' )); ?>
    				<p class="entry-tags"><?php the_tags(); ?></p>
    				<div class="social-sharer">
	                    <!--<h4>Condividi questo articolo</h4>-->
	                    <ul class="no-bullet">
	                        <li>
	                            <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo  urlencode(current_page_url(false)); ?>" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a>
	                        </li>
	                        <li>
	                            <?php 
	                            $twitterTitle= get_the_title().' - '. get_the_excerpt(); 
	                            if( strlen($twitterTitle) > 140 -22- 22){
	                                $twitterTitle = substr($twitterTitle, 0, 140-22-27 ).'...';
	                            }
	
	                            ?>
	                            <a href="http://twitter.com/intent/tweet?status=<?php echo $twitterTitle?>%20<?php echo  urlencode(current_page_url(false)); ?><?php /* %20-%20via%20@FairFaber */ ?>" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a>
	                        </li>
	                        <li>
	                            <?php 
	                            $pinImage = get_post_thumbnail_id( );
	                            if(empty($pinImage))
	                                $pinImage = get_global_option('default_article_image');
	                            ?>
	                            <a href="http://plus.google.com/share?url=<?php echo  urlencode(current_page_url(false)); ?>" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" rel="nofollow"><i class="fa fa-google-plus"></i></a>
	                        </li>
	                        <li>
	                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo  urlencode(current_page_url(false)); ?>&summary=<?php echo get_the_title(); ?>&source=FairFaber" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" rel="nofollow"><i class="fa fa-linkedin"></i></a>
	                        </li>
	                        <li>
	                            <a href="mailto:?subject=Leggi l'articolo &quot;<?php echo get_the_title();?>&quot; su <?php echo esc_url( home_url( '/' ) )?>&amp;body=<?php echo get_the_title() .' - '. get_the_excerpt();?> - <?php echo  urlencode(current_page_url(false)); ?>" onclick="javascript:window.open(this.href,
	'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" rel="nofollow"><i class="fa fa-envelope"></i></a>
	                        </li>
	
	
	
	                    </ul>
	                </div>

    				
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
    		<?php //comments_template(); ?>
    	<?php endwhile; // End the loop ?>
		
    	</div>
    	<?php get_template_part('sidebar','single'); ?>
	</div><!-- Row End -->
</div><!-- Container End -->
		
<?php get_footer(); ?>