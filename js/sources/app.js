// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
var anim;
(function($) {
	
	function detectIE() {
	  var ua = window.navigator.userAgent;
	
	
	  var msie = ua.indexOf('MSIE ');
	  if (msie > 0) {
	    // IE 10 or older => return version number
	    return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
	  }
	
	  var trident = ua.indexOf('Trident/');
	  if (trident > 0) {
	    // IE 11 => return version number
	    var rv = ua.indexOf('rv:');
	    return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
	  }
	
	  var edge = ua.indexOf('Edge/');
	  if (edge > 0) {
	    // Edge (IE 12+) => return version number
	    //return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
	  }
	
	  // other browser
	  return false;
	}
	function detectEdge() {
	  var ua = window.navigator.userAgent;
	
	
	  
	
	  var edge = ua.indexOf('Edge/');
	  if (edge > 0) {
	    // Edge (IE 12+) => return version number
	    return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
	  }
	
	  // other browser
	  return false;
	}
	if( detectIE() ){
		$('body').addClass('is-ie');
	}
	if( detectEdge() ){
		$('body').addClass('is-edge');
	}
	
	var is_firefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
	
	function wowGrid(){
	    $('[data-wow-grid], .data-wow-grid').each(function(){
		    var columns;
		    var $childrens;
		    var $el = $(this);
		    if( typeof( $el.attr('data-wow-selector') ) != 'undefined' ){
			    $childrens = $el.find( $el.attr('data-wow-selector') );
		    }else{
			    $childrens = $el.children();
		    }
		    
		    if( parseInt( $el.attr('data-wow') ) > 0){
			    columns = parseInt( $el.attr('data-wow') );
		    }else{
		    	columns = Math.floor( $el.innerWidth() / $childrens.eq(1).outerWidth() );
		    }
		    
		    $childrens.each(function(index){
			    var delay = (index % columns *0.2) + ( Math.floor(index/columns) * 0.1);
			    if( !$(this).hasClass('wow') ){
				    if(columns === 1){
					    
					    $(this).addClass('wow fadeInUp');
				    }else{
					    $(this).addClass('wow fadeInRight');
				    }
			    }
			    $(this).attr('data-wow-delay',delay+"s");
			    
		    });
		});
	}
	
	function rowExpandedPadding(){
		var row = $('.row:not(.row .row):not(.expanded)').eq(0);
		if( typeof(row) != 'undefined' && row.outerWidth() <= $(window).width() ){
			var offset = ( $(window).width() - row.outerWidth() ) /2;
			if(Foundation.MediaQuery.atLeast('medium') ){
				offset += 15;
			}else{
				offset += 10;
			}
			$('.row.expanded.autopadding > .columns:first-child').css('padding-left',  offset);
			$('.row.expanded.autopadding > .columns:last-child').css('padding-right',  offset);
		}
	}
	
	
    wowGrid();
    $( window ).resize(function() {
        wowGrid();
    });
    
    function wowList(){
	    $('[data-wow-list], .data-wow-list').each(function(){

		    $(this).children().each(function(index){
			    var delay = 0.2;

			    $(this).addClass('wow fadeInUp');
			    $(this).attr('data-wow-delay',delay+"s");
			    
			    
		    });
		});
	}
    wowList();

	$('[data-disabled]').on('click',function(e){e.preventDefault();});

    
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
    
    
    
    rowExpandedPadding();
    
	$(window).on('resize', Foundation.util.throttle(function(e){
		rowExpandedPadding();
	}, 300));

	if( typeof(map) != 'undefined' && typeof(google) != 'undefined' ){
		$(document).ready(function() {
			$(window).resize(function() {
				google.maps.event.trigger(map, 'resize');
			});
			google.maps.event.trigger(map, 'resize');
		});
	}
    
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
    
    
    
    /* featured posts slider */
    $('.slider-for').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: false,
	  fade: true,
	  asNavFor: '.slider-nav',
	  autoplay: true,
	  autoplaySpeed: 5000,

	});
	$('.slider-for').on('init', function(){
	});
	
	$('.slider-for').on('afterChange', function(event, slick, currentSlide){
		$('.slider-for article').removeClass('slick-timer');
		$('.slider-for article').eq(currentSlide).addClass('slick-timer');
		$('.slider-nav .article-wrapper').removeClass('slick-highlight');
		$('.slider-nav .article-wrapper').eq(currentSlide).addClass('slick-highlight');
	});

	
	$('.slider-nav').slick({
	  slidesToShow: 3,
	  slidesToScroll: 3,
	  asNavFor: '.slider-for',
	  dots: true,
	  centerMode: false,
	  focusOnSelect: true,
	});
	$('.slider-nav').on('setPosition',function(){
		$('.slider-nav [data-equalizer-watch]').trigger( 'resizeme.zf.trigger');
	});
	$('.slider-nav [data-equalizer-watch]').trigger( 'resizeme.zf.trigger');
	$('.slider-for article').eq(0).addClass('slick-timer');
	$('.slider-nav .article-wrapper').eq(0).addClass('slick-highlight');
	
    /* end of featured posts slider */
	
	function fullpageWow(){
		$('body').find('[data-animation]').each(function(){
			
			if( $(this)[0].getBoundingClientRect().top < $(window).height() && $(this)[0].getBoundingClientRect().bottom > 0){

			
	    	//if($(this).visible( true )){
	    			$(this).addClass('animated ' + $(this).data('animation'));
	    	}
    	});
	}
	function fullpageResetWow(){
		$('body').find('[data-animation]').each(function(){
			$(this).removeClass('animated').removeClass( $(this).data('animation') ).css('opacity',0);
		});
	}
	var fullpageMultiScrollHandler = function(e, pos){

		fullpageWow();

	};
	var preventWheel = function(e){
		//console.log(e);
		e.stopPropagation();
        e.preventDefault();
        return false;

	};
	$(document).on("click",'#fp-nav a',function(){
    	var index = $(this).parent().index();
    	$('.fp-section').eq(index).find('.fp-scrollable').slimScroll({ 
        	scrollTo: '0px' 
        });
	});
	
	
	$(window).on('scroll',function(e){
		if($(window).scrollTop() >= $('#main-header').outerHeight() ){
			$('body').addClass('menu-scrolled');
		}else{
			$('body').removeClass('menu-scrolled');
		}
	});
	
    if($(".animsition").length){
        $('.wow').css('visibility', 'hidden').css('animation-name', 'none');
        var outTransitionTime = 800;
        if($('body').hasClass('home')){
	        outTransitionTime = 800;
        }
        $(".animsition").animsition({
            inClass: 'animsition-fade-in',
            outClass: 'animsition-fade-out',
            inDuration: 1500,
            outDuration: outTransitionTime,
            linkElement: ':not(.flex-control-nav li) > a:not([target="_blank"]):not([href^="#"]):not(.no-animation):not([data-scroll-target])',
            // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
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
	        if( $('#fullpage').length > 0 && typeof($.fn.fullpage) != 'undefined' ){
            
	            $('#fullpage').fullpage({
			        //Navigation
			        //menu: '#menu',
			        lockAnchors: false,
			        //anchors:['firstPage', 'secondPage'],
			        navigation: true,
			        navigationPosition: 'right',
			        //navigationTooltips: ['firstSlide', 'secondSlide'],
			        showActiveTooltip: false,
			        slidesNavigation: true,
			        slidesNavPosition: 'bottom',
			
			        //Scrolling
			        css3: true,
			        scrollingSpeed: 700,
			        autoScrolling: true,
			        fitToSection: true,
			        fitToSectionDelay: 1000,
			        scrollBar: false ,
			        easing: 'easeInOutCubic',
			        easingcss3: 'ease',
			        loopBottom: false,
			        loopTop: false,
			        loopHorizontal: true,
			        continuousVertical: false,
			        //normalScrollElements: '#element1, .element2',
			        scrollOverflow: ($(window).width() > 512) ,
			        touchSensitivity: 15,
			        normalScrollElementTouchThreshold: 5,
			
			        //Accessibility
			        keyboardScrolling: true,
			        animateAnchor: true,
			        recordHistory: true,
			
			        //Design
			        controlArrows: true,
			        verticalCentered: true,
			        resize : true,
			        //sectionsColor : ['#ccc', '#fff'],
			        paddingTop: $('#main-header').outerHeight(),
			        paddingBottom: '0px',
			        //fixedElements: '#main-header, .main-footer',
			        responsiveWidth: 512,
			        responsiveHeight: 0,
			
			        //Custom selectors
			        sectionSelector: '.section',
			        slideSelector: '.slide',
			        should_scroll_section: true,
			
			        //events
			        
			        onLeave: function(index, nextIndex, direction){
				        //console.log(nextIndex);
				        //console.log($('#fullpage > .section').eq(nextIndex-1).css('background-color'));
				        $slide = $('#fullpage > .section').eq(nextIndex-1);
				        //$slide.find('.fp-scrollable').slimScroll({ scrollTo: '0px' });//.isOverPanel = false;
				        $('body').removeClass('dark-color-scheme').removeClass('light-color-scheme');
		                $('body').addClass($slide.data('color-scheme'));
		                $slide.find('.fp-scrollable').bindFirst('DOMMouseScroll', preventWheel);
		                $slide.find('.fp-scrollable').bindFirst('mousewheel', preventWheel);
		                
				        if( $slide.outerHeight() >= $(window).height()){
					        $('#main-header').css('background', $slide.css('background-color'));
				        	//$('#main-header').animate({ backgroundColor : $slide.css('background-color')}, 700);
				        }
			        },
			        	
				    onSlideLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex){
				    	
						//console.log("onSlideLeave--" + "anchorLink: " + anchorLink + " index: " + index + " slideIndex: " + slideIndex + " direction: " + direction);
				    },
				    afterRender: function(){
					    //new WOW().init();
					    fullpageResetWow();
				    	$('.fp-scrollable').slimScroll().unbind('slimscrolling', fullpageMultiScrollHandler);
				    	$('.fp-scrollable').slimScroll().bind('slimscrolling', fullpageMultiScrollHandler);
				    	$(window).unbind('scroll',fullpageMultiScrollHandler);
				    	$(window).bind('scroll',fullpageMultiScrollHandler);
				    	$('body').removeClass('dark-color-scheme').removeClass('light-color-scheme');
				    	$('body').addClass( $('.fp-section.active').data('color-scheme') );
				    	fullpageWow();

				    	//console.log("afterRender");
				    },
				    afterResize: function(){
				    	//console.log("afterResize");
				    },
				    afterReBuild: function(){
				    	//console.log("afterReBuild");
				    	fullpageResetWow();
				    	$('.fp-scrollable').slimScroll().unbind('slimscrolling', fullpageMultiScrollHandler);
				    	$('.fp-scrollable').slimScroll().bind('slimscrolling', fullpageMultiScrollHandler);
				    	$('body').removeClass('dark-color-scheme').removeClass('light-color-scheme');
				    	$('body').addClass( $('.fp-section.active').data('color-scheme') );
				    	fullpageWow();

				    },
				    afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex){
					    
					    
				    	//console.log("afterSlideLoad--" + "anchorLink: " + anchorLink + " index: " + index + " slideAnchor: " + slideAnchor + " slideIndex: " + slideIndex);
						//console.log("----------------");
				    },
				    afterLoad: function(anchorLink, index){
					    if( $(this).outerHeight() >= $(window).height()){
						    
					    	//$('#main-header').animate({ backgroundColor : $(this).css('background-color')}, 0);
					    }
					    $(this).find('.fp-scrollable').unbind('DOMMouseScroll', preventWheel);
		                $(this).find('.fp-scrollable').unbind('mousewheel', preventWheel);
					    //$(this).find('.fp-scrollable').slimScroll().isOverPanel = true;
				    	fullpageWow();
						//console.log('===============');
						//console.log("afterLoad--" + "anchorLink: " + anchorLink + " index: " + index );
				    }
				    
				    
			        
			    });
		    } else {
	            window.setTimeout(function(){
	                wow.init();
	            },500);
            }
            
        });
    }else{
        wow.init();
    }
    
    
    // esempio di body movin come da sito cocacola
    if( $('#bodymovin').length > 0 && typeof(bodymovinParams) != 'undefined' ){

	
	    var firstAutoPlay = true;
	
	    anim = bodymovin.loadAnimation(bodymovinParams);
	    /*
	    if($('#bodymovin').data('play-from') != null &&  $('#bodymovin').data('play-to') != null){
		    console.log('playsegments');
	    	anim.playSegments([$('#bodymovin').data('play-from'),$('#bodymovin').data('play-to')],true);
	    }
	    */
	    anim.addEventListener('enterFrame',function(e){
		    //console.log( e);
		    if( Math.ceil( e.currentTime) >= $('#bodymovin').data('play-to') && firstAutoPlay){
	    		anim.pause(); 
	    		firstAutoPlay = false;
	    	}
	    });
	    anim.addEventListener('complete',function(e){
		    //console.log(this);
		    //console.log(e);
		    console.log('complete')
	    });
	    
	    if($('body').hasClass('home')){
		    console.log('home');
		    $(document).off( 'click.animsition' );
		    $(document).on('click.bodymovin' , ':not(.flex-control-nav li) > a:not([target="_blank"]):not([href^="#"]):not(.no-animation):not([data-scroll-target])', function(event) {
	            event.preventDefault();
	            event.stopPropagation();
	            var $self = $(this);
	            var url = $self.attr('href');
	
				anim.play();
				firstAutoPlay = false;
				
				var remainingTime =(anim.totalFrames  - anim.currentFrame) / anim.frameRate;

				//console.log( remainingTime - 0.8);

				setTimeout(function(){ 
					$('.animsition').animsition('out', $self, url);
				}, (remainingTime - 0.4) * 1000);

				
				
	            // middle mouse button issue #24
	            // if(middle mouse button || command key || shift key || win control key)
	            /*
	            if (event.which === 2 || event.metaKey || event.shiftKey || navigator.platform.toUpperCase().indexOf('WIN') !== -1 && event.ctrlKey) {
	              window.open(url, '_blank');
	            } else {
	              __.out.call(_this, $self, url);
	            }
	            */
	
	        });
	    }
	    
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
