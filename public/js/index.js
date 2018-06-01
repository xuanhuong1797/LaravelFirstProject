$(function () {
    $('.item-add-love').on('click', function (e) {
        e.preventDefault();
        //item id
        var $btn = $(this);
        var idProduct = $btn.attr('id');
        var color = $btn.closest('.card').find('.item-love').css('color');
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
                $btn.closest('.card').find('.item-love').text(' ' + data);
                if (color == 'rgb(255, 0, 0)') {
                    $btn.closest('.card').find('.item-love').css('color', '');
                } else {
                    $btn.closest('.card').find('.item-love').css('color', 'red');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal({
                    text: "Login to continue",
                    icon: "error",
                });
            }
        });

    });
});