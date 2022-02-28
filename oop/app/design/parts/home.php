
<div class="row">
    <div>
        <h1>5 populiariausi skelbimai</h1>
    </div>
    <div class="column">
        <?php foreach ($this->data['laters'] as $ad): ?>
            <div class="list-wrapper">
                <img width="200" height="130" src="<?php echo $ad->getImage() ?>">
                <p class="price"><?php echo $ad->getTitle(). ' '. $ad->getPrice() . ' '?></p>
                <p>
                    <button onclick= "window.location.href='<?php echo BASE_URL. '/catalog/show/'. $ad->getSlug() ?>'">
                        Clisk here
                    </button>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="row">
    <div>
        <h1>5 populiariausi skelbimai</h1>
    </div>
    <div class="column">
        <?php foreach ($this->data['populars'] as $ad): ?>
        <div class="list-wrapper">
            <img width="200" height="130" src="<?php echo $ad->getImage() ?>">
            <p class="price"><?php echo $ad->getTitle(). ' '. $ad->getPrice() . ' '?></p>
<!--            <p>-->
<!--                <button onclick="--><?php //echo BASE_URL. '/catalog/show/'. $ad->getSlug() ?><!--">-->
<!--                Clisk here-->
<!--                </button>-->
<!--            </p>-->
            <a href="<?php echo BASE_URL. '/catalog/show/'. $ad->getSlug() ?>">click</a>
        </div>
        <?php endforeach; ?>
    </div>
</div>




