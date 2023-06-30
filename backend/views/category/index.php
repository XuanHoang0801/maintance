<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Category;
use yii\grid\ActionColumn;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var backend\models\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Thể loại');
$this->params['breadcrumbs'][] = 'the-loai';
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Tạo thể loại mới'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            'slug',
            // 'category_id',
            [
                'attribute' => 'category_id',
                'value' => 'category.name',
                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'category_id',
                        'data' => ArrayHelper::map(Category::find()->where(['is_parent' => 1])->all(), 'id', 'name'),
                        'options' => ['placeholder' => 'Tất cả'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]),
            ],
            [
                'attribute' => 'is_parent',
                'format'=> 'boolean',
                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'is_parent',
                        'data' => Yii::$app->params['boolean'],
                        'options' => ['placeholder' => 'Tất cả'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]),
            ],
            [
                'attribute' => 'is_show',
                'format'=> 'boolean',
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
            // 'is_show:boolean',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Category $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
