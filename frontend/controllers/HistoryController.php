<?php

namespace frontend\controllers;

use frontend\models\PostBuy;
use Yii;

class HistoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/login');
        }
        $model = PostBuy::find()->where(['user_id' => Yii::$app->user->id])->orderBy(['id' => SORT_DESC])->all();
        if($model){
            return $this->render('index',[
                'model' => $model
            ]);
        }
        else{
            Yii::$app->session->setFlash('warning', "Bạn chưa mua bài viết nào!");

            return $this->render('index',[
                'model' => $model
            ]);
        }

    }

}
