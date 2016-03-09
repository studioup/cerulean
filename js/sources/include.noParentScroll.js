(function($) {

    var INITIAL_Y = 0;

    $.fn.noParentScroll = function() {

        // Evitiamo che scrollando il target oltre la sua altezza, scrolli anche il div sottostante

        $(this).on('DOMMouseScroll mousewheel touchstart', function (ev) {

            if (ev.type === 'touchstart') {
                INITIAL_Y = ev.originalEvent.touches[0].clientY;
            }

            var $this = $(this),
            scrollTop = this.scrollTop,
            scrollHeight = this.scrollHeight,
            height = $this.height(),
            currentScroll = scrollTop + height,
            delta = ev.originalEvent.wheelDelta,
            up = delta > 0;

            var prevent = function () {
                ev.stopPropagation();
                ev.preventDefault();
                ev.returnValue = false;
                return false;
            };

            if (!up && -delta > scrollHeight - height - scrollTop) {
                // Scrolling down, but this will take us past the bottom.
                $this.scrollTop(scrollHeight);
                return prevent();
            } else if (up && delta > scrollTop) {
                // Scrolling up, but this will take us past the top.
                $this.scrollTop(0);
                return prevent();
            }
            
        });

        $(this).on( 'touchmove', function( ev ) {

            // Fix iOS Safari

            var scroll_delta = INITIAL_Y - ev.originalEvent.touches[0].clientY;
            var scroll_pos = this.scrollTop;         
            var at_bottom = (scroll_pos + $(this).height()) == this.scrollHeight;

            if ( (scroll_delta < 0 && scroll_pos === 0) || (scroll_delta > 0 && at_bottom) ){
                ev.preventDefault();
            } 
        });

    };

    var navOpen = false;

    $('[data-toggle-nav]').click(function(event) {

        // Includi nei menu a comparsa quando si clicca su un elemento con attributo “data-toggle-nav” (es.: data-toggle-nav="#nav")

        var nav = $(this).data('toggle-nav');
        if(navOpen === false){
            $(nav).noParentScroll();
            navOpen = true;
        }else{
            // Riportiamo lo scroll alla normalità
            $(nav).unbind('DOMMouseScroll mousewheel touchstart touchmove');
            navOpen = false;
        }
    });

})(jQuery);