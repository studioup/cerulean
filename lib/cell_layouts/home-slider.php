<?php
function register_home_slider_cell_init() {
  register_dd_layout_cell_type (
    'home-slider',
     array ( 'name' => __('home slider', 'cerulean'),
             'icon-css' => 'icon-font',
             'description' => __('A cell that displays home slider.', 'cerulean'),
             'category' => __('Custom cells', 'cerulean'),
             'button-text' => __('Assign home slider cell', 'cerulean'),
             'dialog-title-create' => __('Create a new home slider cell', 'cerulean'),
             'dialog-title-edit' => __('Edit home slider cell', 'cerulean'),
             //'dialog-template-callback' => 'reference_cell_dialog_template_callback',
             'cell-content-callback' => 'home_slider_cell_content_callback',
             'cell-template-callback' => 'home_slider_cell_template_callback',
             'cell-class' => 'home-slider',
            //'register-styles' => array(array('reference-cell-style', get_template_directory_uri() . 'my-style.css')),
            //'register-scripts' => array(array('reference-cell-script', get_template_directory_uri() . 'my-style.js'))
 
            )
    );
}
add_action( 'init', 'register_home_slider_cell_init' );


function home_slider_cell_template_callback() {
 
  // This should return an empty string or the attribute to display.
  // In this case display the ‘text_data’ attribute in the cell template.
 
  return 'home slider';
}

function home_slider_cell_content_callback($cell_settings) {
    ob_start();
    $slides =  get_field('home_slider') ;
    if (!empty($slides)){
    ?> 
    <div class="home-slider-wrapper u-bgsize-cover" data-slick='{"slidesToShow": 1, "autoplay": true, "autoplaySpeed": 5000, "fade": true, "dots": true }' data-equalizer data-equalize-on="medium">
	    
	    <?php foreach($slides as $k => $v){ ?>
		    <div class="home-slide">
			    <div class="row ">
				    <div class="large-12 columns">
					    <div class="row" >
						    <div class="large-6 medium-6 small-12 columns" >
							    <div class="o-tbl" data-equalizer-watch>
								    <div class="o-tbl__row">
								    	<div class="o-tbl__cell">
									    	<div class="text-left little-bottom-padding big-top-padding" >
											    <h2 class="color-white"><?php echo $v['titolo'];?></h2>
											    <h5 class="color-white"><?php echo $v['testo'];?></h5>
											    <div class="little-top-padding">
												    <a href="<?php $v['link_pulsante']; ?>" class="button"><?php echo $v['testo_pulsante'];?></a>
												</div>
									    	</div>
								    	</div>
								    </div>
							    </div>
						    </div>
						    <div class="large-6 medium-6 small-12 columns u-bgsize-contain home-slider-image" data-equalizer-watch <?php the_img_interchange_from_id($v['immagine'],'large-6'); ?>>
							    <div class="home-slider-image-inner"></div>
						    </div>
					    </div>
				    </div>
			    </div>
		    </div>
	    <?php } ?>
    </div>
    
 
    <?php
	}
    return ob_get_clean();
}
