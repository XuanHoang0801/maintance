<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
$this->registerCssFile(Yii::getAlias('@web') . '/css/login.css');
$this->title = 'Đăng nhập Admin';
?>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
                  <i class="ri-account-circle-line text-white"></i>
		      	</div>
                    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Tên đăng nhập') ?>

                        <?= $form->field($model, 'password')->passwordInput()->label('Mật khẩu') ?>

                        <?= $form->field($model, 'rememberMe')->checkbox()->label('Lưu đăng nhập') ?>

                        <div class="form-group">
                            <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
    </section>