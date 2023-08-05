<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Setting $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?=
         $form->field($model, 'content')->widget(FileInput::classname(), [
            'options' => ['multiple' => false,'accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>[
                    Html::img( Url::toRoute('/uploads').'/' . $model->content,['width' => '70%'])
                ],
                'overwriteInitial'=>false,
                'browseClass' => 'btn btn-success',
                'showUpload' => false,
                'removeClass' => 'btn btn-danger',
            ]
        ]);
    ?>

   
    <div class="form-group mt-3">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
