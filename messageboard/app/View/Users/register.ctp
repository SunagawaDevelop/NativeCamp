<div class="register-container">
    <div class="register-form">

        <div class="form-row">
            <label class="form-label form-title">User Registration</label>
        </div>

        <?= $this->Form->create('User', [
            'url' => ['controller' => 'users', 'action' => 'register']
        ]); ?>

            <?= $this->Form->label('name', 'Name', ['class' => 'form-label']) ?>
            <?= $this->Form->text('name', ['class' => 'form-input']) ?>
        </div>

        <div class="form-row">
            <?= $this->Form->label('email', 'Email', ['class' => 'form-label']) ?>
            <?= $this->Form->text('email', ['class' => 'form-input']) ?>
        </div>

        <div class="form-row">
            <?= $this->Form->label('password', 'Password', ['class' => 'form-label']) ?>
            <?= $this->Form->password('password', ['class' => 'form-input']) ?>
        </div>

        <div class="form-row">
            <?= $this->Form->label('password_confirm', 'Confirm Password', ['class' => 'form-label']) ?>
            <?= $this->Form->password('password_confirm', ['class' => 'form-input']) ?>
        </div>

        <div class="form-actions">
            <?= $this->Form->end([
                'label' => 'Register',
                'class' => 'btn-register'
            ]); ?>
        </div>

    </div>
</div>
