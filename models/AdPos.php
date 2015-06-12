<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ad_pos".
 *
 * @property integer $id
 * @property string $name
 * @property integer $tpl_id
 */
class AdPos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad_pos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tpl_id', 'name'], 'required'],
            [['tpl_id'], 'integer'],
            [['name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'tpl_id' => '显示模板',
        ];
    }

    public function getTpl()
    {
        return $this->hasOne(AdTpl::className(), ['id' => 'tpl_id']);
    }

    public function tplIdFunc($model)
    {
        return $model->tpl->name;
    }

    public function getAds()
    {
        return $this->hasMany(AdContent::className(), ['pos_id' => 'id']);
    }
}
