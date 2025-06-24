$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    $(document).on('click', '.delete-message', function (e) {
        e.preventDefault();

        var messageId = $(this).data('id');
        var $messageBox = $('#message-' + messageId);

        $.ajax({
            url: '/messages/' + messageId,
            type: 'POST',
            data: { _method: 'DELETE' },
            success: function (response) {
                console.log('削除成功', response);
                $messageBox.remove();
            },
            error: function (xhr, status, error) {
                console.error('削除失敗', error);
            }
        });
    });

    $(document).on('submit', '.reply-form', function (e) {
        e.preventDefault();
        var $form = $(this);
        var formData = $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: formData,
            success: function () {
                location.reload();
            },
            error: function () {
                alert('返信に失敗しました。');
            }
        });
    });

    $(document).on('click', '#load-more', function (e) {
        e.preventDefault();
        var page = $(this).data('page');

        $.ajax({
            url: '/messageboard/messages/index/page/' + page,
            type: 'GET',
            dataType: 'html',
            success: function (html) {
                var $newMessages = $(html).find('#message-list').html();
                $('#message-list').append($newMessages);
                $('#load-more').data('page', page + 1);
                if (!$(html).find('#load-more').length) {
                    $('#load-more').remove();
                }
            },
            error: function () {
                alert('メッセージの読み込みに失敗しました。');
            }
        });
    });

    if ($('#datepicker').length > 0) {
        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2025"
        });
    }
});

$(function () {
    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:2025"
    });

    $('#UserPhoto').on('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => $('#preview').attr('src', e.target.result);
            reader.readAsDataURL(file);
        }
    });

    $('#ajaxPhotoForm').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: typeof uploadPhotoUrl !== 'undefined' ? uploadPhotoUrl : '/users/upload_photo',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                let result;
                try {
                    result = typeof res === 'string' ? JSON.parse(res) : res;
                } catch (e) {
                    $('#photo-error').text('サーバーエラーが発生しました');
                    return;
                }

                if (result.success) {
                    alert(result.message);
                    $('#preview').attr('src', '/messageboard/img/' + result.photo);
                } else {
                    $('#photo-error').text(result.message);
                }
            },
            error: function () {
                $('#photo-error').text(result.message);
            }
        });
    });
});
