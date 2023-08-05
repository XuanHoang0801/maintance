<?php

use app\models\Post;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Category;
use yii\grid\ActionColumn;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var backend\models\PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Quản lý bài viết');
$this->params['breadcrumbs'][] = 'bai-viet';
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Tạo bài viết mới'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=> 'image',
                'format' => ['image',['width'=>'50']], 
                'options' => ['style' => 'width:10%'],

                'value' => function($searchModel){
                    return  Url::toRoute('/uploads/'.$searchModel->image);
                },
            ],

            'title',
            // 'slug',
            // 'short',
            // 'detail',
            // 'category_id',
            [
                'attribute' => 'category_id',
                'value' => 'category.name',
                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'category_id',
                        'data' => ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => 'Tất cả'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]),
            ],
            // 'author_id',
            [
                'attribute' => 'author_id',
                'value' => 'author.username',
                'options' => ['style' => 'width:10%'],

            ],
            // 'is_show:boolean',
            [
                'attribute' => 'is_show',
                'format' => 'boolean',
                'options' => ['style' => 'width:10%'],

                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'is_show',
                        'data' => Yii::$app->params['boolean'],
                        'options' => ['placeholder' => 'Tất cả'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]),
            ],
            // 'is_free:boolean',
            [
                'attribute' => 'is_free',
                'format' => 'boolean',
                'options' => ['style' => 'width:10%'],

                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'is_free',
                        'data' => Yii::$app->params['boolean'],
                        'options' => ['placeholder' => 'Tất cả'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]),
            ],
            //'coin',
            //'image',
            
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'template' => ' {update} {delete}',
                'urlCreator' => function ($action, Post $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
