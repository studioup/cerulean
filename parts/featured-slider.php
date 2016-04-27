<div class="row">
	<div class="small-12 large-12 columns" >

		<?php 
			$query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 1 ) );
			$k = 0;
		?>
	<?php if ( $query->have_posts() ) : ?>
		<?php $sticky = true; ?>
		<?php /* Start the Loop */ ?>
		<div class="slider-for">
		<?php while ( $query->have_posts() && $k < 3 ) : $query->the_post(); ?>
			
				<?php 
    			if(is_sticky()){
    			
    				get_template_part( 'parts/content-slider', get_post_format() );
	    			$k++;
    			} 
    			?>
		<?php endwhile; ?>
		</div>
		<?php 
    	$query->rewind_posts();	
    	$k = 0; 
    	?>
		<div class="slider-nav show-for-large" data-equalizer >
		<?php while ( $query->have_posts() && $k < 3 ) : $query->the_post(); ?>
			
				<?php 
    			if(is_sticky()){
    			
    				get_template_part( 'parts/content-slider-nav', get_post_format() );
	    			$k++;
    			} 
    			?>
			
		<?php endwhile; ?>
		</div>
		<?php $sticky = false; ?>
	<?php endif; // end have_posts() check ?>
	</div>
</div>