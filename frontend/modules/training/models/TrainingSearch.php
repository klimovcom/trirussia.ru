<?php

namespace training\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use training\models\Training;

/**
 * TrainingSearch represents the model behind the search form about `training\models\Training`.
 */
class TrainingSearch extends Training
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'place_id', 'sport_id', 'price', 'currency', 'author_id', 'published'], 'integer'],
            [['label', 'date', 'time', 'level', 'trainer_name', 'phone', 'email', 'promo'], 'safe'],
        ];
    }

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->author_id = null;
        $this->published = null;
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
        $query = Training::find();

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
            'date' => $this->date,
            'place_id' => $this->place_id,
            'sport_id' => $this->sport_id,
            'price' => $this->price,
            'currency' => $this->currency,
            'author_id' => $this->author_id,
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'level', $this->level])
            ->andFilterWhere(['like', 'trainer_name', $this->trainer_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'promo', $this->promo]);

        return $dataProvider;
    }
}
