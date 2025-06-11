<h2>マイページ</h2>

<?php if (!empty($user)) : ?>
    <p>ログインしました！ようこそ、<?php echo h($user['email']); ?> さん。</p>
<?php else : ?>
    <p>ユーザー情報が取得できませんでした。</p>
<?php endif; ?>

<?php
echo $this->Html->link('ログアウト', array('controller' => 'users', 'action' => 'logout'));
?>

<?php echo $this->Html->link('プロフィール編集', array('controller' => 'users', 'action' => 'profile')); ?>

