<?php
/** @var yii\web\View $this */

use yii\helpers\BaseUrl;
use yii\widgets\ActiveForm;
use frontend\assets\BackendAsset;

$this->title = $model->title;
$backend = BackendAsset::register($this);
?>
<!--================Blog Area =================-->
<section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img text-center">
                     <img class="img-fluid" src="<?= $backend->baseUrl.'/'.$model->image  ?>" alt="">
                  </div>
                  <div class="blog_details">
                     <h2><?= $model->title ?>
                     </h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="#"><i class="fa fa-user"></i> <?= $model->author->username ?></a></li>
                        <li><a href="#"><i class="fa fa-comments"></i> </a></li>
                     </ul>
                     <?= $model->detail ?>
                  </div>
               </div>
              
            </div>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">
                  <aside class="single_sidebar_widget search_widget">
                  <?php $form = ActiveForm::begin([
                                                                    'action' => '/tim-kiem',
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
                  <aside class="single_sidebar_widget post_category_widget">
                     <h4 class="widget_title">Thể loại</h4>
                     <ul class="list cat-list">
                        <?php foreach($category as $cat): ?>
                           <li>
                              <a href="/<?= $cat->slug ?>" class="d-flex">
                                 <p><?= $cat->name ?></p>
                              </a>
                           </li>
                       <?php endforeach ?>
                     </ul>
                  </aside>
                  <aside class="single_sidebar_widget popular_post_widget">
                     <h3 class="widget_title">Bài viết liên quan</h3>
                     <?php foreach ($relate as $re): ?>
                        <div class="media post_item">
                           <img src="<?= $backend->baseUrl.'/'.$re->image ?>" alt="post" width="100rem">
                           <div class="media-body">
                              <a href="/bai-viet/<?=$re->slug?>.html">
                                 <h3><?= $re->title ?></h3>
                              </a>
                           </div>
                        </div>
                    <?php endforeach ?>
                  </aside>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->
