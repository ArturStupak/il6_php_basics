<?php $pages = ceil($this->data['count'] / 2); ?>
<div class="ads-list">
    <?php foreach ($this->data['ads'] as $ad): ?>
<!--        <div class="box">-->
<!--            <a href="--><?php //echo $this->url('catalog/show', $ad->getSlug()) ?><!--">-->
<!--                <img src="--><?php //echo $ad->getImage() ?><!--">-->
<!--                <div class="title">-->
<!--                    --><?php //echo $ad->getTitle() ?>
<!--                </div>-->
<!--                <div class="price">-->
<!--                    --><?php //echo $ad->getPrice() ?>
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
        <div class="card" style="width: 18rem;">
            <img src="<?php echo $ad->getImage() ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $ad->getTitle() ?></h5>
                <p class="card-text"><?php echo $ad->getPrice() ?></p>
                <a href="<?php echo $this->url('catalog/show', $ad->getSlug()) ?>" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="pagination">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
        <?php for($i = 1;$i <= $pages; $i++):?>
<!--            <a href="--><?php //echo $this->url('catalog'). '?p=' . $i; ?><!--">--><?php //echo $i ?><!--</a>-->
<!--            <li class="page-item"><a class="page-link" href="--><?php //echo $this->url('catalog'). '?p=' . $i; ?><!--">--><?php //echo $i ?><!--</a></li>-->
                <li class="page-item"><a class="page-link" href="<?php echo $this->url('catalog'). '?p=' . $i; ?>"><?php echo $i ?></a></li>
        <?php endfor;?>
        </ul>
    </nav>
</div>

