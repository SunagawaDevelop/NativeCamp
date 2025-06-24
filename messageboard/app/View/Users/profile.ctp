<!-- jQuery & jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<!-- board.js 読み込み -->
<?php echo $this->Html->script('board'); ?>


<div class="profile-edit-container">

    <div class="profile-edit-form">
        <div class="form-row">
            <label class="form-label form-title">Edit Profile</label>
        </div>
  
        <?php if (!empty($user['logindate'])): ?>
            <p class="last-login">Last Login: <strong><?php echo h($user['logindate']); ?></strong></p>
        <?php endif; ?>

        <!-- プロフィール画像フォーム（AJAX対応） -->
        <h2>プロフィール画像</h2>
        <form id="ajaxPhotoForm" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="form_type" value="photo">

            <div class="form-row image-update-row">
                <img src="/messageboard/img/<?php echo h($user['photo'] ?: 'uploads/no_image.png'); ?>" width="150" id="preview" alt="Profile Photo">
            </div>

            <div class="form-row">
                <label class="form-label" for="UserPhoto">プロフィール画像を選択</label>
                <input type="file" name="data[User][photo]" id="UserPhoto" class="form-input">
                <span class="form-error" id="photo-error"></span>
            </div>

            <div class="form-row">
                <button type="submit" class="btn">画像を更新</button>
            </div>
        </form>

        <hr>

        <!-- プロフィール情報フォーム -->
        <h2>プロフィール情報</h2>
        <?php echo $this->Form->create('User', ['url' => ['action' => 'profile'], 'type' => 'post']); ?>
        <?php echo $this->Form->hidden('form_type', ['value' => 'profile']); ?>

        <div class="form-row">
            <?php
                echo $this->Form->label('name', 'Name', ['class' => 'form-label']);
                echo $this->Form->text('name', ['class' => 'form-input-inline']);
                echo $this->Form->error('name', null, ['wrap' => 'span', 'class' => 'form-error-inline']);
            ?>
        </div>

        <div class="form-row">
            <?php
                echo $this->Form->label('email', 'Email', ['class' => 'form-label']);
                echo $this->Form->text('email', ['class' => 'form-input-inline']);
                echo $this->Form->error('email', null, ['wrap' => 'span', 'class' => 'form-error-inline']);
            ?>
        </div>

        <div class="form-row">
            <?php
                echo $this->Form->label('birthdate', 'Birthdate', ['class' => 'form-label']);
                echo $this->Form->text('birthdate', ['class' => 'form-input-inline', 'id' => 'datepicker']);
                echo $this->Form->error('birthdate', null, ['wrap' => 'span', 'class' => 'form-error-inline']);
            ?>
        </div>

        <div class="form-row">
            <?php
                echo $this->Form->label('gender', 'Gender', ['class' => 'form-label']);
                echo '<div class="form-input-inline radio-inline">';
                echo $this->Form->radio('gender', ['Male' => 'Male', 'Female' => 'Female'], [
                    'legend' => false,
                    'separator' => '&nbsp;&nbsp;'
                ]);
                echo '</div>';
                echo $this->Form->error('gender', null, ['wrap' => 'span', 'class' => 'form-error-inline']);
            ?>
        </div>

        <div class="form-row">
            <?php
                echo $this->Form->label('hobby', 'Hobby', ['class' => 'form-label']);
                echo $this->Form->textarea('hobby', ['class' => 'form-input-inline', 'maxlength' => 500]);
                echo $this->Form->error('hobby', null, ['wrap' => 'span', 'class' => 'form-error-inline']);
            ?>
        </div>

        <div class="form-row">
            <?php echo $this->Form->submit('プロフィールを更新', ['class' => 'btn']); ?>
        </div>

        <?php echo $this->Form->end(); ?>
    </div>
</div>

<div class="profile-edit-links">
    <p class="link-line">
        <?php echo $this->Html->link('プロフィールを確認する', ['action' => 'profile_view']); ?>
    </p>
    <p class="link-line">
        <?php echo $this->Html->link('マイページへ戻る', ['action' => 'mypage']); ?>
    </p>
</div>

<script>
    const uploadPhotoUrl = "<?php echo $this->Html->url(['controller' => 'users', 'action' => 'upload_photo']); ?>";
</script>

