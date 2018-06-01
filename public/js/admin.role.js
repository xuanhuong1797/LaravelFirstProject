$(function () {

    $('#checkAll').click(function () {
        $('input:checkbox').prop('checked', this.checked);
    });
    $('#saveEdit').click(function () {
        var id = [];
        var roleID = $("#roleID").val();
        $('input:checkbox:checked').each(function (i) {
            id[i] = $(this).val();
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            data: {
                permission: id,
                roleID: roleID,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
            },
            url: '/admin/role/update',
            success: function () {
                swal({
                    title: "Success",
                    text: "Update role successed",
                    icon: "success",
                });
            },

        });
    })
});