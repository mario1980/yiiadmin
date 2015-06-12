<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sys_modules}}".
 *
 * @property string $id
 * @property string $name
 * @property string $class
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $config
 * @property string $author
 * @property string $version
 * @property string $created
 * @property integer $has_adminlist
 * @property integer $type
 *
 * @property SysHookModules[] $sysHookModules
 */
class SysModules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_modules}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class'], 'required'],
            [['description', 'config'], 'string'],
            [['status', 'created', 'has_adminlist', 'type'], 'integer'],
            [['name', 'title', 'version'], 'string', 'max' => 20],
            [['class'], 'string', 'max' => 100],
            [['author'], 'string', 'max' => 40]
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
            'class' => '类名',
            'title' => '模块名',
            'description' => '插件描述',
            'status' => '状态',
            'config' => '配置',
            'author' => '作者',
            'version' => '版本号',
            'created' => '安装时间',
            'has_adminlist' => '是否有后台列表',
            'type' => '插件类型 0 普通插件',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysHookModules()
    {
        return $this->hasMany(SysHookModules::className(), ['module_id' => 'id']);
    }
}
