<?php

namespace promocode\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use promocode\models\Promocode;

/**
 * PromocodeSearch represents the model behind the search form about `promocode\models\Promocode`.
 */
class PromocodeSearch extends Promocode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'discount'], 'integer'],
            [['label', 'url', 'promo', 'conditions', 'promocode'], 'safe'],
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
        $query = Promocode::find();

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
            'discount' => $this->discount,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'promo', $this->promo])
            ->andFilterWhere(['like', 'conditions', $this->conditions])
            ->andFilterWhere(['like', 'promocode', $this->promocode]);

        return $dataProvider;
    }
}
