<?php

namespace frontend\controllers;

use frontend\models\Post;

class PostController extends \yii\web\Controller
{
    public function actionSlug($slug)
    {
        $model = Post::find()->where(['slug' => $slug])->one();
        return $this->render('index',[
            'model' => $model
        ]);
    }

}
