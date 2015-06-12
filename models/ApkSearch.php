<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Apk;

/**
 * ApkSearch represents the model behind the search form about `app\models\Apk`.
 */
class ApkSearch extends Apk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id','sign', 'version_code', 'file', 'is_system'], 'integer'],
            [['package', 'name', 'type', 'version_name', 'platform', 'release_note'], 'safe'],
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
        $query = Apk::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'version_code' => $this->version_code,
            'file' => $this->file,
            'is_system' => $this->is_system,
            'sign' => $this->sign,
        ]);

        $query->andFilterWhere(['like', 'package', $this->package])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'version_name', $this->version_name])
            ->andFilterWhere(['like', 'platform', $this->platform])
            ->andFilterWhere(['like', 'release_note', $this->release_note]);

        return $dataProvider;
    }
}
