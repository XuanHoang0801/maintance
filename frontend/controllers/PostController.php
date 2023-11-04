<?php

namespace frontend\controllers;

use Yii;
use common\widgets\Alert;
use frontend\models\Like;
use frontend\models\Post;
use common\models\Customer;
use frontend\models\Comment;
use frontend\models\PostBuy;
use frontend\models\Category;
use PhpParser\Node\Stmt\Else_;

class PostController extends \yii\web\Controller
{
    public function actionSlug($slug)
    {
        $model = Post::find()->where(['slug' => $slug])->one();
        $category = Category::find()->where(['is_show' => 1])->all();
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

    public function actionLike(){
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $user = Yii::$app->user->id;

            $model = new Like();
            $model->post_id = $id;
            $model->user_id = $user;
            $model->save();

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $count = Like::find()->where(['post_id' => $id])->all();
            return [
                'count' => count($count)
            ];
        }
    }
    public function actionUnLike(){
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $user = Yii::$app->user->id;
            $model = Like::findOne(['post_id' => $id,'user_id' => $user])->delete();
            $count = Like::find()->where(['post_id' =>$id])->all();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'count' => count($count)
            ];
        }
    }
    
    public function actionComment(){
        if(Yii::$app->request->isPost){
            $post_id = Yii::$app->request->post('post_id');
            $content = Yii::$app->request->post('content');
            $comment = new Comment();
            $comment->post_id = $post_id;
            $comment->user_id = Yii::$app->user->id;
            $comment->content = $content;
            $comment->created = date('Y-m-d H:i:s');
            $comment->save();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return[
                'success' => 200,
                'user' => $comment->customer->fullname,
                'avt' => Yii::getAlias('@backend/web/uploads/'.$comment->customer->avt),
                'time' => $comment->created,
                'content' => $comment->content
            ];
        }
    }

}
