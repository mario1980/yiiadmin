<?php

namespace app\modules\themeforest\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AdContent;

/**
 * AdSearch represents the model behind the search form about `app\models\AdContent`.
 */
class AdSearch extends AdContent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pos_id'], 'integer'],
            [['title', 'img'], 'safe'],
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
        $query = AdContent::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'pos_id' => $this->pos_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
