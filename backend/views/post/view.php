<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Post $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'bai-viet'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'slug',
            'short',
            'detail',
            'category_id',
            'author_id',
            'is_show:boolean',
            'is_free:boolean',
            'coin',
            [
                'attribute'=> 'image',
                'format' => ['image',['width'=>'50']], 
                'options' => ['style' => 'width:10%'],

                'value' => function($model){
                    // $backend = BackendAsset::register($this);

                    return  Url::toRoute('/uploads/'.$model->image);

                },
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
