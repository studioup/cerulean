<aside id="sidebar" class="small-12 large-3 medium-3  columns">
	<?php 
	$tags = get_tags();
	if ($tags) {?>
		<article class="panel panel-tags xlittle-bottom-margin">
			<h6 class="uppercase color-primary"><i class="fa fa-tags"></i> <strong>Tags</strong></h6>
			<ul class="no-bullet">
			<?php
			foreach ($tags as $tag) {
				echo '<li><a class="color-black uppercase like-h6" href="' . get_tag_link( $tag->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $tag->name ) . '" ' . '><strong>' . $tag->name.'</strong></a> </li> ';
			}
			?>
			</ul>
		</article>
		<?php
		
	}
	?>
	<?php 
	$recent_posts = wp_get_recent_posts(array('numberposts' => 10));
	if ( $recent_posts && count($recent_posts) ) : ?>
		<article class="panel panel-articles xlittle-vertical-margin">
			<h6 class="uppercase color-primary"><i class="fa fa-tags"></i> <strong><?php _e('Gli ultimi articoli','cerulean')?></strong></h6>
			<?php
				
				foreach( $recent_posts as $recent ){
					?>
					<div class="xxlittle-vertical-margin">
						<div><time class="updated" datetime="<?php echo get_the_time('c',$recent["ID"]) ?>" ><?php echo get_the_time('d/m/Y',$recent["ID"]) ?></time></div>
						<h6><a class="color-black" href="<?php echo get_permalink($recent["ID"]); ?>"><?php echo $recent["post_title"]; ?></a></h6>
					</div>
					<?php
					//echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
				}
			?>
			
	<?php endif; // end have_posts() check ?>
	<?php //dynamic_sidebar("Sidebar"); ?>
</aside><!-- /#sidebar -->