$(function () {
    $('#dataTable').on('click', '.deleteBtn', function () {
        event.preventDefault();
        var id = $(this).closest('tr').find('td:first').text();
        swal({
                title: "Are you sure?",
                text: "Product will be deleted",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: 'POST',
                        url: '/user/delete',
                        data: {
                            id: id
                        },
                        success: function () {
                            swal({
                                title: "Deleted",
                                text: "Account has been deleted",
                                icon: "success"
                            }).then(function () {
                                location.reload();
                            });
                        },
                        statusCode: {
                            403: function (data) {
                                console.log();
                                swal({
                                    text: data.responseJSON['error'],
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                            }
                        }
                    })

                }
            });
    });
});