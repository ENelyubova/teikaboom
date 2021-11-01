$(document).ready(function() {
    /*
     * 
    */
    $(window).scroll(function(){
        fixMenu();
    });
    
    fixMenu();

    function fixMenu() {
        var $menu = $("header");
        if ($(this).scrollTop() <= 205){
            $menu.removeClass("header-fix visible");
        } else if($(this).scrollTop() > 205) {
            $menu.addClass("header-fix animate_visible");
            setTimeout(function(){
                $menu.addClass("visible");
                // $menu.addClass("visible").delay(1000).removeClass('animate_visible');
                setTimeout(function(){
                    $menu.removeClass('animate_visible');
                },100);
            }, 300);
        }
    }

    var menuhome = $('.header-menu .menu .menu-main').html();
    $('.js-load-menu-home').append(menuhome);
    var menucompany = $('.js-footer-company-menu .menu-footer').html();
    $('.js-load-menu-company').append(menucompany);

    /*
     * Menu при адаптации
    */
    // Событие открывания меню на телефонах
    $('.js-menu-mobileNav').on('click', function() {
        var innerWidth = window.innerWidth;
        if (innerWidth > 1000) {
            if($(this).hasClass('active')){
                // $('html').removeClass('htmlmenu');
                $('body').removeClass('bodymenu');
                $(this).removeClass('active');
                $("#menuModal").modal('hide');
                $(".menuModal__icon-close").removeClass('active');
            } else {
                // $('html').addClass('htmlmenu');
                $('body').addClass('bodymenu');
                $(this).addClass('active');
                $("#menuModal").modal('show');
                $(".menuModal__icon-close").addClass('active');
            }
        } else {
            if($(this).hasClass('active')){
                $('html').removeClass('htmlmenu');
                $('body').removeClass('bodymenu');
                $(this).removeClass('active');
                $(".mobileNav, .mobileNav-box, .mobileNav__icon-close").removeClass('active');
            } else {
                $('html').addClass('htmlmenu');
                $('body').addClass('bodymenu');
                $(this).addClass('active');
                $(".mobileNav").addClass('active');
                $(".mobileNav-box").addClass('active');
                $(".mobileNav__icon-close").addClass('active');
            }
        }
        return false;
    });
    $('#menuModal').on('hide.bs.modal', function (e) {
        // $('html').removeClass('htmlmenu');
        $('body').removeClass('bodymenu');
        $(".js-menu-mobileNav").removeClass('active');
        $(".menuModal__icon-close").removeClass('active');
    });

    $('.mobileNav').on('click', function(e){
        if($(e.target).hasClass('mobileNav__icon-close') || $(e.target).parents('.mobileNav__icon-close').length > 0 || $(e.target).hasClass('mobileNav')){
            $('html').removeClass('htmlmenu');
            $('body').removeClass('bodymenu');
            $(".js-menu-mobileNav, .mobileNav, .mobileNav-box, .mobileNav__icon-close").removeClass('active');
        }
    });
    var menumain = $('.header .menu .menu-main').html();
    $('.mobileNav .menu-mobile').append(menumain);
    var menumaincompany = $('.js-footer-company-menu .menu-footer').html();
    $('.mobileNav .menu-mobile').append(menumaincompany);

    $('.mobileNav .menu-mobile li ul').wrap('<div class="menu-mobile-wrapper"></div>');
    $('.mobileNav .menu-mobile li a').click(function(){
        var parent = $(this).parent();
        if(parent.hasClass('submenuItem')){
            parent.find(".menu-mobile-wrapper:first").addClass('active').prepend('<a class="prevLink" href="#">Назад</a>');
            return false;
        }
    });

    $('.mobileNav .menu-mobile li.listItemParent').each(function(i){
        if($(this).hasClass('submenuItem')){
            var el = $(this).find('a:first');
            var link_href = el.attr('href');
            link = "<a class='listItem-nav__link' href='"+link_href+"'>"+el.html()+"</a>";
            $(this).find(".menu-mobile-wrapper ul:eq(0)").prepend("<li class='listItem listItem-nav'>" + link + "</li>");
            appendLi($(this).find(".menu-mobile-wrapper ul:eq(0) > li.submenuItem"), link);
        }
    });

    function appendLi(element, link_prev){
        var link_res;
        var count = 1;
        element.each(function(index){
            link_res = link_prev;
            if($(this).hasClass('listItemFloor')){
                link_prev = '<a class="listItem-nav__link" href="#">Магазины</a>'
            }
            if($(this).hasClass('submenuItem')){
                var el = $(this).find('a:first');
                var link_href = el.attr('href');
                var link_active = "<a class='listItem-nav__link' href='"+link_href+"'>"+el.html()+"</a>";
                link_res += link_active;
                $(this).find(".menu-mobile-wrapper ul:eq(0)").prepend("<li class='listItem listItem-nav'>" + link_prev + link_active + "</li>");
                appendLi($(this).find(".menu-mobile-wrapper ul:eq(0) > li.submenuItem"), link_res);
            }
        })
    }

    $(document).delegate('.mobileNav .menu-mobile .prevLink', 'click', function(){
        var el = $(this);
        var parent = $(this).parent();
        if(parent.hasClass('active')){
            parent.removeClass('active');
            setTimeout(function(){
                el.remove();
            }, 600);
        }
        return false;
    });
    /**********************************************/
    
});