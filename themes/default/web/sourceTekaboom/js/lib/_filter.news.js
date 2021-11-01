$(document).ready(function() {
    $(document).delegate('.jsfilter-park-news', 'click', function() {
        var elem = $(this),
            id = elem.data('id'),
            formId = '#news-box',
            form = elem.parents('form'),
            action = form.attr('action');

        var data = {};
        var historyurl = action;

        if(id != 0){
            data = 'park_id='+id;
            historyurl = action+'?'+data;
        }

 
        window.history.pushState(null, document.title, historyurl);

        /* var innerWidth = window.innerWidth;
        
        if(innerWidth > 1000){
            var top = $('#news-box').offset().top - 50;
        
            $('body,html').animate({
                scrollTop: top + 'px'
            }, 400);
        } */

        $('.js-park-item').removeClass('active');
        elem.parents('.js-park-item').addClass('active');
        $('.preloader').addClass('active');

        $.ajax({
            type: 'get',
            data: data,
            url: action,
            success: function (html) {
                var newHtml = $(html).find(formId);

                $(formId).html(newHtml.html());
            },
            complete: function () {
                $('.preloader').removeClass('active');
            }
        });

        return false;
    });

    
    $(document).delegate('.jsfilter-theme-masterclass', 'click', function() {
        var elem = $(this),
            id = elem.data('id'),
            formId = '#masterclass-box',
            form = elem.parents('form'),
            action = form.attr('action');

        var data = {};
        var historyurl = action;

        if(id != 0){
            data = 'theme_id='+id;
            historyurl = action+'?'+data;
        }

 
        window.history.pushState(null, document.title, historyurl);

        
        /* var innerWidth = window.innerWidth;
        
        if(innerWidth > 1000){
            var top = form.offset().top - 20;
            $('body,html').animate({
                scrollTop: top + 'px'
            }, 400);
        } */
        

        $('.jsfilter-theme-masterclass').removeClass('active');
        elem.addClass('active');
        $('.preloader').addClass('active');

        $.ajax({
            type: 'get',
            data: data,
            url: action,
            success: function (html) {
                var newHtml = $(html).find(formId);

                $(formId).html(newHtml.html());
            },
            complete: function () {
                $('.preloader').removeClass('active');
            }
        });

        return false;

        return false;
    });
});