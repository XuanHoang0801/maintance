<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Post;
use Yii;

/**
 * PostSearch represents the model behind the search form of `frontend\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'author_id', 'coin'], 'integer'],
            [['title', 'slug', 'short', 'detail', 'image', 'created_at', 'updated_at'], 'safe'],
            [['is_show', 'is_free'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find()->where(['author_id' => Yii::$app->user->id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3,
                'forcePageParam' => true, 
                'pageSizeParam' => false,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'author_id' => $this->author_id,
            'is_show' => $this->is_show,
            'is_free' => $this->is_free,
            'coin' => $this->coin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'short', $this->short])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
