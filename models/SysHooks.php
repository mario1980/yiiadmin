<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sys_hooks}}".
 *
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string $updated
 * @property string $modules
 *
 * @property SysHookModules[] $sysHookModules
 */
class SysHooks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_hooks}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description', 'type'], 'string'],
            [['updated'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 20],
            [['modules'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'name' => '标识',
            'title' => '钩子名',
            'description' => '描述',
            'type' => '类型',
            'updated' => '更新时间',
            'modules' => '钩子挂载的模块 \'，\'分割',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysHookModules()
    {
        return $this->hasMany(SysHookModules::className(), ['hook_id' => 'id']);
    }
}
