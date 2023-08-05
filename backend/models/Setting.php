<?php

namespace backend\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "setting".
 *
 * @property string $key
 * @property string|null $content
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting';
    }

    public function behaviors()
    {
        return [
           
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['key'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'content' => Yii::t('app', 'Content'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function title()
    {
        return self::find()->where(['key' => 'KEY_SITE_TITLE'])->one();
    }
    public static function trending()
    {
        return self::find()->where(['key' => 'KEY_TRENDING'])->one();
    }
    public static function widgetOne()
    {
        return self::find()->where(['key' => 'KEY_WIDGET_TITLE_ONE'])->one();
    }
    public static function widgetTwo()
    {
        return self::find()->where(['key' => 'KEY_WIDGET_TITLE_TWO'])->one();
    }
    public static function widgetThree()
    {
        return self::find()->where(['key' => 'KEY_WIDGET_TITLE_THREE'])->one();
    }
    public static function copyRight()
    {
        return self::find()->where(['key' => 'KEY_COPY_RIGHT'])->one();
    }
}
