<?php

use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Post $model */

$this->title = Yii::t('app', 'Nạp xu');
$this->params['breadcrumbs'][] = 'nap-xu';
?>
<div class="header">
    <h4>Số xu hiện có: <span class= "text-success"><?= $model->coin?> xu</span></h4>
</div>
<div class="card-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($customer, 'coin')->textInput(['type' => 'number','min'=> 1]) ?>

        <?= $form->field($customer, 'captcha')->widget(Captcha::className(),
                                        ['template' => '<div class="captcha_img">{image}</div>'
                                        . '<a class="refreshcaptcha" href="#">'
                                        . Html::img('/images/imageName.png',[]).'</a>'
                                        . 'Captcha Code{input}',
                                    ])->label(FALSE); ?> 

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Nạp xu'), ['class' => 'btn btn-success mt-3']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>