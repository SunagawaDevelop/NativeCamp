<?php if (isset($csrfToken)): ?>
    <meta name="csrf-token" content="<?php echo h($csrfToken); ?>">
<?php endif; ?>


<?php echo $this->Form->create(null, ['type' => 'post']); ?>
<?php echo $this->Form->end(); ?>


<h2>掲示板</h2>

<p><?php echo $this->Html->link('新規メッセージ', ['action' => 'add']); ?></p>

<div id="message-list">
<?php foreach ($messages as $message): ?>
    <div class="message" id="message-<?php echo $message['Message']['id']; ?>">
        <p><strong><?php echo h($message['Message']['content']); ?></strong></p>
        <p><small><?php echo h($message['Message']['created']); ?></small></p>

        <p>
            <?php echo $this->Html->link('削除', '#', [
                'class' => 'delete-message',
                'data-id' => $message['Message']['id']
            ]); ?>
        </p>

        <div class="conversations">
            <?php foreach ($message['Conversation'] as $conversation): ?>
                <div class="conversation">
                    <p><?php echo h($conversation['content']); ?></p>
                    <p><small><?php echo h($conversation['created']); ?></small></p>
                </div>
            <?php endforeach; ?>
        </div>

        <?php echo $this->Form->create('Conversation', [
            'url' => ['controller' => 'conversations', 'action' => 'add'],
            'class' => 'reply-form',
            'inputDefaults' => ['label' => false]
        ]); ?>
            <?php echo $this->Form->hidden('message_id', ['value' => $message['Message']['id']]); ?>
            <?php echo $this->Form->input('content', ['placeholder' => '返信を入力...']); ?>
            <?php echo $this->Form->submit('返信'); ?>
        <?php echo $this->Form->end(); ?>
    </div>
<?php endforeach; ?>
</div>

<!-- もっと見る -->
<?php if ($this->Paginator->hasNext()): ?>
    <p><a href="#" id="load-more" data-page="2">もっと見る</a></p>
<?php endif; ?>

<?php echo $this->Html->script('board'); ?>
