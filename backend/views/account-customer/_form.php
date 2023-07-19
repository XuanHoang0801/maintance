<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Customer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?=
         $form->field($model, 'avt')->widget(FileInput::classname(), [
            'options' => ['multiple' => false,'accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>[
                    Html::img( Url::toRoute('/uploads').'/' . $model->avt,['width' => '70%'])
                ],
                'overwriteInitial'=>false,
                'browseClass' => 'btn btn-success',
                'showUpload' => false,
                'removeClass' => 'btn btn-danger',
            ]
        ]);
    ?>

    <?= $form->field($model, 'coin')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
