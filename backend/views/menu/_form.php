<?php

use app\models\Menu;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Menu $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList( ArrayHelper::map(Menu::menuParent(), 'id', 'name'),['prompt'=>'--Select Option--'])    ?>

    <?= $form->field($model, 'is_parent')->checkbox() ?>

    <?= $form->field($model, 'is_show')->checkbox() ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?> 


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mt-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
