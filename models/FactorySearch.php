<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Factory;

/**
 * FactorySearch represents the model behind the search form about `app\models\Factory`.
 */
class FactorySearch extends Factory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'total', 'used', 'software', 'hardware', 'created'], 'integer'],
            [['key'], 'safe'],
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
        $query = Factory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'total' => $this->total,
            'used' => $this->used,
            'software' => $this->software,
            'hardware' => $this->hardware,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'key', $this->key]);

        return $dataProvider;
    }
}
