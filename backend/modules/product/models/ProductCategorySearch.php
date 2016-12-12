<?php

namespace product\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use product\models\ProductCategory;

/**
 * ProductCategorySearch represents the model behind the search form about `product\models\ProductCategory`.
 */
class ProductCategorySearch extends ProductCategory
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
            [['created', 'label', 'promo', 'content'], 'safe'],
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
        $query = ProductCategory::find();

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
            'created' => $this->created,
            'image_id' => $this->image_id,
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'promo', $this->promo])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
