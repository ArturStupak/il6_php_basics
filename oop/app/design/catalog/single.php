<?php $ad = $this->data['ad']; ?>
    <div class="wrapper-single">
        <div>
            <h3><?= $ad->getTitle(); ?></h3>
            <?php if($_SESSION['user_id'] !== $ad->getUserId()): ?>
                <?php if($this->data['favorite']): ?>
                    <form action="<?= $this->url('catalog/deleteFavoriteAd') ?>" method="POST">
                        <input type="hidden" name="ad_id" value="<?= $ad->getId(); ?>">
                        <input class="btn btn-primary" type="submit" value="delete" name="delete_favorite">
                    </form>
                <?php else: ?>
                    <form action="<?= $this->url('catalog/createFavoriteAd') ?>" method="POST">
                        <input type="hidden" name="ad_id" value="<?= $ad->getId(); ?>">
                        <input class="btn btn-primary" type="submit" value="remember" name="remember">
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </div>

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
            <span>Skelbimo ivertinimas(<?= $this->data['rating_count'] ?>):</span>
        </div>
        <div>
            <?= $this->data['ad_rating'] ?>
        </div>
        <?php if ($this->isUserLoged()): ?>
        <div class="ratings">
            <form action="<?= $this->url('catalog/rate') ?>" method="POST">
                <input type="hidden" name="ad_id" value="<?= $ad->getId(); ?>">
                <p>Rating:</p>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <input type="radio"
                        <?php if ($this->data['rated'] && $this->data['user_rate'] == $i): ?>
                            checked
                        <?php endif; ?>
                           value="<?= $i ?>" name="rate">
                <?php endfor; ?>
                <input type="submit" value="Ragte this garbage!" name="rate_submit">
            </form>
        </div>
        <div>
            <div class="form-wrapper">
                <?php echo $this->data['form']; ?>
            </div>
        </div>
        <div>
            <?php if($this->isUserLoged()): ?>
                <a href="<?= $this->url('message/chat/'.$ad->getUserId()) ?>">
                    Rasyti zinute savininkui
                </a>
            <?php endif; ?>
        </div>
        <div class="comments">
            <?php foreach ($this->data['comments'] as $comment): ?>
                <div>
                    <div class="demotext">
                        <div>
                            <h1>Komentaras:</h1>
                        </div>
                        <div>
                            <p><?php echo $comment->getComment(); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>