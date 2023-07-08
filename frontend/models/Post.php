<?php

namespace frontend\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string|null $slug
 * @property string|null $short
 * @property string|null $detail
 * @property int|null $category_id
 * @property int|null $author_id
 * @property bool|null $is_hot
 * @property bool|null $is_show
 * @property bool|null $is_free
 * @property int|null $coin
 * @property string|null $image
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $author
 * @property Category $category
 * @property PostBuy[] $postBuys
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                // 'slugAttribute' => 'slug',
            ],

            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
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
            [['title'], 'required'],
            [['short', 'detail'], 'string'],
            [['category_id', 'author_id', 'coin'], 'integer'],
            [['is_show', 'is_free','is_hot'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug', 'image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Tiêu đề'),
            'slug' => Yii::t('app', 'Slug'),
            'short' => Yii::t('app', 'Tóm tắt'),
            'detail' => Yii::t('app', 'Chi tiết'),
            'category_id' => Yii::t('app', 'Chuyên mục'),
            'author_id' => Yii::t('app', 'Author ID'),
            'is_hot' => Yii::t('app', 'Nổi bật'),
            'is_show' => Yii::t('app', 'Xuất bản'),
            'is_free' => Yii::t('app', 'Miễn phí'),
            'coin' => Yii::t('app', 'Xu'),
            'image' => Yii::t('app', 'Hình ảnh'),
            'created_at' => Yii::t('app', 'Ngày tạo'),
            'updated_at' => Yii::t('app', 'Ngày cập nhật'),
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[PostBuys]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostBuys()
    {
        return $this->hasMany(PostBuy::class, ['post_id' => 'id']);
    }
}
