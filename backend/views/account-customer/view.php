<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Customer $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">

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
            // 'id',
            'username',
            'fullname',
            'birthday',
            'gender',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            'status',
            [
                'attribute'=> 'avt',
                'format' => ['image',['width'=>'50']], 
                'options' => ['style' => 'width:10%'],

                'value' => function($searchModel){
                    // $backend = BackendAsset::register($this);

                    return  Url::toRoute('/uploads/'.$searchModel->avt);

                },
            ],
            'coin',
            // 'type:boolean',
            // 'created_at',
            // 'updated_at',
            // 'verification_token',
        ],
    ]) ?>

</div>
