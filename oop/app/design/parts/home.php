<div class="homePage">
    <h1>Home page</h1>
</div>
<div>
    <div class="row">
        <div class="column">
            <h1>5 naujausi skelbimai</h1>
            <div class="list-wrapper">
                <ol>
                    <?php foreach ($this->data['laters'] as $ad): ?>
                        <li>
                            <a href="<?php echo BASE_URL. $ad->getSlug() ?>">
                                <?php echo $ad->getTitle(). ' '. $ad->getModelId() . ' '?>
                                <br>
                                <img width="200" src="<?php echo $ad->getImage() ?>">

                            </a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
        <div class="column">
            <h1>5 populiariausi skelbimai</h1>
            <div class="list-wrapper">
                <ol>
                    <?php foreach ($this->data['populars'] as $ad): ?>
                        <li>
                            <a href="<?php echo BASE_URL. $ad->getSlug() ?>">
                                <?php echo $ad->getTitle(). ' '. $ad->getModelId() . ' '?>
                                <br>
                                <img width="200" src="<?php echo $ad->getImage() ?>">

                            </a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>
</div>


