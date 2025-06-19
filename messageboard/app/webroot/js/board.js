$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    // 削除ボタン
    $(document).on('click', '.delete-message', function (e) {
    e.preventDefault();

    var messageId = $(this).data('id'); // ← これが 20 とか入る
    var $messageBox = $('#message-' + messageId);

    $.ajax({
        url: '/messages/' + messageId, // ← 動的に変更されていること！
        type: 'POST',
        data: {
            _method: 'DELETE'
        },
        success: function(response) {
            console.log('削除成功', response);
            $messageBox.remove(); // DOM から削除
        },
        error: function(xhr, status, error) {
            console.error('削除失敗', error);
        }
    });
});


    // 返信フォーム
    $(document).on('submit', '.reply-form', function (e) {
        e.preventDefault();
        var $form = $(this);
        var formData = $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: formData,
            success: function () {
                location.reload(); // 成功後にリロード（理想はDOM追加）
            },
            error: function () {
                alert('返信に失敗しました。');
            }
        });
    });


        // 「もっと見る」ボタンクリックAdd commentMore actions
    $(document).on('click', '#load-more', function (e) {
        e.preventDefault();
        var page = $(this).data('page');
console.log(page)
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
