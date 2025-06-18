<?php if (isset($csrfToken)): ?>
    <meta name="csrf-token" content="<?php echo h($csrfToken); ?>">
<?php endif; ?>

<?php if (!empty($currentUser)): ?>
  <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
    <?php
      $currentUserPhoto = !empty($currentUser['photo']) 
        ? '/img/uploads/' . h($currentUser['photo']) 
        : '/img/no_image.png';

      echo $this->Html->image($currentUserPhoto, [
          'alt' => 'Current User Photo',
          'style' => 'width:50px; height:50px; border-radius:50%;'
      ]);
    ?>
    <p style="margin: 0;">
      現在、アカウント「<strong><?php echo h($currentUser['name']); ?></strong>」 でログイン中
    </p>
  </div>
<?php endif; ?>

<div class="board-container">
  <div class="board-box">

    <h2>Message Board</h2>

    <p>
      <?php echo $this->Html->link('New Message', ['action' => 'add'], ['style' => 'color: #000;']); ?>
    </p>

    <div id="message-list">
      <?php foreach ($messages as $message): ?>
        <div class="message" id="message-<?php echo $message['Message']['id']; ?>">
          
          <div class="sender-info">
            <?php
              $senderPhotoPath = !empty($message['User']['photo']) 
                  ? '/img/uploads/' . h($message['User']['photo']) 
                  : '/img/no_image.png';
              echo $this->Html->image($senderPhotoPath, [
                  'alt' => 'Sender',
                  'style' => 'width:40px; height:40px; border-radius:50%;'
              ]);
            ?>
            <strong><?php echo h($message['User']['name']); ?> さんから</strong>
          </div>

          <?php if (!empty($message['Recipient'])): ?>
            <div class="recipient-info">
              <?php
                $recipientPhotoPath = !empty($message['Recipient']['photo']) 
                    ? '/img/uploads/' . h($message['Recipient']['photo']) 
                    : '/img/no_image.png';
                echo $this->Html->image($recipientPhotoPath, [
                    'alt' => 'Recipient',
                    'style' => 'width:40px; height:40px; border-radius:50%;'
                ]);
              ?>
              <strong><?php echo h($message['Recipient']['name']); ?> さんへ</strong>
            </div>
          <?php endif; ?>

          <p><strong><?php echo nl2br(h($message['Message']['content'])); ?></strong></p>
          <p><small>作成日時 : <?php echo h($message['Message']['created']); ?></small></p>

          <div class="conversations">
            <?php foreach ($message['Conversation'] as $conversation): ?>
              <div class="conversation">
                <!-- 🔽 返信者の画像表示 -->
                <div class="conversation-sender-info">
                  <?php
                    $photoPath = !empty($conversation['User']['photo']) 
                        ? '/img/uploads/' . h($conversation['User']['photo']) 
                        : '/img/no_image.png';
                    echo $this->Html->image($photoPath, [
                        'alt' => 'User Photo',
                        'style' => 'width:40px; height:40px; border-radius:50%;'
                    ]);
                  ?>
                  <strong><?php echo h($conversation['User']['name']); ?> さんの返信</strong>
                </div>

                <!-- 返信内容と日時 -->
                <p><?php echo h($conversation['content']); ?></p>
                <p><small><?php echo h($conversation['created']); ?></small></p>

                <!-- 削除フォーム -->
                <?php
                  echo $this->Form->create('Conversation', [
                      'url' => ['controller' => 'conversations', 'action' => 'delete', $conversation['id']],
                      'method' => 'post',
                      'style' => 'display:inline-block;',
                      'onsubmit' => 'return confirm("Are you sure you want to delete this?");'
                  ]);
                  echo $this->Form->submit('Delete', ['class' => 'btn-default']);
                  echo $this->Form->end();
                ?>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- メッセージ削除 -->
          <?php
            echo $this->Form->create('Message', [
                'url' => ['controller' => 'messages', 'action' => 'delete', $message['Message']['id']],
                'method' => 'post',
                'style' => 'display:inline-block;',
                'onsubmit' => 'return confirm("This message and all its replies will be deleted. Are you sure?");'
            ]);
            echo $this->Form->submit('Delete Message', ['class' => 'btn-default']);
            echo $this->Form->end();
          ?>

          <!-- 返信フォーム -->
          <?php
            echo $this->Form->create('Conversation', [
                'url' => ['controller' => 'conversations', 'action' => 'add'],
                'class' => 'reply-form'
            ]);
            echo $this->Form->hidden('message_id', ['value' => $message['Message']['id']]);
            echo $this->Form->control('content', [
                'label' => false,
                'placeholder' => 'Write a reply...',
                'style' => 'color:#000; background:#fff; border:1px solid #000;',
                'rows' => 2
            ]);
            echo $this->Form->submit('Reply', ['class' => 'btn-default']);
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

<!-- 推奨：共通ボタンクラス -->
<style>
  .btn-default {
    background: #fff;
    color: #000;
    border: 1px solid #000;
    padding: 4px 8px;
    cursor: pointer;
  }

  .btn-default:hover {
    background: #f0f0f0;
  }
</style>
