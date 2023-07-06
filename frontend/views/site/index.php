<?php

/** @var yii\web\View $this */

use yii\web\YiiAsset;
use frontend\models\Post;
use backend\models\Setting;
use common\models\Customer;
use yii\widgets\ActiveForm;
use frontend\models\PostBuy;
use frontend\assets\BackendAsset;
$this->registerJsFile('@web/js/popup.js', ['depends' =>  [YiiAsset::className()], ]);


$backend =  BackendAsset::register($this);
$this->title = Setting::title()->content;
?>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <strong><?= Setting::trending()->content ?></strong>   
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">
                                <?php foreach($hot as $listHost): ?>
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            <img src="<?= $backend->baseUrl.'/'.$listHost->image ?>" alt="">
                                        </div>
                                        <div class="trend-bottom-cap">
                                            <h4 style="height: 5rem;"><a href="/bai-viet/<?= $listHost->slug ?>.html"><?= $listHost->title ?></a></h4>    
                                            <span class="color1"><?= $listHost->category->name ?></span>
                                        </div>

                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <!-- Riht content -->
                    <div class="col-lg-4">
                        <div class="blog_right_sidebar">

                            <aside class="single_sidebar_widget search_widget">
                                <?php $form = ActiveForm::begin([
                                                                    'action' => 'tim-kiem',
                                                                    'method' => 'get',
                                                                ]); ?>
                                    <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="key" placeholder='Nhập từ khóa tìm kiếm...' required>
                                        <div class="input-group-append">
                                            <button class="btns" type="submit"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                    </div>
                                <?php ActiveForm::end(); ?>
                            </aside>
                        
                            <div class="trand-right-single d-flex">
                                <div class="trending-tittle">
                                    <strong class="color1">Bài viết tính phí</strong>
                                </div>
                            </div>
                                <?php foreach($charge as $chargeItem): 
                                
                                    $check = PostBuy::find()->where(['post_id' => $chargeItem->id])->andWhere(['user_id' => Yii::$app->user->id])->one();
                                    if(!$check){
                                ?>
                                    
                                    <div class="trand-right-single">
                                        <div class="trand-right-cap  d-flex">
                                            <div class="trand-right-img">
                                                <img src="<?= $backend->baseUrl.'/'.$chargeItem->image ?>" alt="" width="100px">
                                            </div>
                                            <h4><a href="/bai-viet/<?= $chargeItem->slug ?>.html"><?= $chargeItem->title ?></a></h4>
                                        </div>
                                        <div class="text-end">

                                            <span class="color1"><?= $chargeItem->category->name ?></span>
                                            <p class = text-danger><?=$chargeItem->coin?> xu</p>                    
                                            <?php if(Yii::$app->user->isGuest){ ?>
                                                <a href="/login" id="" class="btn btn-primary" role="button">Mua ngay</a>
                                            <?php
                                                } else{
                                            ?>
                                                <!-- <p class = text-success>Đã mua</p>
                                                <a name="" id="" class="btn btn-danger" href="/bai-viet/<?=$chargeItem->slug?>.html" role="button">Chi tiết</a> -->
                                                <button type="button" class="btn btn-primary select" data-id= "<?= $chargeItem->id ?>" data-toggle="modal" data-target="#myModal">Mua ngay</button>

                                            <?php }  ?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <?php endforeach ?>
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


                        <!-- <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="assets/img/trending/right2.jpg" alt="">
                            </div>
                            <div class="trand-right-cap">
                                <span class="color3">sea beach</span>
                                <h4><a href="details.html">Welcome To The Best Model Winner Contest</a></h4>
                            </div>
                        </div>
                        <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="assets/img/trending/right3.jpg" alt="">
                            </div>
                            <div class="trand-right-cap">
                                <span class="color2">Bike Show</span>
                                <h4><a href="details.html">Welcome To The Best Model Winner Contest</a></h4>
                            </div>
                        </div> 
                        <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="assets/img/trending/right4.jpg" alt="">
                            </div>
                            <div class="trand-right-cap">
                                <span class="color4">See beach</span>
                                <h4><a href="details.html">Welcome To The Best Model Winner Contest</a></h4>
                            </div>
                        </div>
                        <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="assets/img/trending/right5.jpg" alt="">
                            </div>
                            <div class="trand-right-cap">
                                <span class="color1">Skeping</span>
                                <h4><a href="details.html">Welcome To The Best Model Winner Contest</a></h4>
                            </div>
                        </div>` -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->
  
    <!--Start pagination -->
    <!-- <div class="pagination-area pb-45 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                              <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow roted"></span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                              <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow right-arrow"></span></a></li>
                            </ul>
                          </nav>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End pagination  -->
