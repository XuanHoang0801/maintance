<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Post;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use frontend\models\PostSearch;
use yii\web\NotFoundHttpException;

/**
 * MyPostController implements the CRUD actions for Post model.
 */
class MyPostController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
        return $this->redirect('/bai-viet/'.$model->slug.'.html');
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
               if ($model->load($this->request->post())) {
                $model->author_id = Yii::$app->user->id;
                $model->save();
                $model->image = UploadedFile::getInstance($model, 'image');
                $fileName = $model->slug . '.' . $model->image->extension;
                $model->image->saveAs('@backend/web/uploads/' .$fileName ); // lưu ảnh vào thư mục uploads
                
                $model->image = $fileName; // lưu vào database
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image = $model->image;

        if ($this->request->isPost && $model->load($this->request->post())) {
            if($model->image){
                $model->image = UploadedFile::getInstance($model, 'image');
                $fileName = $model->slug . '.' . $model->image->extension;
                $model->image->saveAs('@backend/web/uploads/' .$fileName ); // lưu ảnh vào thư mục uploads
                $model->image = $fileName; // lưu vào database
            }
            else{
                $model->image = $image;
            }
                $model->author_id = Yii::$app->user->id;
                $model->save();
    
                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
