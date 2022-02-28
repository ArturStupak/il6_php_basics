<?php $ad = $this->data['ad']; ?>
    <div class="wrapper-single">
        <h1><?= $ad->getTitle(); ?></h1>
        <div class="image-wrapper">
            <img src="<?= $ad->getImage() ?>">
        </div>
        <div class="price">
            <?= "Kaina: " . $ad->getPrice(); ?>
        </div>
        <div class="details">
            <p>
                <?= "Aprasymas: " . $ad->getDescription(); ?>
            </p>
        </div>
        <div class="details">
            <p>
                <?=  "VIN: " . $ad->getVin(); ?>
            </p>
        </div>
        <div>
            <div class="form-wrapper">
                <?php echo $this->data['form']; ?>
            </div>
        </div>
        <div class="comments">
            <?php foreach ($this->data['comments'] as $comment): ?>
                <div>
                        <div class="demotext">
                            <h2>Komentaras</h2>
                           <p><?php echo $comment->getMessage(); ?></p>
                        </div>
                </div>
            <?php endforeach; ?>
        </div>

