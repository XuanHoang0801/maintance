<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Customer;

/**
 * Signup form
 */
class CustomerSignup extends Model
{
    public $username;
    public $email;
    public $password;
    public $fullname;
    public $birthday;
    public $gender;
    // public $avt;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username','password','fullname','birthday','gender'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Customer', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Customer   ', 'message' => 'This email address has already been taken.'],

            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        // if (!$this->validate()) {
        //     return null;
        // }
        
        $user = new Customer();
        $user->username = $this->username;
        $user->fullname = $this->fullname;
        $user->birthday = $this->birthday;
        $user->gender = $this->gender;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        return $user->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
