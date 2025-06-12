<div class="register-form">

    <div class="form-row">
        <label class="form-label form-title">User Registration</label>
    </div>

    <?php
    echo $this->Form->create('User', array(
        'url' => array('controller' => 'users', 'action' => 'register')
    ));

    echo '<div class="form-row">';
    echo $this->Form->label('name', 'Name', array('class' => 'form-label'));
    echo $this->Form->text('name', array('class' => 'form-input'));
    echo '</div>';

    echo '<div class="form-row">';
    echo $this->Form->label('email', 'Email', array('class' => 'form-label'));
    echo $this->Form->text('email', array('class' => 'form-input'));
    echo '</div>';

    echo '<div class="form-row">';
    echo $this->Form->label('password', 'Password', array('class' => 'form-label'));
    echo $this->Form->password('password', array('class' => 'form-input'));
    echo '</div>';

    echo '<div class="form-row">';
    echo $this->Form->label('password_confirm', 'Confirm Password', array('class' => 'form-label'));
    echo $this->Form->password('password_confirm', array('class' => 'form-input'));
    echo '</div>';

    echo '<div class="form-actions">';
    echo $this->Form->end(array(
        'label' => 'Register',
        'class' => 'btn-register'
    ));
    echo '</div>';
    ?>
</div>
