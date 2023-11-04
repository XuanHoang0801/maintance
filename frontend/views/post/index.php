<?php
/** @var yii\web\View $this */

use yii\helpers\Url;
use yii\helpers\BaseUrl;
use frontend\models\Like;
use yii\widgets\ActiveForm;
use frontend\assets\BackendAsset;
use frontend\models\Comment;

$this->title = $model->title;
$this->registerJsFile('@web/js/like.js', ['depends' =>  [yii\web\YiiAsset::className()], ]);

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
                     <input type="hidden" name="" id= "id" value="<?= $model->id ?>">
                     <h2><?= $model->title ?>
                     </h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="#"><i class="fa fa-user"></i> <?= $model->author->username ?></a></li>
                        <?php
                              $count = Like::find()->where(['post_id' => $model->id])->all();
                           if(!Yii::$app->user->isGuest){

                           $checkLike = Like::find()->where(['post_id' => $model->id])->andWhere(['user_id' => Yii::$app->user->id])->one();
                           if($checkLike){
                        ?>
                           <li class = "text-primary like" id="unlike"><i class="fas fa-thumbs-down "></i>  Bỏ thích</li>
                        <?php
                           }else{
                        ?>
                           <li class = "text-primary like" id="like"><i class="fas fa-thumbs-up "></i>  Thích</li>
                        <?php } } ?>
                        <li class = "text-primary"><i class="fas fa-thumbs-up  "></i>  <span class="count-like"> <?= count($count) ?></span> </li>
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
            
            <div class="form-comment <?php if(Yii::$app->user->isGuest) echo 'hide' ?>">
               <div class="mb-3 mt-3">
                  <label for="formGroupExampleInput" class="form-label">Viết bình luận <span class="ti-pencil"></span></label>
                  <textarea class="form-control" id="content" rows="3" placeholder="Nội dung..."></textarea>
                  <div class="mt-3">
                     <button type="button" class="btn btn-primary" id="comment">Bình luận</button>
                  </div>
               </div>
            </div>

            <div class="list-comment mt-3">
            <?php
               $comment = Comment::find()->where(['post_id' => $model->id])->all();
               if($comment){
                  foreach($comment as $listComment){
            ?>
               <div class="comment-item d-flex">
                  <div class="comment-avatar">
                     <img class="avatar" src="<?= $backend->baseUrl.'/'.$listComment->customer->avt  ?>" alt="">
                  </div>
                  <div class="comment-content ">
                     <div class="comment-top d-flex">
                        <div class="comment-author"><strong><?= $listComment->customer->fullname ?></strong></div>
                        <div class="comment-time fw-light ml-3"><?= $listComment->created ?></div>
                     </div>
                     <div class="comment-text"><?= $listComment->content ?></div>
                  </div>
               </div>
            <?php }} ?>
            </div>
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->
