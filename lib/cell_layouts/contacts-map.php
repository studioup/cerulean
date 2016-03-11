<?php
function register_contacts_map_cell_init() {
  register_dd_layout_cell_type (
    'contacts-map',
     array ( 'name' => __('Contacts map', 'cerulean'),
             'icon-css' => 'icon-font',
             'description' => __('A cell that displays Contacts map.', 'cerulean'),
             'category' => __('Custom cells', 'cerulean'),
             'button-text' => __('Assign Contacts map cell', 'cerulean'),
             'dialog-title-create' => __('Create a new Contacts map cell', 'cerulean'),
             'dialog-title-edit' => __('Edit Contacts map cell', 'cerulean'),
             //'dialog-template-callback' => 'reference_cell_dialog_template_callback',
             'cell-content-callback' => 'contacts_map_cell_content_callback',
             'cell-template-callback' => 'contacts_map_cell_template_callback',
             'cell-class' => 'contacts-map',
            //'register-styles' => array(array('reference-cell-style', get_template_directory_uri() . 'my-style.css')),
            //'register-scripts' => array(array('reference-cell-script', get_template_directory_uri() . 'my-style.js'))
 
            )
    );
}
add_action( 'init', 'register_contacts_map_cell_init' );


function contacts_map_cell_template_callback() {
 
  // This should return an empty string or the attribute to display.
  // In this case display the ‘text_data’ attribute in the cell template.
 
  return 'technical data';
}

function contacts_map_cell_content_callback($cell_settings) {
    ob_start();
    $position =  get_field('map') ;
    ?> 
    
    <div class="contacts-map-wrapper">
    	<div id="map"></div>
    </div>
    <script>
	window.mapCenter = [<?php echo $position['lng']?>, <?php echo $position['lat']?>];
	window.mapMarkers = {
		        "type": "geojson",
		        "data": {
		            "type": "FeatureCollection",
		            "features": [{
		                "type": "Feature",
		                "geometry": {
		                    "type": "Point",
		                    "coordinates": [<?php echo $position['lng']?>, <?php echo $position['lat']?>]
		                },
		                "properties": {
		                    //"title": "Mapbox DC",
		                    //"marker-symbol": "monument",
		                    //'marker-size': 'large',
		                    //'marker-color': '#3a53ff',
							'marker-symbol': 'location-color_pin'
		                }
		            }]
		        }
		    };

	</script>
 
    <?php
    return ob_get_clean();
}
