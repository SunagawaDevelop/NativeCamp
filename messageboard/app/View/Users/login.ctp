<div class="login-form">
    <div class="form-box">
        <div class="form-row">
            <label class="form-title">Login</label>
        </div>

        <?php
        if (!empty($loginResult)) {
            echo '<p class="login-error">' . h($loginResult) . '</p>';
        }

        echo $this->Form->create('User', array(
            'url' => array('controller' => 'users', 'action' => 'login')
        ));

        // Email 横並び
        echo '<div class="form-row-inline">';
        echo $this->Form->label('email', 'Email', array('class' => 'form-label-inline'));
        echo $this->Form->text('email', array('class' => 'form-input-inline'));
        echo '</div>';

        // Password 横並び
        echo '<div class="form-row-inline">';
        echo $this->Form->label('password', 'Password', array('class' => 'form-label-inline'));
        echo $this->Form->password('password', array('class' => 'form-input-inline'));
        echo '</div>';

        echo '<div class="form-actions">';
        echo $this->Form->end(array(
            'label' => 'Login',
            'class' => 'btn-login'
        ));
        echo '</div>';
        ?>

        <p class="link-line"><?php echo $this->Html->link('Click here to register', array('controller' => 'users', 'action' => 'register')); ?></p>
    </div>
</div>
