<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Device;

/**
 * DeviceSearch represents the model behind the search form about `app\models\Device`.
 */
class DeviceSearch extends Device
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mac', 'created'], 'integer'],
            [['ei', 'software', 'hardware', 'imei', 'sn'], 'safe'],
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
        $query = Device::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'mac' => $this->mac,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'ei', $this->ei])
            ->andFilterWhere(['like', 'software', $this->software])
            ->andFilterWhere(['like', 'hardware', $this->hardware])
            ->andFilterWhere(['like', 'imei', $this->imei])
            ->andFilterWhere(['like', 'sn', $this->sn]);

        return $dataProvider;
    }
}
