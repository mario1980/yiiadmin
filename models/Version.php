<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "version".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $log
 *
 * @property VersionType $type0
 */
class Version extends \app\models\themeforestActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'version';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['log'], 'string'],
            [['name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '类型',
            'name' => '版本名称',
            'log' => '日志',
        ];
    }
    public function typeFunc($model){
        return $this->versionType->type;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVersionType()
    {
        return $this->hasOne(VersionType::className(), ['id' => 'type']);
    }
}
