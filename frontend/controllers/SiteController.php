<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Post;
use frontend\models\User;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use frontend\models\Customer;
use yii\filters\AccessControl;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\CustomerSignup;
use frontend\models\VerifyEmailForm;
use yii\web\BadRequestHttpException;
use frontend\models\ResetPasswordForm;
use yii\base\InvalidArgumentException;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $hot = Post::find()->where(['is_free' => 1])->andWhere(['is_hot' => 1])->andWhere(['is_show'=>1])->orderBy(['id' => SORT_DESC])->all();
        $charge = Post::find()->where(['is_free' => 0])->andWhere(['is_show'=>1])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('index',[
            'hot' =>$hot,
            'charge' => $charge
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new CustomerSignup();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }


    public function actionChangePassword()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/login');
        }
        $model = Customer::find()->where(['id' => Yii::$app->user->id ])->one();
        $pass = $model->password_hash;
        if ($model->load(Yii::$app->request->post())) {
            $oldPass = trim(Yii::$app->request->post()[$model->formName()]['password_old']);
            if (password_verify($oldPass, $pass)) {
                $newPass = trim(Yii::$app->request->post()[$model->formName()]['password_new']);
                if ($oldPass != $newPass) {
                    $rePass = trim(Yii::$app->request->post()[$model->formName()]['re_password']);
                    if($rePass == $newPass){
                        $model->password_hash = Yii::$app->security->generatePasswordHash($newPass);
                        if ($model->save()) {
                            \Yii::$app->user->logout();
                            return $this->goHome();
                        }
                    }
                    else{
                    $model->addError('re_password', 'Mật khẩu không trùng khớp!');
                    }                   

                } else {
                    $model->addError('password_hash', 'Mật khẩu mới không được trùng với mật khẩu cũ!');
                }
            } else {
                $model->addError('password_old', 'Mật khẩu cũ không đúng!');
            }
        }
        
        return $this->render('change',[
            'model'=>$model
        ]);
    }
    public function actionInfo()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('/login');
        }
        $model = Customer::find()->where(['id' => Yii::$app->user->id ])->one();

        return $this->render('info',[
            'model'=>$model
        ]);
    }

    public function actionSearch($key){
        $model = Post::find()
                ->where(['is_show' => 1])
                ->andFilterWhere(['like', 'title', $key])
                ->orderBy(['id' => SORT_DESC])->all();
        if(!$model){
            Yii::$app->session->setFlash('error', "Không có bài viết nào phù hợp với từ khóa tìm kiếm!");
        }
        return $this->render('search', [
            'model' => $model,
            'key' =>$key
        ]);
    }


    
}
