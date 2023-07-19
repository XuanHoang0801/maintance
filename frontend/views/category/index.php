<?php
/** @var yii\web\View $this */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\YiiAsset;
use frontend\models\PostBuy;
use frontend\assets\BackendAsset;

$this->registerJsFile('@web/js/popup.js', ['depends' =>  [yii\web\YiiAsset::className()], ]);
$backend = BackendAsset::register($this);
$this->title = $cat->name
?>
<div class="row d-flex justify-content-between mt-3">
    <div class="col-lg-3 col-md-3">
        <div class="trending-tittle">
            <strong><?=  $cat->name ?></strong>   
        </div>
    </div>
</div>

 <div class="trending-bottom">
    <div class="row">

    <div class="trending-tittle">
        <span class="color1">Bài viết miễn phí</span>
    </div>
        <?php if(!$free){ ?>
            <div id="w1-warning-0" class="alert-warning alert alert-dismissible" role="alert">
                Không có bài viết nào!
            </div>
        <?php } foreach ($free as $listFree) : ?>
            <div class="col-lg-4">
                <div class="single-bottom mb-35">
                    <div class="trend-bottom-img mb-30">
                        <img class= "img" src="<?= $backend->baseUrl.'/'.$listFree->image ?>" alt="">
                    </div>
                    <div class="trend-bottom-cap">
                        <!-- <span class="color1"><?= $listFree->category->name ?></span> -->
                        <h4 class="mt-3" style="height: 5rem;"><?= $listFree->title ?></h4>

                        <?php 
                            if($listFree->author_id == Yii::$app->user->id ){
                       
                        ?>
                            <p class= "text-warning">Bài viết của tôi</p>  
                            <a name="" id="" class="btn btn-danger mt-3" href="<?= Url::toRoute('/bai-viet/', true) ?>/<?=$listFree->slug?>.html" role="button">Chi tiết</a>
                        <?php }else{ ?>
                            <a name="" id="" class="btn btn-danger mt-3" href="<?= Url::toRoute('/bai-viet/', true) ?>/<?=$listFree->slug?>.html" role="button">Chi tiết</a>
                        <?php  }  ?>

                    </div>
                </div>
                
            </div>
        <?php endforeach ?>
    </div>
    <div class="row">
        <div class="trending-tittle">
            <span class="color1">Bài viết tính phí</span>
        </div>
        <?php if(!$model){ ?>
            <div id="w1-warning-0" class="alert-warning alert alert-dismissible" role="alert">
                Không có bài viết nào!
            </div>
        <?php } foreach ($model as $list) : ?>
            <div class="col-lg-4">
                <div class="single-bottom mb-35">
                    <div class="trend-bottom-img mb-30">
                        <img class="img" src="<?= $backend->baseUrl.'/'.$list->image ?>" alt="">
                    </div>
                    <div class="trend-bottom-cap">
                        <h4 class="mt-3" style="height: 5rem;"><?= $list->title ?></h4>
                        <?php 
                            if($list->author_id == Yii::$app->user->id ){
                        ?>
                            <p class = text-danger><?=$list->coin?> xu</p>
                            <p class= "text-warning">Bài viết của tôi</p>  
                            <a name="" id="" class="btn btn-danger" href="<?= Url::toRoute('/bai-viet/', true) ?>/<?=$list->slug?>.html" role="button">Chi tiết</a>
                        <?php }else{ 
                                        if(Yii::$app->user->isGuest){ ?>
                                            <p class = text-danger><?=$list->coin?> xu</p>
                                            <a href="<?= Url::toRoute('/dang-nhap', true) ?>" id="" class="btn btn-danger" role="button">Mua ngay</a>
                                    <?php
                                        } else{
                                                $check = PostBuy::find()->where(['post_id' => $list->id])->andWhere(['user_id' => Yii::$app->user->id])->one();
                                                if($check){ ?>
                                                            <p class = text-success>Đã mua</p>
                                                            <a name="" id="" class="btn btn-danger" href="<?= Url::toRoute('/bai-viet/', true) ?>/<?=$list->slug?>.html" role="button">Chi tiết</a>
                                                    <?php } else{ ?>
                                                                    <p class = text-danger><?=$list->coin?> xu</p>
                                                                    <button type="button" class="btn btn-primary select" data-id= "<?= $list->id ?>" data-toggle="modal" data-target="#myModal">Mua ngay</button>
                        <?php } } } ?>

                    </div>
                </div>
                
            </div>
        <?php endforeach ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel">Thông báo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bạn có chắc chắn muốn Mua ngay bài viết này không?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary ok">Đồng ý</button>
      </div>
    </div>
  </div>
</div>