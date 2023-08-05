<?php

/** @var yii\web\View $this */

<<<<<<< HEAD
use yii\helpers\Url;
use yii\web\YiiAsset;
use frontend\models\Post;
=======
>>>>>>> 2e0cad38de619d2d7dfc0334eaa1d48ac13d6450
use backend\models\Setting;
use frontend\assets\BackendAsset;

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
<<<<<<< HEAD
                                            <h4 style="height: 5rem;"><a href="<?= Url::toRoute('/bai-viet/', true) ?>/<?= $listHost->slug ?>.html"><?= $listHost->title ?></a></h4>    
                                            <span class="color1"><?= $listHost->category->name ?></span>
=======
                                            <h4><a href="/bai-viet/<?= $listHost->slug ?>.html"><?= $listHost->title ?></a></h4>
>>>>>>> 2e0cad38de619d2d7dfc0334eaa1d48ac13d6450
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <!-- Riht content -->
                    <div class="col-lg-4">
<<<<<<< HEAD
                        <div class="blog_right_sidebar">

                            <aside class="single_sidebar_widget search_widget">
                                <?php $form = ActiveForm::begin([
                                                                    'action' => Url::toRoute('/tim-kiem', true),
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
                        
=======
                        <div class="trand-right-single d-flex">
                            <div class="trand-right-cap">
                                <span class="color1">Bài viết tính phí</span>
                            </div>
                        </div>
                        <?php foreach($charge as $chargeItem): ?>
                            
>>>>>>> 2e0cad38de619d2d7dfc0334eaa1d48ac13d6450
                            <div class="trand-right-single d-flex">
                                <div class="trand-right-cap  d-flex">
                                    <div class="trand-right-img">
                                        <img src="<?= $backend->baseUrl.'/'.$chargeItem->image ?>" alt="" width="100px">
                                    </div>
                                    <h4><a href="/bai-viet/<?= $chargeItem->slug ?>.html"><?= $chargeItem->title ?></a></h4>
                                </div>
                            </div>
<<<<<<< HEAD
                                <?php foreach($charge as $chargeItem): 
                                
                                    $check = PostBuy::find()->where(['post_id' => $chargeItem->id])->andWhere(['user_id' => Yii::$app->user->id])->one();
                                ?>
                                <?php if(Yii::$app->user->isGuest){ ?>
                                    <div class="trand-right-single">
                                        <div class="trand-right-cap  d-flex">
                                            <div class="trand-right-img">
                                                <img src="<?= $backend->baseUrl.'/'.$chargeItem->image ?>" alt="" width="100px">
                                            </div>
                                            <h4><?= $chargeItem->title ?></h4>
                                        </div>
                                        <div class="text-end">

                                            <span class="color1"><?= $chargeItem->category->name ?></span>
                                            <p class = text-danger><?=$chargeItem->coin?> xu</p>                
                                           
                                                <a href="<?= Url::toRoute('/dang-nhap/', true) ?>" id="" class="btn btn-primary" role="button">Mua ngay</a>
                                            </div>
                                        </div>
                                <?php } else{ if(!$check){  ?>
                                        
                                    <div class="trand-right-single">
                                        <div class="trand-right-cap  d-flex">
                                            <div class="trand-right-img">
                                                <img src="<?= $backend->baseUrl.'/'.$chargeItem->image ?>" alt="" width="100px">
                                            </div>
                                            <h4><?= $chargeItem->title ?></h4>
                                        </div>
                                        <div class="text-end">

                                            <span class="color1"><?= $chargeItem->category->name ?></span>
                                            <p class = text-danger><?=$chargeItem->coin?> xu</p>                
                                                <button type="button" class="btn btn-primary select" data-id= "<?= $chargeItem->id ?>" data-toggle="modal" data-target="#myModal">Mua ngay</button>

                                        </div>
                                    </div>
                                <?php }} ?>
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
=======
                        <?php endforeach ?>


                        <!-- <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="assets/img/trending/right2.jpg" alt="">
>>>>>>> 2e0cad38de619d2d7dfc0334eaa1d48ac13d6450
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

                    </div>
                </div>
            </div>
        </div>
    </div>