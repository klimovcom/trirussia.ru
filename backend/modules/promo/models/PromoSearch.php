<?php

namespace promo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use promo\models\Promo;

/**
 * PromoSearch represents the model behind the search form about `promo\models\Promo`.
 */
class PromoSearch extends Promo
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->created = '';
        $this->published = '';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'position', 'published', ], 'integer'],
            [['label', 'content', 'created'], 'safe'],
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
        $query = Promo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'position' => $this->position,
            'published' => $this->published,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
