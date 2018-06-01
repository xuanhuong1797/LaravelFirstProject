$(function () {
    $('#dataTable').on('click', '.deleteBtn', function () {
        event.preventDefault();
        var id = $(this).closest('tr').find('td:first').text();
        console.log(id);
        swal({
                title: "Are you sure?",
                text: "Category will be deleted",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: 'POST',
                        url: '/category/delete',
                        data: {
                            id: id
                        },
                        success: function () {
                            swal({
                                title: "Deleted",
                                text: "Category has been deleted",
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