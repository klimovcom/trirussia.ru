<?php

namespace post\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use post\models\Post;

/**
 * PostSearch represents the model behind the search form about `post\models\Post`.
 */
class PostSearch extends Post
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->created = '';
        $this->author_id = '';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'image_id', 'published'], 'integer'],
            [['created', 'label', 'url', 'promo', 'content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder'=> ['id' => SORT_DESC],
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created' => $this->created,
            'author_id' => $this->author_id,
            'image_id' => $this->image_id,
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'promo', $this->promo])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
