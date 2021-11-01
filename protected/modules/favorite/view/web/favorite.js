/*добавление/удаление товаров в избранное*/
$(document).ready(function () {
    var svg_add = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-0.01 102.831 612.007 586.338" enable-background="new -0.01 102.831 612.007 586.338" xml:space="preserve"><path d="M598.716,368.549c12.047-11.74,16.299-28.97,11.103-44.987c-5.208-16.017-18.773-27.451-35.44-29.877l-148.184-21.532c-6.312-0.919-11.765-4.877-14.583-10.6l-66.249-134.263c-7.438-15.085-22.536-24.46-39.362-24.46c-16.813,0-31.911,9.375-39.35,24.46l-66.261,134.275c-2.819,5.723-8.284,9.681-14.596,10.6L37.61,293.698c-16.654,2.414-30.232,13.86-35.441,29.877c-5.196,16.017-0.943,33.247,11.103,44.987L120.488,473.07c4.571,4.46,6.667,10.882,5.588,17.156l-25.293,147.571c-2.243,12.99,1.164,25.624,9.571,35.588c13.063,15.526,35.87,20.257,54.104,10.674l132.522-69.681c5.539-2.904,12.512-2.88,18.039,0l132.534,69.681c6.446,3.395,13.321,5.109,20.417,5.109c12.953,0,25.232-5.76,33.676-15.783c8.419-9.964,11.813-22.623,9.571-35.588l-25.307-147.571c-1.078-6.287,1.018-12.696,5.589-17.156L598.716,368.549z"/></svg>';
    var svg_remove = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0.002 135.785 595.275 570.325" enable-background="new 0.002 135.785 595.275 570.325" xml:space="preserve"><path d="M582.359,394.256c11.718-11.419,15.854-28.179,10.8-43.758c-5.066-15.58-18.262-26.701-34.473-29.061L414.55,300.494c-6.139-0.894-11.442-4.744-14.185-10.311l-64.438-130.606c-7.235-14.673-21.921-23.792-38.287-23.792c-16.354,0-31.039,9.119-38.274,23.792l-64.451,130.606c-2.741,5.566-8.058,9.417-14.196,10.311L36.582,321.45c-16.199,2.348-29.395,13.469-34.461,29.049c-5.054,15.579-0.917,32.338,10.8,43.758L117.208,495.91c4.446,4.338,6.484,10.584,5.436,16.688L98.03,656.148c-2.766,16.129,3.73,32.113,16.974,41.744c13.231,9.643,30.455,10.895,44.962,3.254l128.902-67.775c5.495-2.885,12.051-2.885,17.546,0l128.913,67.775c6.294,3.314,13.112,4.947,19.895,4.947c8.809,0,17.582-2.754,25.067-8.201c13.243-9.631,19.739-25.615,16.975-41.744l-24.627-143.539c-1.049-6.115,0.989-12.35,5.436-16.688L582.359,394.256z M449.154,516.638l24.615,143.539c1.239,7.225-1.562,14.125-7.498,18.441c-5.948,4.303-13.351,4.826-19.847,1.441L317.51,612.271c-6.21-3.254-13.052-4.898-19.87-4.898s-13.648,1.645-19.87,4.91L148.879,680.06c-6.52,3.385-13.922,2.861-19.858-1.441c-5.936-4.316-8.725-11.205-7.497-18.441l24.614-143.539c2.372-13.852-2.217-27.988-12.277-37.787L29.562,377.187c-5.257-5.125-7.045-12.349-4.769-19.322c2.265-6.985,7.951-11.777,15.21-12.837l144.124-20.943c13.91-2.015,25.938-10.74,32.147-23.351l64.451-130.606c3.242-6.58,9.571-10.501,16.902-10.501c7.343,0,13.66,3.921,16.914,10.501l64.451,130.606c6.21,12.611,18.226,21.336,32.136,23.351l144.136,20.943c7.259,1.061,12.945,5.853,15.21,12.837c2.265,6.973,0.488,14.197-4.769,19.322L461.419,478.839C451.359,488.65,446.77,502.775,449.154,516.638z"/></svg>';
    $(document).on('click', '.yupe-store-favorite-add', function (event) {
        event.preventDefault();
        var $this = $(this);
        var product = parseInt($this.data('id'));
        var data = {'id': product};
        data[yupeTokenName] = yupeToken;
        $.post(yupeStoreAddFavoriteUrl, data, function (data) {
            if (data.result) {
                $('#yupe-store-favorite-total').html(data.count);
                $this.removeClass('yupe-store-favorite-add')
                    .addClass('yupe-store-favorite-remove').addClass('text-error');
                $this.html(svg_add);
                if($(".but-favorite .toolbar-button").hasClass('no-active')){
                    $(".but-favorite .toolbar-button").removeClass('no-active').addClass('active').html(svg_add);
                }
            }
            showNotify($this, data.result ? 'success' : 'danger', data.data);
        }, 'json');
    });

    $(document).on('click', '.yupe-store-favorite-remove', function (event) {
        event.preventDefault();
        var $this = $(this);
        var product = parseInt($this.data('id'));
        var data = {'id': product};
        data[yupeTokenName] = yupeToken;
        $.post(yupeStoreRemoveFavoriteUrl, data, function (data) {
            if (data.result) {
                $('#yupe-store-favorite-total').html(data.count);
                $this.removeClass('yupe-store-favorite-remove')
                    .removeClass('text-error').addClass('yupe-store-favorite-add');
                $this.html(svg_remove);
                if(data.count == 0){
                    $(".but-favorite .toolbar-button").removeClass('active').addClass('no-active').html(svg_remove);
                }
            }
            showNotify($this, data.result ? 'success' : 'danger', data.data);
        }, 'json');
    });

    $(document).on('click', '.favorite-delete', function (event) {
        event.preventDefault();
        var $this = $(this);
        var product = parseInt($this.data('id'));
        var data = {'id': product};
        data[yupeTokenName] = yupeToken;
        $.post(yupeStoreRemoveFavoriteUrl, data, function (data) {
            if (data.result) {
                $('#yupe-store-favorite-total').html(data.count);
                $this.parents('.product-box__item').remove();
                if(data.count == 0){
                    $(".but-favorite .toolbar-button").removeClass('active').addClass('no-active').html(svg_remove);
                    $(".list-view .favorite-box").html('<span class="empty">Нет результатов.</span>');
                }
            }
            showNotify($this, data.result ? 'success' : 'danger', data.data);
        }, 'json');
    });

    $(document).on('click', '.yupe-product-favorite-add', function (event) {
        event.preventDefault();
        var $this = $(this);
        var product = parseInt($this.data('id'));
        var data = {'id': product};
        data[yupeTokenName] = yupeToken;
        $.post(yupeStoreAddFavoriteUrl, data, function (data) {
            if (data.result) {
                $('#yupe-store-favorite-total').html(data.count);
                $this.removeClass('yupe-product-favorite-add')
                    .addClass('yupe-product-favorite-remove').addClass('text-error');
                $this.children('i').removeClass('fa-star-o').addClass('fa-star');
                $this.children('span').text('Удалить из избранного');
                if($(".but-favorite .toolbar-button").hasClass('no-active')){
                    $(".but-favorite .toolbar-button").removeClass('no-active').addClass('active').html(svg_add);
                }
            }
            showNotify($this, data.result ? 'success' : 'danger', data.data);
        }, 'json');
    });

    $(document).on('click', '.yupe-product-favorite-remove', function (event) {
        event.preventDefault();
        var $this = $(this);
        var product = parseInt($this.data('id'));
        var data = {'id': product};
        data[yupeTokenName] = yupeToken;
        $.post(yupeStoreRemoveFavoriteUrl, data, function (data) {
            if (data.result) {
                $('#yupe-store-favorite-total').html(data.count);
                $this.removeClass('yupe-product-favorite-remove')
                    .removeClass('text-error').addClass('yupe-product-favorite-add');
                $this.children('i').removeClass('fa-star').addClass('fa-star-o');
                $this.children('span').text('Добавить в избранное');
                if(data.count == 0){
                    $(".but-favorite .toolbar-button").removeClass('active').addClass('no-active').html(svg_remove);
                }
            }
            showNotify($this, data.result ? 'success' : 'danger', data.data);
        }, 'json');
    });
});