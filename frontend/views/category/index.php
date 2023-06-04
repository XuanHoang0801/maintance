<?php
/** @var yii\web\View $this */

use frontend\assets\BackendAsset;
use yii\helpers\Html;

$backend = BackendAsset::register($this);

$this->title = $cat->name
?>
<div class="row d-flex justify-content-between mt-3">
    <div class="col-lg-3 col-md-3">
        <div class="section-tittle mb-30">
            <h3><?=  $cat->name ?></h3>
        </div>
    </div>
</div>

 <div class="trending-bottom">
    <div class="row">
        <?php foreach ($model as $list) : ?>
            <div class="col-lg-4">
                <div class="single-bottom mb-35">
                    <div class="trend-bottom-img mb-30">
                        <img src="<?= $backend->baseUrl.'/'.$list->image ?>" alt="">
                    </div>
                    <div class="trend-bottom-cap">
                        <span class="color1"><?= $list->category->name ?></span>
                        <h4 class="mt-3"><a href="/bai-viet/<?= $list->slug ?>.html"><?= $list->title ?></a></h4>

                        <?php 
                            if($list->author_id == Yii::$app->user->id ){
                       
                                if($list->is_free == 0){
                        ?>
                            <p class = text-danger>Bài viết tính phí: <?=$list->coin?> xu</p>
                        <?php } else {?>
                            <p class = "text-success">Miễn phí</p>
                        <?php } ?>
                              <p class= "text-warning">Bài viết của tôi</p>  
                            <a name="" id="" class="btn btn-danger" href="/bai-viet/<?=$list->slug?>.html" role="button">Chi tiết</a>
                        <?php }else{ ?>


                        <?php 
                            if($list->is_free == 0){
                        ?>
                            <p class = text-danger>Bài viết tính phí: <?=$list->coin?> xu</p>
                            <a name="" id="" class="btn btn-danger" role="button">Mua</a>

                        <?php } else {?>
                            <p class = "text-success">Miễn phí</p>
                            <a name="" id="" class="btn btn-danger" href="/bai-viet/<?=$list->slug?>.html" role="button">Chi tiết</a>
                        <?php } }  ?>

                    </div>
                </div>
                
            </div>
        <?php endforeach ?>
    </div>
</div>