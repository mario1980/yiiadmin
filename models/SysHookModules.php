<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sys_hook_modules}}".
 *
 * @property integer $id
 * @property string $hook_id
 * @property string $module_id
 * @property integer $market_id
 * @property integer $store_id
 * @property string $config
 *
 * @property SysHooks $hook
 * @property SysModules $module
 */
class SysHookModules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_hook_modules}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hook_id', 'module_id', 'market_id', 'store_id'], 'required'],
            [['hook_id', 'module_id', 'market_id', 'store_id'], 'integer'],
            [['config'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hook_id' => '钩子',
            'module_id' => '模块',
            'market_id' => '商城',
            'store_id' => '商家',
            'config' => '配置',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHook()
    {
        return $this->hasOne(SysHooks::className(), ['id' => 'hook_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(SysModules::className(), ['id' => 'module_id']);
    }
}
