<div class="profile-view-container">
    <div class="profile-view-box">
        <h2 class="profile-title">Profile</h2>

        <?php if (!empty($user['User']['logindate'])): ?>
            <p class="last-login">Last Login: <strong><?php echo h($user['User']['logindate']); ?></strong></p>
        <?php endif; ?>

        <?php
        // プロフィール画像
        if (!empty($user['User']['photo'])) {
            echo $this->Html->image('/img/' . h($user['User']['photo']), [
                'alt' => 'Profile Photo',
                'width' => '150',
                'id' => 'preview'
            ]);
        } else {
            echo '<img id="preview" src="/messageboard/img/uploads/no_image.png" width="150" alt="No Photo" />';
        }

        echo '<p><strong>Name: </strong>' . h($user['User']['name']) . '</p>';
        echo '<p><strong>Email: </strong>' . h($user['User']['email']) . '</p>';
        echo '<p><strong>Birthdate: </strong>' . h($user['User']['birthdate']) . '</p>';

        $gender = '';
        if ($user['User']['gender'] === 'Male') {
            $gender = 'Male';
        } elseif ($user['User']['gender'] === 'Female') {
            $gender = 'Female';
        }
        echo '<p><strong>Gender: </strong>' . $gender . '</p>';

        echo '<p><strong>Hobby: </strong><br />' . nl2br(h($user['User']['hobby'])) . '</p>';
        ?>
        
        <p class="link-line"><?php echo $this->Html->link('Back to My Page', array('controller' => 'users', 'action' => 'mypage')); ?></p>
    </div>
</div>
