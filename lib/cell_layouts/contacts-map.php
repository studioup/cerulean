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
    
    <div id="map"></div>
    <script>
	(function($) {
		$('.ddl-full-width-row').addClass('expanded').addClass('collapse');
	    mapboxgl.accessToken = 'pk.eyJ1IjoiZXBlaXRhbGlhbmFzcmwiLCJhIjoiY2lrM3c5ZHFiMDAwbXZya3N5NXd3bW01byJ9.9oXyOsEs2LGcZoa6UNJThQ';
		var map = new mapboxgl.Map({
		    container: 'map', // container id
		    style: 'mapbox://styles/epeitalianasrl/cik3wa2tn001y9um64wwn8qxg', //stylesheet location
		    center: [<?php echo $position['lng']?>, <?php echo $position['lat']?>], // starting position
		    zoom: 14 // starting zoom
		});
		map.scrollZoom.disable();
		
		map.on('style.load', function () {
		    map.addSource("markers", {
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
		                    "title": "Mapbox DC",
		                    "marker-symbol": "monument",
		                    'marker-size': 'large',
		                    'marker-color': '#3a53ff',
							'marker-symbol': 'epe-marker'
		                }
		            }]
		        }
		    });
		
		    map.addLayer({
		        "id": "markers",
		        "type": "symbol",
		        "source": "markers",
		        "layout": {
		            "icon-image": "{marker-symbol}",
		            "icon-offset" : [-0,-15],
		            "text-field": "",
		            "text-font": ["Open Sans Semibold", "Arial Unicode MS Bold"],
		            "text-offset": [0, 0.6],
		            "text-anchor": "top"
		        }
		    });
		});
		/*
		map.on('style.load', function () {
			
			
			
			map.addSource("symbols", {
		        "type": "geojson",
		        "data": {
		            "type": "FeatureCollection",
		            "features": [
		                {
		                    "type": "Feature",
		                    "properties": {},
		                    "geometry": {
		                        "type": "Point",
		                        "coordinates": [
		                            <?php echo $position['lng']?>, <?php echo $position['lat']?>
		
		                        ]
		                    }
		                },
		                {
		                    "type": "Feature",
		                    "properties": {},
		                    "geometry": {
		                        "type": "Point",
		                        "coordinates": [
		                            -90.32958984375,
		                            -0.6344474832838974
		                        ]
		                    }
		                },
		                {
		                    "type": "Feature",
		                    "properties": {},
		                    "geometry": {
		                        "type": "Point",
		                        "coordinates": [
		                            -91.34033203125,
		                            0.01647949196029245
		                        ]
		                    }
		                }
		            ]
		        }
		    });
		
		    // add source as a layer and apply some styles
		    map.addLayer({
		        "id": "symbols",
		        "interactive": true,
		        "type": "symbol",
		        "source": "symbols",
		        "layout": {
		            "icon-image": "marker-15"
		        },
		        "paint": {}
		    });
			/*
		    // add geojson data as a new source
		    map.addSource("markers", {
		        "type": "geojson",
		        "data": {
		            "type": "FeatureCollection",
		            "features": [
		                {
		                    "type": "Feature",
		                    "properties": {},
		                    "geometry": {
		                        "type": "Point",
		                        "coordinates": [
		                           <?php echo $position['lng']?>, <?php echo $position['lat']?>, 
		
		                        ]
		                    }
		                }
		            ]
		        }
		    });
		
		    // add source as a layer and apply some styles
		    map.addLayer({
		        "id": "markers-2",
		        "type": "symbol",
		        "source": "markers",
		        "layout": {
		            //"icon-image": "{marker-symbol}-15",
		            //"text-field": "{title}",
		            "text-font": ["Open Sans Semibold", "Arial Unicode MS Bold"],
		            "text-offset": [0, 0.6],
		            "text-anchor": "top"
		        }
		    });
		    
	    });
	    */
		
	})(jQuery);
	</script>
 
    <?php
    return ob_get_clean();
}
