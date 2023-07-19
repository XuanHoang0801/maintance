<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Category;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;

/** @var yii\web\View $this */
/** @var app\models\Post $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'short')->widget(CKEditor::className(), [
		'options' => ['rows' => 6],
		'preset' => 'advanced'
	]) ?>

    <?= $form->field($model, 'detail')->widget(CKEditor::className(), [
		'options' => ['rows' => 6],
		'preset' => 'advanced'
	]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(Category::find()->all(), 'id', 'name'),[
            'class'=> 'form-select'
        ])   
    ?>

    <?= $form->field($model, 'is_show')->checkbox() ?>

    <?= $form->field($model, 'is_free')->checkbox() ?>

    <?= $form->field($model, 'is_hot')->checkbox() ?>

    <?= $form->field($model, 'coin')->textInput() ?>

    <!-- <?= $form->field($model, 'image')->fileInput(['class' => 'form-control']) ?> -->

    <?=
         $form->field($model, 'image')->widget(FileInput::classname(), [
            'options' => ['multiple' => false,'accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>[
                    Html::img( Url::toRoute('/uploads').'/' . $model->image,['width' => '70%'])
                ],
                'overwriteInitial'=>false,
                'browseClass' => 'btn btn-success',
                'showUpload' => false,
                'removeClass' => 'btn btn-danger',
            ]
        ]);
    ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
