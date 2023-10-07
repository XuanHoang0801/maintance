<?php

use frontend\assets\BackendAsset;
use yii\helpers\Html;
use yii\helpers\Url; 
use backend\models\Setting;
use frontend\models\Category;

$backend = BackendAsset::register($this);


?>
<header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-md-block">
                   <div class="container">
                       <div class="col-xl-12">
                            <div class=" d-flex justify-content-end align-items-center">
                                <div class="header-info-right">
                                    <ul class="header-social">   
                                        <?php
                                              if (Yii::$app->user->isGuest) {
                                        ?> 
                                        <li><a href="<?= Url::toRoute('site/signup', true) ?>">Đăng ký</a></li>
                                        <li><a href="<?= Url::toRoute('site/login', true) ?>">Đăng nhập</a></li>
                                        <?php } else{  ?>
                                            <div class="dropdown">
                                            <div class=" text-white dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= Yii::$app->user->identity->username ?>
                                            </div>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="<?= Url::toRoute('/thong-tin', true) ?>">Thông tin</a>
                                                <a class="dropdown-item" href="<?= Url::toRoute('/doi-mat-khau', true) ?>">Đổi mật khẩu</a>
                                                <a class="dropdown-item" href="<?= Url::toRoute('/lich-su-mua', true) ?>">Lịch sử mua</a>
                                                <a class="dropdown-item" href="<?= Url::toRoute('/my-post', true) ?>">Bài viết của tôi</a>
                                                <a class="dropdown-item" href="<?= Url::toRoute('/nap-xu', true) ?>">Nạp xu</a>
                                                <a class="dropdown-item text-warning" href="#">Xu: <?= Yii::$app->user->identity->coin ?> xu </a>
                                                <?php
                                                        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                                                    .'<input class="dropdown-item text-primary" type="submit" value="Đăng xuất">'
                                                    . Html::endForm();
                                                ?>
                                            </div>
                                            </div>
                                            <?php
                                            
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
                <div class="header-mid  d-md-block">
                   <div class="header-body container d-flex justify-content-between">
                        <div class="logo  col-md-3">
                            <a href="<?= Url::toRoute('/', true) ?>">
                                <img src="<?= $backend->baseUrl.'/'.Setting::logo()->content ?>" alt="" width="50%">
                                <p><?= Setting::title()->content ?></p>
                            </a>
                        </div>
                        <!-- Main-menu -->
                        <div class="main-menu d-md-block d-flex">
                            <nav>                  
                                <ul id="navigation">    
                                    <li><a href="<?= Url::toRoute('/') ?>">Trang chủ</a></li>
                                    <?php foreach(Category::find()->where(['is_show' => 1])-> all() as $cat) : ?>
                                    <li><a href="<?= Url::toRoute('/'.$cat->slug) ?>"><?= $cat->name?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            </nav>

                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>