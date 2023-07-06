<?php

use frontend\models\Category;
use yii\helpers\Html;
use yii\helpers\Url; 

?>
<header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-none d-md-block">
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
                                                <a class="dropdown-item" href="thong-tin">Thông tin</a>
                                                <a class="dropdown-item" href="/change-password">Đổi mật khẩu</a>
                                                <a class="dropdown-item" href="/my-post">Bài viết của tôi</a>
                                                <a class="dropdown-item" href="#">Nạp xu</a>
                                                <a class="dropdown-item text-warning" href="#">Xu: <?= Yii::$app->user->identity->coin ?> xu </a>
                                                <?php
                                                        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                                                    . Html::submitButton( 'Đăng xuất',['class' => ' btn-link logout text-decoration-none'])
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
                <div class="header-mid d-none d-md-block">
                   <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo">
                                    <a href="/"><img src="/img/logo/logo.png" alt=""></a>
                                </div>
                            </div>
                            <!-- <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right ">
                                    <img src="assets/img/hero/header_card.jpg" alt="">
                                </div>
                            </div> -->
                        </div>
                   </div>
                </div>
               <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <!-- sticky -->
                                    <div class="sticky-logo">
                                        <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                                    </div>
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>                  
                                        <ul id="navigation">    
                                            <li><a href="/">Trang chủ</a></li>
                                            <?php foreach(Category::find()->where(['is_show' => 1])-> all() as $cat) : ?>
                                            <li><a href="/<?= $cat->slug ?>"><?= $cat->name?></a></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>             
                            <div class="col-xl-2 col-lg-2 col-md-4">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <i class="fas fa-search special-tag"></i>
                                    <div class="search-box">
                                        <form action="#">
                                            <input type="text" placeholder="Search">
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>