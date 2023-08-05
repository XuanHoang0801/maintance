<?php

namespace frontend\controllers;

use common\models\Customer;
use frontend\models\Category;
use Yii;
use frontend\models\Post;
use frontend\models\PostBuy;
use PhpParser\Node\Stmt\Else_;

class PostController extends \yii\web\Controller
{
    public function actionSlug($slug)
    {
        $model = Post::find()->where(['slug' => $slug])->one();
        $category = Category::find()->where(['is_show' => 1])->all();
<<<<<<< HEAD
        $relate =  Post::find()->where(['!=','id', $model->id])->andWhere(['category_id' => $model->category_id])->andWhere(['is_show' => 1])->orderBy(['id' => SORT_DESC])->all();
        $check = PostBuy::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['post_id' => $model->id])->one();
        $checkAuthor = Post::find()->where(['author_id' => Yii::$app->user->id])->one();
        $checkFree = Post::find()->where(['is_free' => 1])->andWhere(['id' => $model->id,'is_show' => 1])->one();
        if($check || $checkAuthor || $checkFree){
            return $this->render('index',[
                'model' => $model,
                'category' => $category,
                'relate' => $relate
            ]);
        }
        else{
            return $this->redirect('/');
        }
=======
        $relate =  Post::find()->where(['!=','id', $model->id])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('index',[
            'model' => $model,
            'category' => $category,
            'relate' => $relate
        ]);
>>>>>>> 2e0cad38de619d2d7dfc0334eaa1d48ac13d6450
    }
    
    public function actionBuy(){
        $model = new PostBuy();
        $user = Customer::find()->where(['id' => Yii::$app->user->id])->one();
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $post = Post::find()->where(['id' => $id])->one();
            $author = Customer::find()->where(['id' => $post->author_id])->one();
            
            if($user->coin > 0){
                $check = PostBuy::find()->where(['user_id' => Yii::$app->user->id])->andWhere(['post_id' => $id])->one();
                if($check){
                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                    return [
                        'message' => 'Bạn đã mua bài viết này rồi!',
                    ];
                }
                else{
                    $model->post_id = $id;
                    $model->user_id = Yii::$app->user->id;
                    $model->save(false);
    
                    $user->coin = $user->coin - $post->coin;
                    $user->save();
                    $author->coin = $author->coin + $post->coin;
                    $author->save();
        
                    return $this->redirect("/bai-viet/$post->slug.html");
                }
                
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
