<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "upgrade_log".
 *
 * @property integer $id
 * @property string $sn
 * @property string $from
 * @property string $to
 * @property string $created
 * @property string $ip
 * @property string $geo
 * @property string $user
 */
class UpgradeLog extends \app\models\themeforestActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'upgrade_log';
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
            [['created'], 'safe'],
            [['sn'], 'string', 'max' => 300],
            [['from', 'to'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sn' => 'SN',
            'from' => '起始版本',
            'to' => '目标版本',
            'created' => '时间',
            'ip' => 'IP',
            'geo' => '位置',
            'user' => '用户',
        ];
    }
}
