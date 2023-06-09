<?php

namespace frontend\controllers;

use common\models\Customer;
use frontend\models\Category;
use Yii;
use frontend\models\Post;
use frontend\models\PostBuy;

class PostController extends \yii\web\Controller
{
    public function actionSlug($slug)
    {
        $model = Post::find()->where(['slug' => $slug])->one();
        $category = Category::find()->where(['is_show' => 1])->all();
        $relate =  Post::find()->where(['!=','id', $model->id])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('index',[
            'model' => $model,
            'category' => $category,
            'relate' => $relate
        ]);
    }
    
    public function actionBuy(){
        $model = new PostBuy();
        $user = Customer::find()->where(['id' => Yii::$app->user->id])->one();
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $post = Post::find()->where(['id' => $id])->one();
            $author = Customer::find()->where(['id' => $post->author_id])->one();
            
            if($user->coin > 0){
                
                $model->post_id = $id;
                $model->user_id = Yii::$app->user->id;
                $model->save();

                $user->coin = $user->coin - $post->coin;
                $user->save();
                $author->coin = $author->coin + $post->coin;
                $author->save();
    
                return $this->redirect("/bai-viet/$post->slug.html");
            }
            else{
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                return [
                    'message' => 'Số xu không đủ, vui lòng nạp thêm!',
                ];
            }

        }
    }
        

}
