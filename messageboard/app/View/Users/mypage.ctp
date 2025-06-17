<div class="mypage-container">
    <div class="mypage-box">
        <h2 class="mypage-title">My Page</h2>

        <?php if (!empty($user)) : ?>
            <p class="welcome-msg">You are logged in! Welcome, <strong><?php echo h($user['email']); ?></strong>.</p>
            <p class="login-date">
                Last Login: <strong><?php echo h($user['logindate']); ?></strong>
            </p>
        <?php else : ?>
            <p class="error-msg">Failed to retrieve user information.</p>
        <?php endif; ?>

        <div class="mypage-links">
            <?php
            echo $this->Html->link('View Profile', ['controller' => 'users', 'action' => 'profile_view'], ['class' => 'btn-link']);
            echo $this->Html->link('Edit Profile', ['controller' => 'users', 'action' => 'profile'], ['class' => 'btn-link']);
            echo $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout'], ['class' => 'btn-link logout']);
            echo $this->Html->link('Messages', ['controller' => 'messages', 'action' => 'index'], ['class' => 'btn-link']);
            ?>
        </div>
    </div>
</div>

