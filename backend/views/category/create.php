<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Category $model */

$this->title = Yii::t('app', 'Tạo thể loại mới');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'the-loai'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'create';
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
