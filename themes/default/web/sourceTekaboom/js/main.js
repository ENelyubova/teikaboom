$(document).ready(function() {
    /**********************************************/
    /*
     *** Кнопка больше информации СЕО-ТЕКСТ ***
    */
    $('.js-seo-txt-section-link').on('click', function(){
        var parent = $('.js-seo-txt-section');
        var txt = $(this).data('text');
        var txt_hidden = $(this).html();
        var height = parent.find('.js-seo-txt-more').height();
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            parent.removeClass('active').attr('style', '');
            $(this).html(txt).data('text', txt_hidden);
        } else {
            $(this).addClass('active');
            parent.addClass('active').css('max-height', height);
            $(this).html(txt).data('text', txt_hidden);
        }
        return false;
    });
    /**********************************************/
    
    /*
    * JSCollapse
    */
    if($('div').hasClass('js-collapse')){
        // клик для открытия или закрытия
        $(document).delegate('.js-collapse .js-collapse-header', 'click', function(){
            var parent = $(this).parents('.js-collapse');
            if(parent.hasClass('active')) {
                parent.removeClass('active');
                parent.find('.js-collapse-body').slideUp('fast', function (){
                    $(this).css({
                        'height': '',
                        'display': 'none'
                    });
                });
            } else {
                parent.addClass('active');
                parent.find('.js-collapse-body').slideDown('fast', function (){
                    $(this).css({
                        'height': '',
                        'display': 'block'
                    });
                });
            }
            return false;
        });
    }
    
    /* выделить открытый пункт */
    $('.parkView-nav .parkView-nav__link').each(function() {
        var url = window.location.href;
        url = url.split('#')[0].split('?')[0];
        if (location.protocol+"//"+location.hostname+'/'+$(this).attr('href') == url) {
            $(this).addClass('active');
        }
        if (location.protocol+"//"+location.hostname+$(this).attr('href') == url) {
            $(this).addClass('active');
        }
    });


    /* 
        * Контакты скролл к элементу
     */
    
    $(".js-contact-item-scrolling").on('click', function(){
		var href = $(this).attr('href');
		var top = $(href).offset().top - 80;
	    $('body,html').animate({
	        scrollTop: top + 'px'
	    }, 400);
	    return false;
	});

    
});

// @prepros-append "./lib/modernizr-custom.js"
// @prepros-append "./lib/slick.js"
// @prepros-append "./lib/jquery.inputmask.js"
// @prepros-append "./lib/_menu.js"
// @prepros-append "./lib/_carousel.js"
// @prepros-append "./lib/_form.js"
// @prepros-append "./lib/_filter.news.js"
// @prepros-append "./lib/fancybox.js"
// @prepros-append "./lib/aos.js"
// @prepros-append "./lib/video.js"