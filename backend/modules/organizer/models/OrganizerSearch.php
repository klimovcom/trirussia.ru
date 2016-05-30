<?php

namespace organizer\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use organizer\models\Organizer;

/**
 * OrganizerSearch represents the model behind the search form about `organizer\models\Organizer`.
 */
class OrganizerSearch extends Organizer
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
            [['id', 'image_id', 'published'], 'integer'],
            [['created', 'label', 'country', 'site', 'phone', 'email', 'promo', 'content'], 'safe'],
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
        $query = Organizer::find();

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
            'image_id' => $this->image_id,
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'site', $this->site])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'promo', $this->promo])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
