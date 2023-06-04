<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Setting $model */

$this->title = Yii::t('app', 'Update Setting: {name}', [
    'name' => $model->key,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'setting'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'update');
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
?>
<div class="setting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
