<?php
namespace backend\widgets;
use yii\base\Widget;

class FooterWidget extends Widget{
    public function init()
    {
        return parent::run();
    }
    public function run()
    {
        return $this->render('footer');
    }
}