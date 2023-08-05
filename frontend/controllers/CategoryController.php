<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\Post;

class CategoryController extends \yii\web\Controller
{
    public function actionSlug($slug)
    {
        $cat = Category::find()->where(['slug' => $slug])->one();
        $model = Post::find()->where(['category_id' => $cat->id])->andWhere(['is_show' => 1,'is_free' => 0])->all();
        $free = Post::find()->where(['category_id' => $cat->id])->andWhere(['is_show' => 1,'is_free' => 1])->all();
        return $this->render('index',[
            'cat'=> $cat,
            'model' => $model,
            'free' => $free
        ]);
    }

}
