<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use frontend\models\Post;
use yii\bootstrap5\Modal;
use yii\grid\ActionColumn;
use yii\bootstrap5\LinkPager;
use frontend\assets\BackendAsset;

/** @var yii\web\View $this */
/** @var frontend\models\PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Bài viết của tôi');
$this->params['breadcrumbs'][] = 'my-post';
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(Yii::t('app', 'Tạo bài viết mới'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php //echo Html::button(Yii::t('app', 'Tạo bài viết mới'), ['value'=> Url::to('/my-post/create'),'class' => 'btn btn-success']) ?>
    </p>

    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title',
            // 'slug',
            // 'short:ntext',
            // 'detail:ntext',
            'category_id',
            //'author_id',
            'is_show:boolean',
            'is_free:boolean',
            'coin',
            // 'image',
            [
                'attribute'=> 'image',
                'format' => ['image',['width'=>'50']], 

                'value' => function($searchModel){
                    $backend = BackendAsset::register($this);

                    return  Url::toRoute($backend->baseUrl.'/'.$searchModel->image);

                },
            ],
            'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'template' => ' {view}{update} {delete}',
                'urlCreator' => function ($action, Post $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
        'pager' => [

            'class' => LinkPager::class,
            
        ],
    ]); ?>
    <?php Pjax::end() ?>


</div>
