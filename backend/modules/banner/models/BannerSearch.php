<?php

namespace banner\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use banner\models\Banner;

/**
 * BannerSearch represents the model behind the search form about `banner\models\Banner`.
 */
class BannerSearch extends Banner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'image_id', 'status'], 'integer'],
            [['label'], 'safe'],
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
        $query = Banner::find();

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
            'image_id' => $this->image_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label]);

        return $dataProvider;
    }
}
