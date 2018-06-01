$(function () {
    $('.item-add-love').on('click', function (e) {
        e.preventDefault();

        var $btn = $(this);
        var idProduct = $btn.attr('id');
        var color = $btn.find('.item-love').css('color');
        $.ajax({
            type: "POST",
            data: {
                id: idProduct,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
            },
            url: '/product/addlove',
            success: function (data) {
                $btn.find('.item-love').text(' ' + data);
                if (color == 'rgb(255, 0, 0)') {
                    $btn.find('.item-love').css('color', 'gray');
                } else {
                    $btn.find('.item-love').css('color', 'red');
                }
            },
            error: function () {
                swal({
                    text: "Login to continue",
                    icon: "error",
                });
            }
        });

    });
});