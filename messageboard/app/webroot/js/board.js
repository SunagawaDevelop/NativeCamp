// CSRFトークンの設定
$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    // メッセージ削除ボタン
    $(document).on('click', '.delete-message', function (e) {
        e.preventDefault();

        var messageId = $(this).data('id');
        var $messageBox = $('#message-' + messageId);

        $.ajax({
            url: '/messages/' + messageId,
            type: 'POST',
            data: {
                _method: 'DELETE'
            },
            success: function (response) {
                console.log('削除成功', response);
                $messageBox.remove();
            },
            error: function (xhr, status, error) {
                console.error('削除失敗', error);
            }
        });
    });

    // 返信フォーム送信処理
    $(document).on('submit', '.reply-form', function (e) {
        e.preventDefault();
        const form = this;

        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: $(form).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    location.reload();
                } else {
                    alert('返信の投稿に失敗しました。');
                }
            },
            error: function () {
                alert('通信エラーが発生しました。');
            }
        });
    });

    // 「もっと見る」ボタンクリック
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
});
