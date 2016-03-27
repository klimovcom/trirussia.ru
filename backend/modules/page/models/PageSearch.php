<?php

namespace page\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use page\models\Page;

/**
 * PageSearch represents the model behind the search form about `page\models\Page`.
 */
class PageSearch extends Page
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->created = '';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'published'], 'integer'],
            [['created', 'label', 'content', 'url'], 'safe'],
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
        $query = Page::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'url', $this->url]);

        $query->orderBy('id DESC');

        return $dataProvider;
    }
}
