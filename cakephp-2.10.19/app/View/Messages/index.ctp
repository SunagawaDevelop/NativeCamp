<h2>掲示板</h2>
<?php echo $this->Html->link('新規メッセージを追加', array('action' => 'add'), array('class' => 'button')); ?>
<div id="message-list">
<?php foreach ($messages as $message): ?>
    <div class="message" id="message-<?php echo $message['Message']['id']; ?>">
        <p><?php echo h($message['Message']['content']); ?></p>
        <p><small><?php echo h($message['Message']['created']); ?></small></p>
        <button class="delete-button" data-id="<?php echo $message['Message']['id']; ?>">削除</button>
    </div>
<?php endforeach; ?>
</div>
<?php echo $this->Paginator->next('もっと見る...', array('escape' => false)); ?>

<script>
$(document).on('click', '.delete-button', function () {
    var id = $(this).data('id');
    var $row = $('#message-' + id);

    $.ajax({
        url: '/messages/delete/' + id,
        type: 'POST',
        success: function (res) {
            if (res.result === 'success') {
                $row.fadeOut(400, function () { $(this).remove(); });
            } else {
                alert('削除に失敗しました');
            }
        }
    });
});
</script>