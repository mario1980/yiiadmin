<?php

namespace app\modules\themeforest\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AdPos;

/**
 * AdPosSearch represents the model behind the search form about `app\models\AdPos`.
 */
class AdPosSearch extends AdPos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tpl_id'], 'integer'],
            [['name'], 'safe'],
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
        $query = AdPos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tpl_id' => $this->tpl_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
