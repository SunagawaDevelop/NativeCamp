<div class="login-form">
    <div class="form-box">
        <div class="form-row">
            <label class="form-title">Login</label>
        </div>

        <?php if (!empty($loginResult)): ?>
            <p class="login-error"><?php echo h($loginResult); ?></p>
        <?php endif; ?>

        <?php echo $this->Form->create('User', [
            'url' => ['controller' => 'users', 'action' => 'login'],
            'type' => 'post'
        ]); ?>

        <div class="form-row-inline">
            <?php
                echo $this->Form->label('email', 'Email', ['class' => 'form-label-inline']);
                echo $this->Form->text('email', ['class' => 'form-input-inline']);
            ?>
        </div>

        <div class="form-row-inline">
            <?php
                echo $this->Form->label('password', 'Password', ['class' => 'form-label-inline']);
                echo $this->Form->password('password', ['class' => 'form-input-inline']);
            ?>
        </div>

        <div class="form-actions">
            <?php echo $this->Form->submit('Login', ['class' => 'btn-login']); ?>
        </div>

        <?php echo $this->Form->end(); ?>

        <p class="link-line">
            <?php echo $this->Html->link('Click here to register', ['controller' => 'users', 'action' => 'register']); ?>
        </p>
    </div>
</div>
