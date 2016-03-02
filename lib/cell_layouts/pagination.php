<?php
function register_pagination_cell_init() {
  register_dd_layout_cell_type (
    'pagination',
     array ( 'name' => __('pagination', 'cerulean'),
             'icon-css' => 'icon-font',
             'description' => __('A cell that displays pagination.', 'cerulean'),
             'category' => __('Custom cells', 'cerulean'),
             'button-text' => __('Assign pagination cell', 'cerulean'),
             'dialog-title-create' => __('Create a new pagination cell', 'cerulean'),
             'dialog-title-edit' => __('Edit pagination cell', 'cerulean'),
             //'dialog-template-callback' => 'reference_cell_dialog_template_callback',
             'cell-content-callback' => 'pagination_cell_content_callback',
             'cell-template-callback' => 'pagination_cell_template_callback',
             'cell-class' => 'pagination',
            //'register-styles' => array(array('reference-cell-style', get_template_directory_uri() . 'my-style.css')),
            //'register-scripts' => array(array('reference-cell-script', get_template_directory_uri() . 'my-style.js'))
 
            )
    );
}
add_action( 'init', 'register_pagination_cell_init' );


function pagination_cell_template_callback() {
 
  // This should return an empty string or the attribute to display.
  // In this case display the ‘text_data’ attribute in the cell template.
 
  return 'pagination';
}

function pagination_cell_content_callback($cell_settings) {
    ob_start();
    ?> 
    <?php if ( function_exists('cerulean_pagination') ) { cerulean_pagination(); } else if ( is_paged() ) { ?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'cerulean' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'cerulean' ) ); ?></div>
		</nav>
	<?php } ?>
 
    <?php
    return ob_get_clean();
}





