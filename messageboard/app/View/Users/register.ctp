<h2>ユーザー登録</h2>

<?php
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'register')));
echo $this->Form->input('name', array('label' => 'お名前'));
echo $this->Form->input('email', array('label' => 'Email'));
echo $this->Form->input('password', array('label' => 'パスワード'));
echo $this->Form->input('password_confirm', array(
    'label' => 'パスワード（確認）',
    'type' => 'password'
));
echo $this->Form->end('登録');
?>
