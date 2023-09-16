<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property string|null $avt
 * @property string|null $coin
 * @property bool|null $type
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 *
 * @property PostBuy[] $postBuys
 * @property Post[] $posts
 */
class Customer extends \yii\db\ActiveRecord
{
    public $password_old;
    public $re_password;
    public $password_new;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at','password_old','re_password','password_new'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['type'], 'boolean'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'avt', 'coin', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'avt' => Yii::t('app', 'Avt'),
            'coin' => Yii::t('app', 'Coin'),
            'type' => Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'verification_token' => Yii::t('app', 'Verification Token'),
            'password_old' => Yii::t('app', 'Mật khẩu cũ'),
            'password_new' => Yii::t('app', 'Mật khẩu mới '),
            're_password' => Yii::t('app', 'Xác thực mật khẩu'),
        ];
    }

    /**
     * Gets query for [[PostBuys]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostBuys()
    {
        return $this->hasMany(PostBuy::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::class, ['author_id' => 'id']);
    }
}
