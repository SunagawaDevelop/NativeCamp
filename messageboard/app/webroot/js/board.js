$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    // ▼====================== メッセージ削除 =====================▼
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

    // ▼====================== 返信投稿 =====================▼
    $(document).on('submit', '.reply-form', function (e) {
        e.preventDefault();
        var $form = $(this);
        var formData = $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: formData,
            success: function () {
                location.reload(); // 理想はDOMに追加する方式
            },
            error: function () {
                alert('返信に失敗しました。');
            }
        });
    });

    // ▼====================== 「もっと見る」読み込み =====================▼
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

    // ▼====================== 日付ピッカー =====================▼
    if ($('#datepicker').length > 0) {
        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2025"
        });
    }

    // ▼====================== プロフィール画像 プレビュー + アップロード =====================▼
    if ($('#photo-input').length > 0) {
        $('#photo-input').on('change', function (e) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });

        $('#upload-btn').on('click', function () {
            const fileInput = $('#photo-input')[0];
            const file = fileInput.files[0];
            if (!file) {
                alert('画像を選択してください');
                return;
            }

            const formData = new FormData();
            formData.append('User[photo]', file);

            // プロフィール編集画面にいると仮定して userId を取得
            const userId = $('#upload-btn').data('userid'); // data-userid 属性が必要！

            $.ajax({
                url: '/messageboard/users/upload_photo/' + userId,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    try {
                        const json = JSON.parse(response);
                        if (json.status === 'success') {
                            alert('画像を更新しました');
                        } else {
                            alert(json.message || 'アップロードに失敗しました');
                        }
                    } catch (e) {
                        alert('予期せぬエラーが発生しました');
                    }
                },
                error: function () {
                    alert('通信エラーが発生しました');
                }
            });
        });
    }
});

$(function () {
    // 生年月日用 datepicker
    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        yearRange: "1900:2025"
    });

    // プレビュー表示
    $('#UserPhoto').on('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => $('#preview').attr('src', e.target.result);
            reader.readAsDataURL(file);
        }
    });

    // AJAXアップロード処理
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
                    $('#photo-error').text('');
                    alert(result.message);
                    $('#preview').attr('src', '/messageboard/img/' + result.photo);

                } else {
                    $('#photo-error').text(result.message);
                }
            },
            error: function () {
                $('#photo-error').text(result.message);
               // $('#photo-error').text('sunagawa');
            }
        });
    });
});

