<?php

use frontend\assets\BackendAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/** @var yii\web\View $this */
/** @var frontend\models\Customer $model */
/** @var yii\widgets\ActiveForm $form */
$backend = BackendAsset::register($this);

?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

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

   <?=
         $form->field($model, 'avt')->widget(FileInput::classname(), [
            'options' => ['multiple' => false,'accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>[
                    Html::img( $backend->baseUrl."/" . $model->avt,['width' => '70%'])
                ],
                'overwriteInitial'=>false,
                'browseClass' => 'btn btn-success',
                'showUpload' => false,
                'removeClass' => 'btn btn-danger',
            ]
        ]);
    ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Cập nhật thông tin'), ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
