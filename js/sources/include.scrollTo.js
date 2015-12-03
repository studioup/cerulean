(function($) {
    $('[data-scroll-target]').on('click',function(){
    	$('html, body').animate({
            scrollTop: $( $(this).data('scroll-target') ).offset().top + parseInt( $(this).data('scroll-offset') || 0 )
        }, parseInt( $(this).data('scroll-duration') || 800 ));
        return false;
    });
})(jQuery);