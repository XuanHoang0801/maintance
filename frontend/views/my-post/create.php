<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Post $model */

$this->title = Yii::t('app', 'Tạo bài viết mới');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'my-post'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'create';
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
