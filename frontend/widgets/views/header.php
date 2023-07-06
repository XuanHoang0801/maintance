<?php
use yii\helpers\Html;
use yii\helpers\Url; 
use backend\models\Setting;
use frontend\models\Category;
use frontend\assets\BackendAsset;
$backend = BackendAsset::register($this);
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
                                                <a class="dropdown-item" href="/lich-su-mua">Lịch sử mua</a>
                                                <a class="dropdown-item" href="/my-post">Bài viết của tôi</a>
                                                <a class="dropdown-item" href="/nap-xu">Nạp xu</a>
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
                   <div class="container d-flex justify-content-between">
                        <div class="logo  col-md-3">
                            <a href="/">
                                <img src="<?= $backend->baseUrl.'/'.Setting::logo()->content ?>" alt="" width="50%">
                                <p><?= Setting::title()->content ?></p>
                            </a>
                        </div>
                        <!-- Main-menu -->
                        <div class="main-menu d-none d-md-block d-flex">
                            <nav>                  
                                <ul id="navigation">    
                                    <li><a href="/">Trang chủ</a></li>
                                    <?php foreach(Category::find()->where(['is_show' => 1])-> all() as $cat) : ?>
                                    <li><a href="/<?= $cat->slug ?>"><?= $cat->name?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            </nav>
                        </div>
                                
                        <!-- <div class=" main-menu d-none d-md-flex">
                            <input class="form-control" type="text" placeholder="Tìm kiếm..." aria-label="default input example">
                            <i class="fas fa-search special-tag"></i>
                        </div> -->
                    </div>
                </div>
            </div>
       </div>
        <!-- Header End -->
    </header>