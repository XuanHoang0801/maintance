<?php
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\ActiveForm;
use frontend\models\PostBuy;
use frontend\assets\BackendAsset;

$this->registerJsFile('@web/js/popup.js', ['depends' =>  [yii\web\YiiAsset::className()], ]);
$backend = BackendAsset::register($this);
$this->title = 'Kết quả tìm kiếm của: "'.$key."";
?>
<div class="row d-flex justify-content-between mt-3">
    <div class="col-lg-3 col-md-3">
        <div class="trending-tittle">
        Kết quả tìm kiếm của: "<?=  $key ?>" 
        </div>
        <aside class="single_sidebar_widget search_widget">
            <?php $form = ActiveForm::begin([
                                                'action' => 'tim-kiem',
                                                'method' => 'get',
                                            ]); ?>
                <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="key" placeholder='Nhập từ khóa tìm kiếm...' required>
                    <div class="input-group-append">
                        <button class="btns bg-warning" type="submit"><i class="ti-search "></i></button>
                    </div>
                </div>
                </div>
            <?php ActiveForm::end(); ?>
        </aside>
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
                        <!-- <span class="color1"><?= $list->category->name ?></span> -->
                        <h4 class="mt-3"><?= $list->title ?></h4>

                        <?php 
                            if($list->author_id == Yii::$app->user->id ){
                       
                                if($list->is_free == 0){
                        ?>
                            <p class = text-danger><?=$list->coin?> xu</p>
                        <?php } else {?>
                            <p class = "text-primary">Miễn phí</p>
                        <?php } ?>
                              <p class= "text-warning">Bài viết của tôi</p>  
                            <a name="" id="" class="btn btn-danger" href="/bai-viet/<?=$list->slug?>.html" role="button">Chi tiết</a>
                        <?php }else{ ?>


                        <?php 
                            if($list->is_free == 0){
                        ?>
                            <?php if(Yii::$app->user->isGuest){ ?>
                                <p class = text-danger><?=$list->coin?> xu</p>
                                <a href="/login" id="" class="btn btn-danger" role="button">Mua ngay</a>
                            <?php
                                 } else{
                                    $check = PostBuy::find()->where(['post_id' => $list->id])->andWhere(['user_id' => Yii::$app->user->id])->one();
                                    if($check){
                            ?>
                                <p class = text-success>Đã mua</p>
                                <a name="" id="" class="btn btn-danger" href="/bai-viet/<?=$list->slug?>.html" role="button">Chi tiết</a>
                            <?php } else{ ?>
                                <p class = text-danger><?=$list->coin?> xu</p>

                                <button type="button" class="btn btn-primary select" data-id= "<?= $list->id ?>" data-toggle="modal" data-target="#myModal">Mua ngay</button>

                        <?php } } }else {?>
                            <p class = "text-primary">Miễn phí</p>
                            <a name="" id="" class="btn btn-danger" href="/bai-viet/<?=$list->slug?>.html" role="button">Chi tiết</a>
                        <?php } }  ?>

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