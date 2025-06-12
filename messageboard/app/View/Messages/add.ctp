<style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f8f9fa;
}

.form-wrapper {
    width: 100%;
    max-width: 500px;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
</style>

<div class="container">
    <div class="form-wrapper">
        <h2 class="mb-4 text-center">New Message</h2>

        <?php
        echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js');
        echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css');
        ?>

        <?php echo $this->Form->create('Message', ['class' => 'mb-4']); ?>

        <div class="form-group mb-3">
            <?php
            echo $this->Form->label('recipient_id', 'Recipient', ['class' => 'form-label']);
            echo $this->Form->select('recipient_id', $recipient, [
                'id' => 'recipient-select',
                'class' => 'form-control',
                'empty' => 'Please select'
            ]);
            ?>
        </div>

        <div class="form-group mb-3">
            <?php
            echo $this->Form->label('content', 'Message', ['class' => 'form-label']);
            echo $this->Form->textarea('content', ['class' => 'form-control', 'rows' => 3]);
            ?>
        </div>

        <div class="form-group text-center">
            <?php echo $this->Form->submit('Send Message', ['class' => 'btn btn-primary w-100']); ?>
        </div>

        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#recipient-select').select2({
        placeholder: 'Search by username',
        ajax: {
            url: '<?php echo $this->Html->url(['controller' => 'users', 'action' => 'search']); ?>',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        },
        minimumInputLength: 1,
        width: '100%'
    });
});
</script>
