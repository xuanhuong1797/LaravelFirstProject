$(function () {
    $('#dataTable').on('click', '.deleteBtn', function () {
        event.preventDefault();
        var id = $(this).closest('tr').find('td:first').text();
        console.log(id);
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
                        url: '/product/delete',
                        data: {
                            id: id
                        },
                        success: function () {
                            swal({
                                title: "Deleted",
                                text: "Product has been deleted",
                                icon: "success"
                            }).then(function () {
                                location.reload();
                            });
                        }
                    })

                }
            });
    });
    $('#dataTable').on('click', '.publishProduct', function () {
        var id = $(this).closest('tr').find('td:first').text();
        swal({
                title: "Are you sure?",
                text: "Publish/Unpublish Product",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: 'POST',
                        url: '/product/publish',
                        data: {
                            id: id
                        },
                        success: function (data) {
                            swal({
                                title: "Published/Unpublishe",
                                text: "Product has been published/unpublished",
                                icon: "success"
                            }).then(function () {
                                location.reload();
                            });
                        }
                    })

                }
            });
    });
});