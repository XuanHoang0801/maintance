<?php

namespace frontend\controllers;

use Yii;
use frontend\assets\BackendAsset;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use frontend\models\Customer;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use frontend\models\CustomerUpdate;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     *
     * @return string
     */
    /**
     * Displays a single Customer model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionInfo()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/login');
        }
        $model = CustomerUpdate::find()->where(['id' => Yii::$app->user->id ])->one();
        return $this->render('view',[
            'model'=>$model
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        // $backend = BackendAsset::register($this);
        $model = CustomerUpdate::find()->where(['id' => Yii::$app->user->id ])->one();
        $avt = $model->avt;
        if ($this->request->isPost ) {
            if($model->load($this->request->post())){
                $model->avt = UploadedFile::getInstance($model, 'avt'); 
                $fileName = $model->username . '.' . $model->avt->extension;

                if($model->avt != null){
                    $fileName = $model->username.'-'.date('Ymdhis') . '.' . $model->avt->extension;
                    $model->avt->saveAs(Yii::getAlias('@backend/web/uploads/').$fileName ); // lưu ảnh vào thư mục uploads
                    $model->avt = $fileName; // lưu vào database
                    if($avt != 'user.png'){
                        unlink(Yii::getAlias('@backend/web/uploads/').$avt);
                    }
                }
                else{
                    $model->avt = $avt;
                }
                $model->save();   
                
                
                return $this->redirect(['info']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Customer model.
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
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerUpdate::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
