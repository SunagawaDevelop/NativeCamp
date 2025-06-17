<?php if (isset($csrfToken)): ?>
    <meta name="csrf-token" content="<?php echo h($csrfToken); ?>">
<?php endif; ?>

<?php if (!empty($currentUser)): ?>
  <div class="current-user-box" style="margin-bottom: 20px;">
    <?php if (!empty($currentUser['photo'])): ?>
      <?php echo $this->Html->image($currentUser['photo'], [
          'alt' => 'Your Photo',
          'style' => 'width: 50px; height: 50px; border-radius: 50%; vertical-align: middle; margin-right: 10px;'
      ]); ?>
    <?php endif; ?>
    <span style="font-weight: bold;">現在、<strong><?php echo h($currentUser['name']); ?></strong> さんでログイン中です。</span>
  </div>
<?php endif; ?>

<div class="board-container">
  <div class="board-box">
    <h2>Message Board</h2>

    <p><?php echo $this->Html->link('New Message', ['action' => 'add'], ['style' => 'color: #000;']); ?></p>

    <div id="message-list">
      <?php foreach ($messages as $message): ?>
        <div class="message" id="message-<?php echo $message['Message']['id']; ?>">

          <?php if (!empty($message['User']['photo'])): ?>
            <?php echo $this->Html->image($message['User']['photo'], [
                'alt' => 'User Photo',
                'style' => 'width:40px; height:40px; border-radius:50%;'
            ]); ?>
          <?php endif; ?>
          <strong><?php echo h($message['User']['name']); ?></strong>
          <p><strong><?php echo h($message['Message']['content']); ?></strong></p>
          <p><small><?php echo h($message['Message']['created']); ?></small></p>

          <div class="conversations">
            <?php foreach ($message['Conversation'] as $conversation): ?>
              <div class="conversation">
                <?php if (!empty($conversation['User']['photo'])): ?>
                  <?php echo $this->Html->image($conversation['User']['photo'], [
                      'alt' => 'User Photo',
                      'style' => 'width:30px; height:30px; border-radius:50%; vertical-align:middle; margin-right:10px;'
                  ]); ?>
                <?php endif; ?>
                <strong><?php echo h($conversation['User']['name']); ?></strong>
                <p><?php echo h($conversation['content']); ?></p>
                <p><small><?php echo h($conversation['created']); ?></small></p>

                <?php
                  echo $this->Form->create('Conversation', [
                      'url' => ['controller' => 'conversations', 'action' => 'delete', $conversation['id']],
                      'method' => 'post',
                      'style' => 'display:inline-block;',
                      'onsubmit' => 'return confirm("Are you sure you want to delete this?");'
                  ]);
                  echo $this->Form->submit('Delete', ['style' => 'background:#fff; color:#000; border:1px solid #000;']);
                  echo $this->Form->end();
                ?>
              </div>
            <?php endforeach; ?>
          </div>

          <?php
            echo $this->Form->create('Message', [
                'url' => ['controller' => 'messages', 'action' => 'delete', $message['Message']['id']],
                'method' => 'post',
                'style' => 'display:inline-block;',
                'onsubmit' => 'return confirm("This message and all its replies will be deleted. Are you sure?");'
            ]);
            echo $this->Form->submit('Delete Message', ['style' => 'background:#fff; color:#000; border:1px solid #000;']);
            echo $this->Form->end();
          ?>

          <?php
            echo $this->Form->create('Conversation', [
                'url' => ['controller' => 'conversations', 'action' => 'add'],
                'class' => 'reply-form'
            ]);
            echo $this->Form->hidden('message_id', ['value' => $message['Message']['id']]);
            echo $this->Form->control('content', [
                'label' => false,
                'placeholder' => 'Write a reply...',
                'style' => 'color:#000; background:#fff; border:1px solid #000;'
            ]);
            echo $this->Form->submit('Reply', ['style' => 'background:#fff; color:#000; border:1px solid #000;']);
            echo $this->Form->end();
          ?>
        </div>
      <?php endforeach; ?>
    </div>

    <?php if ($this->Paginator->hasNext()): ?>
      <p><a href="#" id="load-more" data-page="2" style="color: #000;">Load More</a></p>
    <?php endif; ?>
  </div>
</div>

<?php echo $this->Html->script('board'); ?>
