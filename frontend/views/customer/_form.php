<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/** @var yii\web\View $this */
/** @var frontend\models\Customer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

   <?=
        $form->field($model, 'birthday')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter event time ...'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy'
            ]
        ]);
?>
    <?= $form->field($model, 'gender')->radioList(Yii::$app->params['customer.gender']) ?> 

   <?php 
        echo $form->field($model, 'avt')->widget(FileInput::classname(), [
            'options' => ['multiple' => true],
            'pluginOptions' => ['previewFileType' => 'any']
        ]);
?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Cập nhật thông tin'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
