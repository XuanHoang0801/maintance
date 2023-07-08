<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use kartik\date\DatePicker;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'fullname') ?>
                <?= '<label class="form-label">Birthday</label>'; ?>
                <?= 
                    DatePicker::widget([
                        'name' => 'birthday',
                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                        'value' => '1990/01/01',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy/mm/dd'
                        ]
                    ]);
                ?>
                <?= $form->field($model, 'gender')->radioList( ['Nam'=>'Nam', 'Nữ' => 'Nữ']); ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
