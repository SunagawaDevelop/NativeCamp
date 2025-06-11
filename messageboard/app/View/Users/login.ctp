<h2>ログイン</h2>

<?php
if (!empty($loginResult)) {
    echo '<p>' . h($loginResult) . '</p>';
}

echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login')));
echo $this->Form->input('email', array('label' => 'Email'));
echo $this->Form->input('password', array('label' => 'Password'));
echo $this->Form->end('ログイン');

?>

<p><?php echo $this->Html->link('新規登録はこちら', array('controller' => 'users', 'action' => 'register')); ?></p>

