<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ad_tpl".
 *
 * @property integer $id
 * @property string $name
 * @property string $template
 * @property string $param
 */
class AdTpl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad_tpl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template'], 'string'],
            [['name', 'param'], 'string', 'max' => 128]
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
            'template' => '模板',
            'param' => '参数',
        ];
    }

}
