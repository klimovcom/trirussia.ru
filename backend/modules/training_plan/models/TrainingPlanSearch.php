<?php

namespace training_plan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use training_plan\models\TrainingPlan;

/**
 * TrainingPlanSearch represents the model behind the search form about `training_plan\models\TrainingPlan`.
 */
class TrainingPlanSearch extends TrainingPlan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'level', 'author_id', 'format', 'price', 'sport_id', 'popularity', 'published'], 'integer'],
            [['label', 'url', 'count', 'amount', 'progress', 'author_name', 'duration', 'content', 'promo', 'author_site'], 'safe'],
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

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->author_id = null;
        $this->popularity = null;
        $this->published = null;
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
        $query = TrainingPlan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'level' => $this->level,
            'author_id' => $this->author_id,
            'format' => $this->format,
            'price' => $this->price,
            'sport_id' => $this->sport_id,
            'popularity' => $this->popularity,
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'count', $this->count])
            ->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'progress', $this->progress])
            ->andFilterWhere(['like', 'author_name', $this->author_name])
            ->andFilterWhere(['like', 'duration', $this->duration])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'promo', $this->promo])
            ->andFilterWhere(['like', 'author_site', $this->author_site]);

        return $dataProvider;
    }
}
