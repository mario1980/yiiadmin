<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Upgrade;

/**
 * UpgradeSearch represents the model behind the search form about `app\models\Upgrade`.
 */
class UpgradeSearch extends Upgrade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'from', 'to', 'file', 'status'], 'integer'],
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
        $query = Upgrade::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'from' => $this->from,
            'to' => $this->to,
            'file' => $this->file,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
