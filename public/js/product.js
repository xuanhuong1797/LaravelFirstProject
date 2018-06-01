$(function () {
    //Image change
    $('.image-bot-container>img').hover(function () {
        $('.image-top>img').attr('src', $(this).attr('src'));
    });
    //Add Comment Btn
    $('#comment-add').on('click', function () {
        event.preventDefault();
        var form = $("#commentForm").serializeArray();
        var productID = $('.item-add-love').attr('id');
        $.ajax({
            method: 'POST',
            url: '/product/addcomment',
            data: {
                data: form,
                id: productID,
            },
            success: function (data) {
                location.reload();
            }
        })
    });
    //Edit Comment
    $('.comment-actions>.edit').on('click', function () {
        var id = $(this).closest('.comment-block').find('.comment-id').attr('id');
        var CommentAvatarUrl = $(this).closest('.comment-wrap').find('.avatar').css('background-image');
        var ratingValue = $(this).closest('.comment-wrap').find('.user-rating').attr('id');
        var commentText = $(this).closest('.comment-wrap').find('.comment-text').text();
        var edit = editForm(CommentAvatarUrl, commentText, ratingValue);
        $(this).closest('.comment-wrap').html(edit);
        $('#comment-edit').on('click', function () {
            event.preventDefault();
            var form = $("#commentForm").serializeArray();
            var productID = $('.item-add-love').attr('id');
            $.ajax({
                method: 'POST',
                url: '/product/editcomment',
                data: {
                    data: form,
                    id: id,
                },
                success: function () {
                    swal({
                        title: "Edited",
                        text: "Comment has been edited",
                        icon: "success"
                    }).then(function () {
                        location.reload();
                    });
                }
            })
        });
    });
    //Delete Comment
    $('.comment-actions>.delete').on('click', function () {
        var idComment = $(this).closest('.comment-block').find('.comment-id').attr('id');
        swal({
                title: "Are you sure?",
                text: "Comment will be deleted",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: 'POST',
                        url: '/product/deletecomment',
                        data: {

                            id: idComment,
                        },
                        success: function () {
                            swal({
                                title: "Deleted",
                                text: "Comment has been deleted",
                                icon: "success"
                            }).then(function () {
                                location.reload();
                            });
                        }
                    })

                }
            });
    });
    //Reply Comment
    $('.comment-actions>.reply').on('click', function () {
        var idComment = $(this).closest('.comment-block').find('.comment-id').attr('id');
        var avatarURL = $('.profile-image').attr('src');
        $(replyForm(avatarURL)).insertAfter($(this).closest('.comment-wrap').parent());
        $('#reply-save').on('click', function () {
            event.preventDefault();
            var form = $("#commentForm").serializeArray();
            var productID = $('.item-add-love').attr('id');
            $.ajax({
                method: 'POST',
                url: '/product/addreply',
                data: {
                    data: form,
                    idProduct: productID,
                    idComment: idComment,
                },
                success: function () {
                    location.reload();
                }
            })
        });
    });
    //Edit Replied Comment
    $('.comment-actions>.editReply').on('click', function () {
        var id = $(this).closest('.comment-block').find('.comment-id').attr('id');
        var CommentAvatarUrl = $(this).closest('.comment-wrap').find('.avatar').css('background-image');
        var commentText = $(this).closest('.comment-wrap').find('.comment-text').text();
        var edit = replyFormEdit(CommentAvatarUrl, commentText);
        $(this).closest('.comment-wrap').html(edit);
        $('#reply-edit').on('click', function () {
            event.preventDefault();
            var form = $("#commentForm").serializeArray();
            var productID = $('.item-add-love').attr('id');
            $.ajax({
                method: 'POST',
                url: '/product/editcomment',
                data: {
                    data: form,
                    id: id,
                },
                success: function () {
                    swal({
                        title: "Edited",
                        text: "Reply has been edited",
                        icon: "success"
                    }).then(function () {
                        location.reload();
                    });
                }
            })
        });

    });

    function editForm(url, body, value) {
        var edit = '<div class="comment-wrap">';
        edit += '<div class="photo">';
        edit += '<div class="avatar" style="background-image:' + url + '"></div></div>';
        edit += '<div class="comment-block">';
        edit += '<form id="commentForm">';
        edit += '<textarea name="commentBody" id="" cols="30" rows="5" name="commentText" >' + body + '</textarea>';
        edit += '<div class="rating-wrapper" style="right: 0%">';
        for (i = 5; i >= 1; i--) {
            if (i == value) {
                edit += ' <input type="radio" class="rating-input" id="rating-input-1-' + i + '" value="' + i + '" name="rating" checked />';
            } else {
                edit += ' <input type="radio" class="rating-input" id="rating-input-1-' + i + '" value="' + i + '" name="rating" />';
            }
            edit += '<label for="rating-input-1-' + i + '" class="rating-star"></label> ';
        }
        edit += '</div><button type="submit" style="float: right;" class="btn btn-success" id="comment-edit">Save</button>';
        edit += '<button type="reset" style="float: right;" class="btn btn-default" onClick="window.location.reload( true );"">Cannel</button></form></div></div>';
        return edit;
    }

    function replyForm(url) {
        var reply = '<li><div class="comment-wrap">';
        reply += '<div class="photo">';
        reply += '<div class="avatar" style="background-image:' + url + '"></div></div>';
        reply += '<div class="comment-block">';
        reply += '<form id="commentForm">';
        reply += '<textarea name="commentBody" id="" cols="30" rows="5" name="commentText" ></textarea>';
        reply += '<div class="rating-wrapper" style="right: 0%">'
        reply += '</div><button type="submit" style="float: right;" class="btn btn-success" id="reply-save">Save</button>';
        reply += '<button type="reset" style="float: right;" class="btn btn-default">Cannel</button></form></div></div></li>';
        return reply;
    }

    function replyFormEdit(url, body) {
        var reply = '<li><div class="comment-wrap">';
        reply += '<div class="photo">';
        reply += '<div class="avatar" style="background-image:url(' + url + ')"></div></div>';
        reply += '<div class="comment-block">';
        reply += '<form id="commentForm">';
        reply += '<textarea name="commentBody" id="" cols="30" rows="5" name="commentText" >' + body + '</textarea>';
        reply += '<div class="rating-wrapper" style="right: 0%">'
        reply += '</div><button type="submit" style="float: right;" class="btn btn-success" id="reply-edit">Save</button>';
        reply += '<button type="reset" style="float: right;" class="btn btn-default">Cannel</button></form></div></div></li>';
        return reply;
    }

    //Delete Product Btn
    $('#deleteProduct').on('click', function () {
        var id = $(this).closest('.col-md-6').find('.item-add-love').attr('id');
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
                                window.location.href = "/";
                            });

                        }
                    })

                }
            });
    });

    //Publish Or Unpublish Product
    $('#publishProduct').on('click', function () {
        var id = $(this).closest('.col-md-6').find('.item-add-love').attr('id');
        console.log(id);
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