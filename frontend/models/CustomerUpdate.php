<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $username
 * @property string $fullname
 * @property string $birthday
 * @property string|null $gender
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property string|null $avt
 * @property int|null $coin
 * @property bool|null $type
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 *
 * @property PostBuy[] $postBuys
 */
class CustomerUpdate extends \yii\db\ActiveRecord
{
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
            [['username', 'fullname', 'birthday','email'], 'required'],
            [['username', 'fullname', 'birthday', 'gender', 'email', 'avt'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Tên đăng nhập',
            'fullname' => 'Họ và tên',
            'birthday' => 'Ngày sinh',
            'gender' => 'Giới tính',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'avt' => 'Avt',
            'coin' => 'Coin',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
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
}
