<aside id="sidebar" class="small-12 large-3 medium-3  columns">
	<?php 
	$tags = get_tags();
	if ($tags) {?>
		<article class="panel tags xxlittle-vertical-margin">
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
	<?php //dynamic_sidebar("Sidebar"); ?>
</aside><!-- /#sidebar -->