// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs

(function($) {
    
    if($(".animsition").length){
        $('.wow').css('visibility', 'hidden').css('animation-name', 'none');
        $(".animsition").animsition({
            inClass: 'fade-in',
            outClass: 'fade-out',
            inDuration: 1500,
            outDuration: 800,
            linkElement: ':not(.flex-control-nav li) > a:not([target="_blank"]):not([href^=#]):not(.no-animation):not([data-scroll-target])',
            // e.g. linkElement: 'a:not([target="_blank"]):not([href^=#])'
            loading: true,
            loadingParentElement: 'body', //animsition wrapper element
            loadingClass: 'animsition-loading',
            unSupportCss: [
              'animation-duration',
              '-webkit-animation-duration',
              '-o-animation-duration'
            ],
            //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
            //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
            overlay : false,
            overlayClass : 'animsition-overlay-slide',
            overlayParentElement : 'body'
        }).one('animsition.start', function(){
            setTimeout(function(){ 
                wow.init();
            }, 500);
        }).one('animsition.end', function(){
            //wow.init();
    
        });
    }else{
        wow.init();
    }
    
    
    $(document).foundation({
        reveal: {
            opened: function() {
                //responsiveCarousel('.c-related-products-carousel',1220,5);
                revealButton();
            }
        }
    });
    
    
    responsiveCarousel('.responsive-carousel',1220,5);

    function responsiveCarousel(carouselClass, rowWidth, items){
        // store the slider in a local variable
            var $window = $(window),
                sliderObj = $(carouselClass),
                flexsliderHandle = [],
                itemWidth = rowWidth/items;

          // tiny helper function to add breakpoints
          function getGridSize() {
              if( rowWidth <= sliderObj.innerWidth()  ){
                  return items;
              }else{
                  return Math.floor( sliderObj.innerWidth() / itemWidth );
              }

          }


        sliderObj.each(function(){
            flexsliderHandle.push( $(this).flexslider({
                animation: "slide",
                animationLoop: false,
                itemWidth: itemWidth,
                itemMargin: 0,
                controlNav: false,
                allowOneSlide: true,
                touch: false,
                minItems: getGridSize(), // use function to pull in initial value
                maxItems: getGridSize() // use function to pull in initial value
            }));

        })


          // check grid size on resize event
          $window.resize(function() {
            var gridSize = getGridSize();
            for (i in flexsliderHandle){
                //console.log(flexsliderHandle[i]);
                if(typeof flexsliderHandle[i].data('flexslider') != 'undefined' ){
                    flexsliderHandle[i].data('flexslider').vars.minItems = gridSize;
                    flexsliderHandle[i].data('flexslider').vars.maxItems = gridSize;
                }
            }

          });

    }

    
    revealButton();
    function revealButton(){

        $('.reveal-button').unbind('click.reveal tap.reveal');
        $('.reveal-button').on('click.reveal tap.reveal',function(e){
            e.preventDefault();
            $('#mainModal').foundation('reveal', 'close');
            $('#mainModalFrame').find('.c-related-products-carousel').remove();
            var link = $(this).attr('data-ajax-url');
            $.get( link ,function(content) {
                var content = $(content).find('.article-wrapper').html();
                $('#mainModalFrame').html(content);
                $('#mainModal').foundation('reveal', 'open');

            });
        });
    }

    $('.flexslider').flexslider({
        animation: "slide",
        touch: false
    });
    
    $('.simple-slider').flexslider({
        animation: "slide",
        touch: false
    });


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
