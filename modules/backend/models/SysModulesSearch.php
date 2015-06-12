<?php

namespace app\modules\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SysModules;

/**
 * SysModulesSearch represents the model behind the search form about `app\models\SysModules`.
 */
class SysModulesSearch extends SysModules
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created', 'has_adminlist', 'type'], 'integer'],
            [['name', 'class', 'title', 'description', 'config', 'author', 'version'], 'safe'],
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
        $query = SysModules::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created' => $this->created,
            'has_adminlist' => $this->has_adminlist,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'config', $this->config])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'version', $this->version]);

        return $dataProvider;
    }
}
