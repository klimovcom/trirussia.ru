<?php

namespace coach\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use coach\models\Coach;

/**
 * CoachSearch represents the model behind the search form about `coach\models\Coach`.
 */
class CoachSearch extends Coach
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'image_id'], 'integer'],
            [['created', 'label', 'country', 'site', 'phone', 'email', 'fb_link', 'vk_link', 'ig_link'], 'safe'],
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
        $query = Coach::find();

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
            'image_id' => $this->image_id,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'site', $this->site])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'fb_link', $this->fb_link])
            ->andFilterWhere(['like', 'vk_link', $this->vk_link])
            ->andFilterWhere(['like', 'ig_link', $this->ig_link]);

        $query->orderBy('id DESC');

        return $dataProvider;
    }
}
