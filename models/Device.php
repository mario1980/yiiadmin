<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property integer $id
 * @property string $ei
 * @property string $software
 * @property string $hardware
 * @property integer $mac
 * @property string $imei
 * @property string $sn
 * @property integer $created
 */
class Device extends \app\models\themeforestActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device';
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
            [[ 'created'], 'integer'],
            [['ei', 'imei'], 'string', 'max' => 500],
            [['software', 'hardware'], 'string', 'max' => 100],
            [['sn','mac'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ei' => 'EI',
            'software' => '软件版本',
            'hardware' => '硬件版本',
            'mac' => 'MAC地址',
            'imei' => 'IMEI',
            'sn' => 'SN',
            'created' => '激活时间',
        ];
    }
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created = time();

        }
        return parent::beforeSave($insert);
    }
}
