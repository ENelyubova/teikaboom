/**********************************************/
/*
    * Слайдеры
*/
/**********************************************/

$(document).ready(function() {
    /* Главный слайд */
    if($('div').hasClass('slide-box-carousel')){
        var slide = $('.slide-box-carousel');
        slide.slick({
            fade: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            dots: true,
            arrows: false,
        });
    }
    /**********************************************/
    
    /* Карусель пунктов на странице парка */
    if($('div').hasClass('parkView-nav-carousel')){
        var parkNav = $('.parkView-nav-carousel');
        parkNav.slick({
            fade: false,
            infinite: false,
            variableWidth: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            dots: false,
            arrows: false,
            outerEdgeLimit: true,
        });
    }
    /**********************************************/
    
    /* Карусель галереи на странице парка */
    if($('div').hasClass('parkView-carousel')){
        var parkCarousel = $('.parkView-carousel');
        parkCarousel.slick({
            fade: false,
            infinite: false,
            touchMove: false,
            variableWidth: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            dots: false,
            arrows: true,
            outerEdgeLimit: true,
            prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="30" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M28.7559 43.0527L15.8941 29.9999L28.7559 16.9471L30.8928 19.0527L21.5839 28.4999H43V31.4999H21.5839L30.8928 40.9471L28.7559 43.0527Z" fill="#013D57"/></svg></button>',
            nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="30" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M32.2441 16.9473L45.1059 30.0001L32.2441 43.0529L30.1072 40.9473L39.4161 31.5001H18V28.5001H39.4161L30.1072 19.0529L32.2441 16.9473Z" fill="#013D57"/></svg></button>',
        });
    }
    /**********************************************/
    
    /* Карусель галереи на странице парка */
    if($('div').hasClass('parkView-childpage-carousel')){
        var childpageCarousel = $('.parkView-childpage-carousel');
        childpageCarousel.slick({
            fade: false,
            infinite: true,
            variableWidth: true,
            touchMove: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            dots: false,
            arrows: true,
            outerEdgeLimit: true,
            prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><svg width="25" height="50" viewBox="0 0 25 50" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0)"><path class="circle" d="M-25 25C-25 11.1929 -13.8071 0 0 0C13.8071 0 25 11.1929 25 25C25 38.8071 13.8071 50 0 50C-13.8071 50 -25 38.8071 -25 25Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M10.2928 15.293L11.707 16.7072L3.41414 25.0001L11.707 33.293L10.2928 34.7072L0.585711 25.0001L10.2928 15.293Z" fill="#013D57"/></g><defs><clipPath id="clip0"><rect width="25" height="50"/></clipPath></defs></svg></button>',
            nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><svg width="25" height="50" viewBox="0 0 25 50" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0)"><path class="circle" d="M0 25C0 11.1929 11.1929 0 25 0C38.8071 0 50 11.1929 50 25C50 38.8071 38.8071 50 25 50C11.1929 50 0 38.8071 0 25Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M14.7072 34.707L13.293 33.2928L21.5859 24.9999L13.293 16.707L14.7072 15.2928L24.4143 24.9999L14.7072 34.707Z" fill="#013D57"/></g><defs><clipPath id="clip0"><rect width="25" height="50"/></clipPath></defs></svg></button>',
        });
    }
    /**********************************************/
    
    /* Карусель галереи на странице мастер класса */
    if($('div').hasClass('others-masterclass-carousel')){
        var childpageCarousel = $('.others-masterclass-carousel');
        childpageCarousel.slick({
            fade: false,
            infinite: false,
            touchMove: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            dots: false,
            arrows: true,
            outerEdgeLimit: true,
            prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="30" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M28.7559 43.0527L15.8941 29.9999L28.7559 16.9471L30.8928 19.0527L21.5839 28.4999H43V31.4999H21.5839L30.8928 40.9471L28.7559 43.0527Z" fill="#013D57"/></svg></button>',
            nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="30" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M32.2441 16.9473L45.1059 30.0001L32.2441 43.0529L30.1072 40.9473L39.4161 31.5001H18V28.5001H39.4161L30.1072 19.0529L32.2441 16.9473Z" fill="#013D57"/></svg></button>',
            responsive: [
                {
                    breakpoint: 1001,
                    settings: {
                        variableWidth: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    }
    /**********************************************/

    $(window).resize(function () {
        othersNewsCarousel();
    });
    othersNewsCarousel();
    
    function othersNewsCarousel() {
        if($('div').hasClass('others-news-box')){
            var othersNews = $('.others-news-box');
            var innerWidth = window.innerWidth;
            if (innerWidth > 1000) {
                if (othersNews.hasClass('slick-initialized')) {
                    othersNews.slick('unslick');
                }
            }
            else {
                if (!othersNews.hasClass('slick-initialized')) {
                    othersNews.slick({
                        fade: false,
                        infinite: false,
                        variableWidth: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: false,
                        autoplaySpeed: 5000,
                        dots: false,
                        outerEdgeLimit: true,
                        prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="30" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M28.7559 43.0527L15.8941 29.9999L28.7559 16.9471L30.8928 19.0527L21.5839 28.4999H43V31.4999H21.5839L30.8928 40.9471L28.7559 43.0527Z" fill="#013D57"/></svg></button>',
                        nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="30" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M32.2441 16.9473L45.1059 30.0001L32.2441 43.0529L30.1072 40.9473L39.4161 31.5001H18V28.5001H39.4161L30.1072 19.0529L32.2441 16.9473Z" fill="#013D57"/></svg></button>',
                    });
                }
            }
        }
    }

    /* Карусель меню на странице ресторан */
    if($('div').hasClass('restaurantView-carousel')){
        var restaurantCarousel = $('.restaurantView-carousel');
        restaurantCarousel.slick({
            fade: false,
            infinite: true,
            touchMove: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 5000,
            dots: false,
            arrows: true,
            outerEdgeLimit: true,
            prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"><svg width="25" height="50" viewBox="0 0 25 50" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0)"><path class="circle" d="M-25 25C-25 11.1929 -13.8071 0 0 0C13.8071 0 25 11.1929 25 25C25 38.8071 13.8071 50 0 50C-13.8071 50 -25 38.8071 -25 25Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M10.2928 15.293L11.707 16.7072L3.41414 25.0001L11.707 33.293L10.2928 34.7072L0.585711 25.0001L10.2928 15.293Z" fill="#013D57"/></g><defs><clipPath id="clip0"><rect width="25" height="50"/></clipPath></defs></svg></button>',
            nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"><svg width="25" height="50" viewBox="0 0 25 50" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0)"><path class="circle" d="M0 25C0 11.1929 11.1929 0 25 0C38.8071 0 50 11.1929 50 25C50 38.8071 38.8071 50 25 50C11.1929 50 0 38.8071 0 25Z" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M14.7072 34.707L13.293 33.2928L21.5859 24.9999L13.293 16.707L14.7072 15.2928L24.4143 24.9999L14.7072 34.707Z" fill="#013D57"/></g><defs><clipPath id="clip0"><rect width="25" height="50"/></clipPath></defs></svg></button>',
            responsive: [
                {
                    breakpoint: 1240,
                    settings: {
                        slidesToShow: 3,
                    },
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 400,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ]
        });
    }
    /**********************************************/
});