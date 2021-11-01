$(document).ready(function() {
    /**
     * ajax на формах
     */
    $('form[data-type="ajax-form"]').on('click', function(event) {
        var elem = event.target;
        var dataSend = elem.getAttribute('data-send');
        $(elem).addClass('active');
        if (dataSend=='ajax') {
            var
                button   = $(elem),
                form     = button.parents('form'),
                type     = form.attr('method'),
                formId   = form.attr('id');

            // form.loader('show');

            if(form.hasClass('form-file')){
                var data = new FormData(form.get(0));
                $.ajax({
                    type: type,
                    data: data,
                    enctype: 'multipart/form-data',
                    contentType: false,
                    processData: false,
                    async: false,
                    cache: false,
                    success: function (html) {
                        var newForm = $(html).find('#'+formId);

                        $('#'+formId).html(newForm.html());

                        if($('#'+formId).find('input[data-mask=phone]').is('.data-mask')){
                            $('#'+formId).find('input[data-mask=phone]')
                                .mask('+7(999)999-99-99', {
                                    'placeholder':'_',
                                    'completed':function() {
                                        //console.log('ok');
                                    }
                                });
                        }
                        
                        if($('#'+formId).find('input[data-phoneMask="phone"]').is('.phone-mask')){
                            $(".phone-mask").inputmask("+7(999)999-99-99", {inputmode: "numeric"});
                        }

                        $.getScript('https://www.google.com/recaptcha/api.js', function () {});
                    }
                });
            } else{
                $.ajax({
                    type: type,
                    data:  form.serialize(), //formData,
                    dataType: 'html',
                    success: function(html) {
                        var newForm = $(html).find('#'+formId);

                        $('#'+formId).html(newForm.html());

                            if($('#'+formId).find('input[data-mask="phone"]').is('.data-mask')){
                                $('#'+formId).find('input[data-mask="phone"]')
                                    .mask("+7(999)999-99-99", {
                                        'placeholder':'_',
                                        'completed':function() {
                                            //console.log("ok");
                                        }
                                    });
                            }
                            if($('#'+formId).find('input[data-phoneMask="phone"]').is('.phone-mask')){
                                $(".phone-mask").inputmask("+7(999)999-99-99", {inputmode: "numeric"});
                            }
                                
                            $.getScript("https://www.google.com/recaptcha/api.js", function () {});
                        },
                });  
            }

            return false;
        }
    });

    // Инициализация маски
    $(".phone-mask").inputmask(phoneMaskTemplate, {inputmode: "numeric"});

    /**********************************************/
    /*
     * Показать пароль (скрыть) *
    */
    $(document).delegate('.password-form-group .input-group-addon', 'click', function() {
        var pass = $(this).parent().find('input');
        var icon = $(this).find('i');
        if(icon.hasClass('fa-eye')){
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else{
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
        pass.attr('type', pass.attr('type') === 'password' ? 'text' : 'password');
    });
    /**********************************************/
    
    /*if($('form').hasClass('form')){
        findFilled();
    }*/
});


function findFilled() {
    $('.form .form-group-filled').each(function(){
        var input = $(this).find('input');
        if(input.length > 0){
            var i = input.val().indexOf('_');
            if(input.hasClass('phone-mask') && i < 16){
                i = '-1';
            }
        } else {
            var input = $(this).find('textarea');
            var i = '-1';
        }

        if(input.val().length > 0 && i == -1){
            input.addClass('filled');
        } else{
            input.removeClass('filled');
        }
    });
    $('.form .form-group-filled input, .form .form-group-filled textarea').on('focusout', function (event) {
        var i = $(this).val().indexOf('_');
        if($(this).hasClass('phone-mask') && i < 16){
            i = '-1';
        }
        if($(this).val().length > 0 && i == -1){
            $(this).addClass('filled');
        } else{
            $(this).removeClass('filled');
        }
    });
}
