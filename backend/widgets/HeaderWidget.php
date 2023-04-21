<?php
namespace backend\widgets;
use yii\base\Widget;

class HeaderWidget extends Widget{
    public function init()
    {
        return parent::run();
    }
    public function run()
    {
        return $this->render('header');
    }
}