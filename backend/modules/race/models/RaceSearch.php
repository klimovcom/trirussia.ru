<?php

namespace race\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use race\models\Race;
use yii\helpers\VarDumper;

/**
 * RaceSearch represents the model behind the search form about `race\models\Race`.
 */
class RaceSearch extends Race
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
            [['id', 'author_id', 'organizer_id', 'main_image_id', 'published', 'sport_id'], 'integer'],
            [[
                'created',
                'start_date',
                'finish_date',
                'start_time',
                'country',
                'region',
                'place',
                'label',
                'url',
                'currency',
                'site',
                'promo',
                'content',
                'instagram_tag',
                'facebook_event_id',
            ], 'safe'],
            [['price'], 'number'],
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

        $query = Race::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder'=> ['id' => SORT_DESC],
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
            'start_date' => $this->start_date,
            'finish_date' => $this->finish_date,
            'price' => $this->price,
            'organizer_id' => $this->organizer_id,
            'main_image_id' => $this->main_image_id,
            'published' => $this->published,
            'sport_id' => $this->sport_id,
        ]);

        $query->andFilterWhere(['like', 'start_time', $this->start_time])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'site', $this->site])
            ->andFilterWhere(['like', 'promo', $this->promo])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'instagram_tag', $this->instagram_tag])
            ->andFilterWhere(['like', 'facebook_event_id', $this->facebook_event_id]);

        return $dataProvider;
    }

    public function behaviors()
    {
        return [];
    }
}
