(function () {
    $('#close-btn').on('click', function () {
        $('.overlay').fadeOut();
        $('span.prev').each(function () {
            this.empty();
        });
        $('button[name=preview]').attr('id', '');
    });
})();

(function () {

    $('.show_preview').on('click', function () {
        $('.alert').remove();
        var input_name = $('input[name=name]'),
            name =input_name.val(),
            status = $('input[name=status]').val(),
            email = $('input[name=email]').val(),
            text = $('textarea[name=text]').val(),
            message = '<div class="message"></div>';

        if (name == '') {
            $('.message').addClass('alert alert-danger').text('Заполните поле Имя');

        }else if(text == ''){
            $('.message').addClass('alert alert-danger').text('Заполните поле Текст');

        } else {
            $('.message').remove();

            $.ajax({
                url: '/task/create/',
                type: 'GET',
                data: {val: name},
                success: function (res) {
                    var result = JSON.parse(res);
                    if (result.answer == 'no') {
                        $('.message').addClass('alert alert-danger').text('Такого пользователя не существует');
                    }
                    if(result.answer == 'yes'){
                        $('.message').removeClass('alert alert-danger').empty();
                        $('.overlay').fadeIn();
                        $('.preview_name').text(name);
                        $('.preview_text').text(text);
                        $('.preview_status').text(status);
                        $('.preview_email').text(result.email);
                        $('.preview_image').text(result.email);
                    }
                }
            });
        }
    });
})();
(function(){
    $('#pic').change(function(){
        var input = $(this)[0];
        if(input.files && input.files[0]){
            if(input.files[0].type.match('image.*')){
                var reader = new FileReader();
                reader.onload = function(e){ $('#image').attr('src', e.target.result);};
                reader.readAsDataURL(input.files[0]);
            } else{
                console.log('is not image mime type');
            }
        } else{
            console.log('not isset file data');
        }
    });
})();

