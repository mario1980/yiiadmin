<?php

namespace app\modules\themeforest\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SysHooks;

/**
 * SysHooksSearch represents the model behind the search form about `app\models\SysHooks`.
 */
class SysHooksSearch extends SysHooks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'updated'], 'integer'],
            [['name', 'title', 'description', 'type', 'modules'], 'safe'],
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
        $query = SysHooks::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'modules', $this->modules]);

        return $dataProvider;
    }
}
