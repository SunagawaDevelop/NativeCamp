<div class="profile-view-container">
    <div class="profile-view-box">

        <h2 class="profile-title">Profile</h2>

        <?php
        // Profile photo
        if (!empty($user['User']['photo'])) {
            echo '<div class="profile-photo">';
            echo $this->Html->image('/img/' . h($user['User']['photo']), array(
                'alt' => 'Profile Photo',
                'width' => '150'
            ));
            echo '</div>';
        } else {
            echo '<p class="no-photo">No profile photo set.</p>';
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
