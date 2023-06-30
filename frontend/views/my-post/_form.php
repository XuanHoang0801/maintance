<?php

use frontend\models\Category;
use yii\helpers\Html;
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

    <?= $form->field($model, 'image')->fileInput(['class' => 'form-control']) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
