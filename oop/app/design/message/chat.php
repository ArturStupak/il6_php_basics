
<head>
    <title>Autopliusas</title>
    <link rel="stylesheet" href="<?php echo BASE_URL_WITHOUT_INDEX_PHP.'css/style.css';?>">
</head>

<h1>Chat</h1>
<div class="chat">
        <form action="<?php echo $this->Url('/message/createMessage') ?>" method="POST">
            <div>
                <select name="user_id">
                    <?php foreach($this->data['options'] as $key => $user):?>
                        <option value="<?php echo $key?>">
                            <?php echo $user; ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
            <div>
                <textarea name="message" placeholder="message"></textarea>
            </div>
            <div>
                <input type="submit" value="send" name="create">
            </div>
        </form>
</div>
