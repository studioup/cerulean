// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs

(function($) {
    
    //inject special media queries for interchange on retina devices
    var retinaQueries = configShared.mediaqueries.retina.replace("'","").split(",");
    configShared.breakpoints = JSON.parse( configShared.breakpoints.replace(/\s?\(\s?/i, '{"').replace(/\s?\)\s?/i, '"}').replace(/\s?(\,|\:)\s?/ig,'"$1"'));
    
    var sizes = ['medium','large','xlarge','xxlarge','xxxlarge'];
    for( var k in sizes ){
        var mediaQuerySize = configShared.breakpoints[sizes[k]].match(/([0-9]{1,4})([a-z]{1,3})/i);
        Foundation.Interchange.SPECIAL_QUERIES[sizes[k]+'R'] = "";//"only screen and (min-width: "+configShared.breakpoints[sizes[k]]+")";
        for(var k2 in retinaQueries){
            if(k2 !== 0){
                Foundation.Interchange.SPECIAL_QUERIES[sizes[k]+'R'] += ', ';
            }
            Foundation.Interchange.SPECIAL_QUERIES[sizes[k]+'R'] += retinaQueries[k2] + ' and (min-width: '+ parseInt(mediaQuerySize[1])/2 + mediaQuerySize[2] +')';
        }
        
    }
    
    $(document).foundation();


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
