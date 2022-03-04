
<div class="message">
    <?php foreach ($this->data['message'] as $message): ?>
        <div class="demotext">
            <div>
                <h2>Message</h2>
            </div>
            <div>
                <p><?php echo $message->getMessage(); ?></p>
            </div>
            <div>
                <p><?php echo $message->getDate(); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
