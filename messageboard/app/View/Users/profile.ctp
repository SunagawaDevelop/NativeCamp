<div class="profile-edit-container">
    <div class="profile-edit-form">
        
        <div class="form-row">
            <label class="form-label form-title">Edit Profile</label>
        </div>

        <div class="form-row image-update-row">
            <?php
            if (!empty($user['User']['photo'])) {
                echo $this->Html->image('/img/' . h($user['User']['photo']), array(
                    'alt' => 'Profile Photo',
                    'width' => '150',
                    'id' => 'preview'
                ));
            } else {
                echo '<img id="preview" src="" style="display:none;" width="150" />';
            }
            ?>
            <div class="update-button-box">
                <?php echo $this->Form->create('User', array('type' => 'file')); ?>
                <?php echo $this->Form->submit('Update', array('class' => 'btn-update-inline')); ?>
            </div>
        </div>

        <?php echo $this->Session->flash(); ?>

        <div class="form-row">
            <?php
            echo $this->Form->label('photo', 'Profile Photo', array('class' => 'form-label'));
            echo $this->Form->file('photo', array('class' => 'form-input'));
            ?>
        </div>

        <div class="form-row">
            <?php
            echo $this->Form->label('name', 'Name', array('class' => 'form-label'));
            echo $this->Form->text('name', array('class' => 'form-input short-input'));
            ?>
        </div>

        <div class="form-row">
            <?php
            echo $this->Form->label('email', 'Email', array('class' => 'form-label'));
            echo $this->Form->text('email', array('class' => 'form-input short-input', 'readonly' => true));
            ?>
        </div>

        <div class="form-row">
            <?php
            echo $this->Form->label('birthdate', 'Birthdate', array('class' => 'form-label'));
            echo $this->Form->text('birthdate', array('class' => 'form-input short-input', 'id' => 'datepicker'));
            ?>
        </div>

        <div class="form-row">
            <?php
            echo $this->Form->label('gender', 'Gender', array('class' => 'form-label'));
            echo '<div class="form-input radio-inline">';
            echo $this->Form->radio('gender', array('Male' => 'Male', 'Female' => 'Female'), array(
                'legend' => false,
                'separator' => '&nbsp;&nbsp;'
            ));
            echo '</div>';
            ?>
        </div>

        <div class="form-row">
            <?php
            echo $this->Form->label('hobby', 'Hobby', array('class' => 'form-label'));
            echo $this->Form->textarea('hobby', array('class' => 'form-input short-input', 'maxlength' => 500));
            ?>
        </div>
    </div>
</div>

<!-- ページ最下部に配置 -->
<div class="profile-edit-links">
    <p class="link-line">
        <?php echo $this->Html->link('View Profile', array('controller' => 'users', 'action' => 'profile_view')); ?>
    </p>
    <p class="link-line">
        <?php echo $this->Html->link('Back to My Page', array('controller' => 'users', 'action' => 'mypage')); ?>
    </p>
</div>
