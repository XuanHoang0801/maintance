<?php

namespace app\models;

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
 */
class Customer extends \yii\db\ActiveRecord
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
            [['username', 'fullname', 'birthday', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'coin', 'created_at', 'updated_at'], 'integer'],
            [['type'], 'boolean'],
            [['username', 'fullname', 'birthday', 'gender', 'password_hash', 'password_reset_token', 'email', 'avt', 'verification_token'], 'string', 'max' => 255],
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
            'id' => 'ID',
            'username' => 'Username',
            'fullname' => 'Fullname',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
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
}
