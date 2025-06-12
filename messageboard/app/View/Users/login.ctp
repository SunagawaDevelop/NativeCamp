<div class="login-form">
    <div class="form-box">

        <div class="form-row">
            <label class="form-label form-title">Login</label>
        </div>

        <?php
        if (!empty($loginResult)) {
            echo '<p class="login-error">' . h($loginResult) . '</p>';
        }

        echo $this->Form->create('User', array(
            'url' => array('controller' => 'users', 'action' => 'login')
        ));

        echo '<div class="form-row">';
        echo $this->Form->label('email', 'Email', array('class' => 'form-label'));
        echo $this->Form->text('email', array('class' => 'form-input short-input'));
        echo '</div>';

        echo '<div class="form-row">';
        echo $this->Form->label('password', 'Password', array('class' => 'form-label'));
        echo $this->Form->password('password', array('class' => 'form-input short-input'));
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
