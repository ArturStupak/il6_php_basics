<?php $pages = ceil($this->data['count'] / 2); ?>

    <div class="favorite-list">
        <?php foreach ($this->data['favorites'] as $favorite): ?>
        <div class="ad">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $favorite->getImage() ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $favorite->getTitle() ?></h5>
                    <p class="card-text"><?php echo $favorite->getPrice() ?></p>
                    <form action="<?= $this->url('catalog/deleteFavoriteAdFromList') ?>" method="POST">
                        <input type="hidden" name="ad_id" value="<?= $favorite->getId(); ?>">
                        <input class="btn btn-primary" type="submit" value="delete" name="delete_favorite">
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="pagination">
        <ul>
            <?php for($i = 1;$i <= $pages; $i++):?>
                <a href="<?php echo $this->url('catalog'). '?p=' . $i; ?>"><?php echo $i ?></a>

            <?php endfor;?>
        </ul>
    </div>