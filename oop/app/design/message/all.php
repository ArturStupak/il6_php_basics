

<div class="message">
    <?php foreach ($this->data['chat'] as $chat): ?>
        <div class="demotext">
            <div>
                <p><?= $chat['chat_friend']->getName() ?></p>
            </div>
            <div>
                <p><?php echo $chat['message']->getDate() ?></p>
            </div>
            <?php $class = '';
            if($chat['message']->getReceiverId() == $_SESSION['user_id'] && $chat['message']->getStatus() == 1 )
            {
                $class = 'bolt';
            }
            ?>
            <div class="last-message-body <?=  $class ?>">
                <p><?php echo $chat['message']->getMessage() ?></p>
            </div>
            <div>
                <a href="<?= $this->url('message/chat/' . $chat['chat_friend']->getId())?>">
                    Chat with <?= $chat['chat_friend']->getName()?>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
