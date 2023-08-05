<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use frontend\assets\BackendAsset;
use yii\bootstrap5\Html;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\bootstrap5\ActiveForm;
$backend = BackendAsset::register($this);

$this->title = 'Đăng ký tài khoản';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Vui lòng điền vào các trường sau để đăng ký:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'fullname') ?>
                <?= $form->field($model, 'birthday')->widget(DatePicker::className(),[
                        'name' => 'birthday',
                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                        'value' => '1990/01/01',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy/mm/dd'
                        ]
                    ]); ?>
                
                <?= $form->field($model, 'gender')->radioList( ['Nam'=>'Nam', 'Nữ' => 'Nữ']); ?>

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
                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Đăng ký', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
