<div class="register-form">
    <div class="form-box">
        <div class="form-row">
            <label class="form-title">User Registration</label>
            <?= $this->Session->flash('auth'); ?>
        </div>

        <?php if (!empty($isRegistered)): ?>
            <div class="form-row">
                <p>Thank you for register</p>
            </div>
            <div class="form-actions">
                <?= $this->Html->link(
                    'Back to homepage',
                    ['controller' => 'users', 'action' => 'mypage'],
                    ['class' => 'btn-login']
                ); ?>
            </div>
        <?php else: ?>
            <?= $this->Form->create('User', [
                'url' => ['controller' => 'users', 'action' => 'register']
            ]); ?>

            <!-- Name -->
            <div class="form-row-inline">
                <?= $this->Form->label('name', 'Name', ['class' => 'form-label-inline']) ?>
                <?= $this->Form->text('name', ['class' => 'form-input-inline']) ?>
                <?= $this->Form->error('name', null, ['wrap' => 'span', 'class' => 'form-error-inline']) ?>
            </div>

            <!-- Email -->
            <div class="form-row-inline">
                <?= $this->Form->label('email', 'Email', ['class' => 'form-label-inline']) ?>
                <?= $this->Form->text('email', ['class' => 'form-input-inline']) ?>
                <?= $this->Form->error('email', null, ['wrap' => 'span', 'class' => 'form-error-inline']) ?>
            </div>

            <!-- Password -->
            <div class="form-row-inline">
                <?= $this->Form->label('password', 'Password', ['class' => 'form-label-inline']) ?>
                <?= $this->Form->password('password', ['class' => 'form-input-inline']) ?>
                <?= $this->Form->error('password', null, ['wrap' => 'span', 'class' => 'form-error-inline']) ?>
            </div>

            <!-- Confirm Password -->
            <div class="form-row-inline">
                <?= $this->Form->label('password_confirm', 'Confirm Password', ['class' => 'form-label-inline']) ?>
                <?= $this->Form->password('password_confirm', ['class' => 'form-input-inline']) ?>
                <?= $this->Form->error('password_confirm', null, ['wrap' => 'span', 'class' => 'form-error-inline']) ?>
            </div>

            <div class="form-actions">
                <?= $this->Form->end([
                    'label'  => 'Register',
                    'class'  => 'btn-login'
                ]); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
