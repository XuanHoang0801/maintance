<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Menu $model */

$this->title = Yii::t('app', 'Tạo menu mới');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'create';
?>
<div class="menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
