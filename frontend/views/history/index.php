<?php

use frontend\assets\BackendAsset;
/** @var yii\web\View $this */

$backend = BackendAsset::register($this);
$this->title = 'Lịch sửa mua';

?>

<div class="row d-flex justify-content-between mt-3">
    <div class="col-lg-3 col-md-3">
        <div class="trending-tittle">
            <strong>Lịch sử mua</strong>   
        </div>
    </div>
</div>

 <div class="trending-bottom">
    <div class="row">
        <?php foreach ($model as $list) : ?>
            <div class="col-lg-4">
                <div class="single-bottom mb-35">
                    <div class="trend-bottom-img mb-30">
                        <img src="<?= $backend->baseUrl.'/'.$list->post->image ?>" alt="">
                    </div>
                    <div class="trend-bottom-cap">
                        <h4 class="mt-3" style="height: 5rem;"><a href="/bai-viet/<?= $list->post->slug ?>.html"><?= $list->post->title ?></a></h4>
                        <span class="color1"><?= $list->post->category->name ?></span>

                            <p class = text-danger><?=$list->post->coin?> xu</p>
                            <p class = "text-primary">Đã mua</p>
                      
                            <a name="" id="" class="btn btn-danger" href="/bai-viet/<?=$list->post->slug?>.html" role="button">Chi tiết</a>

                    </div>
                </div>
                
            </div>
        <?php endforeach ?>
    </div>
</div>