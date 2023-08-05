<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Customer $model */

$this->title = Yii::t('app', 'Cập nhật thông tin tài khoản: {name}', [
    'name' => $model->username,
]);
?>
<div class="customer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
