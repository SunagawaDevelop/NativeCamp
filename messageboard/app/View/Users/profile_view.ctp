<div class="profile-view-container">
    <div class="profile-view-box">

        <h2 class="profile-title">Profile</h2>

        <?php if (!empty($user['logindate'])): ?>
            <p class="last-login">Last Login: <strong><?php echo h($user['logindate']); ?></strong></p>
        <?php endif; ?>

        <?php
        // Profile photo
        if (!empty($user['photo'])) {
            echo $this->Html->image('/img/' . h($user['photo']), [
                'alt' => 'Profile Photo',
                'width' => '150',
                'id' => 'preview'
            ]);
        } else {
            echo '<img id="preview" src="/img/no_image.png" width="150" alt="No Photo" />';
        }

        echo '<p><strong>Name: </strong>' . h($user['name']) . '</p>';
        echo '<p><strong>Email: </strong>' . h($user['email']) . '</p>';
        echo '<p><strong>Birthdate: </strong>' . h($user['birthdate']) . '</p>';

        $gender = '';
        if ($user['gender'] === 'Male') {
            $gender = 'Male';
        } elseif ($user['gender'] === 'Female') {
            $gender = 'Female';
        }
        echo '<p><strong>Gender: </strong>' . $gender . '</p>';

        echo '<p><strong>Hobby: </strong><br />' . nl2br(h($user['hobby'])) . '</p>';
        ?>

        <p class="link-line"><?php echo $this->Html->link('Back to My Page', array('controller' => 'users', 'action' => 'mypage')); ?></p>
    </div>
</div>
