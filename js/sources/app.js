// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs

(function($) {
	
	function wowGrid(){
	    $('[data-wow-grid]').each(function(){
		    var columns;
		    if( parseInt( $(this).attr('data-wow') ) > 0){
			    columns = parseInt( $(this).attr('data-wow') );
		    }else{
		    	columns = Math.floor( $(this).innerWidth() / $(this).children().eq(1).outerWidth() );
		    }
		    $(this).children().each(function(index){
			    var delay = (index % columns *0.2) + ( Math.floor(index/columns) * 0.1);
			    if(columns === 1){
				    
				    $(this).addClass('wow fadeInUp');
			    }else{
				    $(this).addClass('wow fadeInRight');
			    }
			    $(this).attr('data-wow-delay',delay+"s");
			    
		    });
		});
	}
    wowGrid();
    $( window ).resize(function() {
        wowGrid();
    });


    
    $('.ddl-full-width-row').addClass('expanded').addClass('collapse');
    
    //inject special media queries for interchange on retina devices
    var retinaQueries = configShared.mediaqueries.retina.replace("'","").split(",");
    configShared.breakpoints = JSON.parse( configShared.breakpoints.replace(/\s?\(\s?/i, '{"').replace(/\s?\)\s?/i, '"}').replace(/\s?(\,|\:)\s?/ig,'"$1"'));

    
    var sizes = ['smallplus','medium','large','xlarge','xxlarge','xxxlarge'];
    for( var k in sizes ){
        var mediaQuerySize = configShared.breakpoints[sizes[k]].match(/([0-9]{1,4})([a-z]{1,3})/i);
        Foundation.Interchange.SPECIAL_QUERIES[sizes[k]+'R'] = "";//"only screen and (min-width: "+configShared.breakpoints[sizes[k]]+")";
        var i = 0;
        for(var k2 in retinaQueries){
            
            if(i !== 0){
                Foundation.Interchange.SPECIAL_QUERIES[sizes[k]+'R'] += ', ';
            }
            Foundation.Interchange.SPECIAL_QUERIES[sizes[k]+'R'] += retinaQueries[k2] + ' and (min-width: '+ parseInt(mediaQuerySize[1])/2 + mediaQuerySize[2] +')';
            i++;
        }
        
    }
    
    $(document).foundation();
    
    //make interchange work with equalizer
    $(document).on('replaced.zf.interchange', 'img', function(e) {    
	    $(e.target).trigger( 'resizeme.zf.trigger');        
    });
    
    // Remove empty P tags created by WP inside of Accordion and Orbit
    jQuery('.accordion p:empty, .orbit p:empty').remove();
    
	 // Makes sure last grid item floats left
	jQuery( '.archive-grid > .columns' ).last().addClass( 'end' );
	
	// Adds Flex Video to YouTube and Vimeo Embeds
	jQuery( 'iframe[src*="youtube.com"], iframe[src*="vimeo.com"]' ).wrap("<div class='flex-video'/>");
	
	
	
    
    
    // sticky footer and padding for sticky header
    function stickyFooter(){
        var topOffset = 0;
        if($('#main-header').css('position') != 'absolute' && $('#main-header').css('position') != 'fixed' ){
        	topOffset = $('#main-header').outerHeight(true);
        }else{
	        
        }
        var bottomOffset = $('#main-footer').outerHeight(true);
        var bodyOffset = $('body').outerHeight(true) - $('body').innerHeight();
        if($('#main-header').hasClass('sticky')){
            //topOffset = $('#main-header').outerHeight(true);
            $('.page-wrapper').css('margin-top',topOffset);
        }
        
        
        $('.page-wrapper').css('min-height',$(window).innerHeight() - topOffset - bottomOffset - bodyOffset);
        
    }
    stickyFooter();
    
    $( window ).resize(function() {
        stickyFooter();
    });
    
    


    $('[data-slick]').slick();
    

    if($(".animsition").length){
        $('.wow').css('visibility', 'hidden').css('animation-name', 'none');
        $(".animsition").animsition({
            inClass: 'animsition-fade-in',
            outClass: 'animsition-fade-out',
            inDuration: 1500,
            outDuration: 800,
            linkElement: ':not(.flex-control-nav li) > a:not([target="_blank"]):not([href^=#]):not(.no-animation):not([data-scroll-target])',
            // e.g. linkElement: 'a:not([target="_blank"]):not([href^=#])'
            loading: true,
            loadingParentElement: 'body', //animsition wrapper element
            loadingClass: 'animsition-loading',
            //loadingInner: "loading",
            browser: [
              'animation-duration',
              '-webkit-animation-duration',
              '-o-animation-duration'
            ],
            //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
            //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
            overlay : false,
            overlayClass : 'animsition-overlay-slide',
            overlayParentElement : 'body'
        }).one('animsition.inStart', function(){
            window.setTimeout(function(){
                wow.init();
            },500);
        });
    }else{
        wow.init();
    }

// just insert a div like this:
// <div class="o-box" data-map  data-map-id="yourmapid" data-map-key="yourapikey" data-map-lat="45.514719" data-map-lon="9.229454" data-map-zoom="16"  data-map-marker-color="#1ECF92" data-map-marker-size="large" data-map-marker-symbol="circle" data-map-marker-title="Studio Up" data-map-marker-description="Via Esopo 8, Milano"></div>
    if($('[data-map]').length ){
        $('head').append('<link rel="stylesheet" href="https://api.tiles.mapbox.com/mapbox.js/v2.1.6/mapbox.css" type="text/css" />');
        $.getScript("https://api.tiles.mapbox.com/mapbox.js/v2.1.6/mapbox.js", function(){
            var lat = $(this).data('map-lat') || 45.514719, lon = $(this).data('map-lon') || 9.229454;
            $('[data-map]').each(function(){
                L.mapbox.accessToken = $(this).data('map-key');
    
                var map = L.mapbox.map($(this)[0], $(this).data('map-id') || 'examples.map-i86nkdio' ).setView([ lat , lon ], $(this).data('map-zoom') || 16);
    
                if (Modernizr.touch) {
                    map.dragging.disable();
                    if (map.tap) map.tap.disable();
                }else{
                    map.scrollWheelZoom.disable();
                }
                L.mapbox.featureLayer({
                    type: 'Feature',
                    geometry: {
                        type: 'Point',
                        coordinates: [
                            lon,
                            lat
                        ]
                    },
                    properties: {
                        title: $(this).data('map-marker-title') || false,
                        description: $(this).data('map-marker-description') || false,
                        'marker-size': $(this).data('map-marker-size') || 'medium',
                        'marker-color': $(this).data('map-marker-color') || "#00a3d2",
                        'marker-symbol': $(this).data('map-marker-symbol') || ""
                    }
                }).addTo(map);
            });
        });
    }


    outdatedBrowser({
        bgColor: '#c6352b',
        color: '#ffffff',
        lowerThan: 'transform',
        languagePath: ''
    });

})(jQuery);
