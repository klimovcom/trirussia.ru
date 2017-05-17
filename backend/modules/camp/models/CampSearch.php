<?php

namespace camp\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use camp\models\Camp;

/**
 * CampSearch represents the model behind the search form about `camp\models\Camp`.
 */
class CampSearch extends Camp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'max_user_count', 'image_id', 'price', 'currency'], 'integer'],
            [['label', 'url', 'country', 'region', 'place', 'date_start', 'date_end', 'promo', 'description'], 'safe'],
            [['coord_lon', 'coord_lat'], 'number'],
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
        $query = Camp::find();

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
            'coord_lon' => $this->coord_lon,
            'coord_lat' => $this->coord_lat,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'max_user_count' => $this->max_user_count,
            'image_id' => $this->image_id,
            'price' => $this->price,
            'currency' => $this->currency,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'promo', $this->promo])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
