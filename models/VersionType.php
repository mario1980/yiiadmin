<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "version_type".
 *
 * @property integer $id
 * @property string $type
 *
 * @property Version[] $versions
 */
class VersionType extends \app\models\themeforestActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'version_type';
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
            [['type'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '版本类型',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVersions()
    {
        return $this->hasMany(Version::className(), ['type' => 'id']);
    }
}
