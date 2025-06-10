<h2>新規メッセージ投稿</h2>
<?php
    echo $this->Form->create('Message');
    echo $this->Form->input('content', array('label' => '内容', 'type' => 'textarea'));
    echo $this->Form->end('投稿');
?>