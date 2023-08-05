<?php

/** @var \yii\web\View $this */
/** @var string $content */

use yii\helpers\Url;
use yii\bootstrap5\Nav;
use yii\bootstrap5\Html;
use common\widgets\Alert;
use yii\bootstrap5\NavBar;
use backend\models\Setting;
use backend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use backend\widgets\FooterWidget;
use backend\widgets\HeaderWidget;
use backend\widgets\SidebarWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Url::toRoute('/uploads/'.Setting::Logo()->content)]); ?>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>


<?= HeaderWidget::widget() ?>
<?= SidebarWidget::widget() ?>
<main id="main" class="main">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<?= FooterWidget::widget() ?>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
