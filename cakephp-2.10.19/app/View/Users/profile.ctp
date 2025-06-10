<h2>プロフィール編集</h2>

<?php echo $this->Session->flash(); ?>

<?php
echo $this->Form->create('User', array('type' => 'file'));

// プロフィール画像
echo $this->Form->input('photo', array('type' => 'file', 'label' => 'プロフィール画像'));

// DBに保存された画像がある場合のみ表示
if (!empty($user['User']['photo'])) {
    echo $this->Html->image('/img/' . h($user['User']['photo']), array(
        'alt' => 'プロフィール画像',
        'width' => '150',
        'id' => 'preview'
    ));
} else {
    echo '<img id="preview" src="" style="display:none;" width="150" />';
}

// その他のフォーム項目
echo $this->Form->input('name', array('label' => '名前'));
echo $this->Form->input('email', array('label' => 'Email', 'readonly' => true));
echo $this->Form->input('birthdate', array('label' => '誕生日', 'type' => 'text', 'id' => 'datepicker'));
echo $this->Form->input('gender', array(
    'type' => 'radio',
    'options' => array('Male' => '男性', 'Female' => '女性'),
    'legend' => false,
    'label' => '性別'
));
echo $this->Form->input('hobby', array('label' => '趣味', 'type' => 'textarea', 'maxlength' => 500));

echo $this->Form->end('更新');
?>

<!-- jQuery & DatePicker -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />

<script>
$(function() {
    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    // プレビュー表示
    $('input[type="file"]').on('change', function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(e.target.files[0]);
    });
});
</script>

<p><?php echo $this->Html->link('マイページへ戻る', array('controller' => 'users', 'action' => 'mypage')); ?></p>
