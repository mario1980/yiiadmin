<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "factory".
 *
 * @property integer $id
 * @property integer $total
 * @property integer $used
 * @property string $key
 * @property integer $software
 * @property integer $hardware
 * @property integer $created
 *
 * @property Version $hardVer
 * @property Version $softVer
 */
class Factory extends \app\models\themeforestActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'factory';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db');
    }
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {

            $this->created = time();

        }
        if(strlen($this->key)<12){
            $this->key.=date("y").str_pad(date('z'),3,0,STR_PAD_LEFT);
        }
       return parent::beforeSave($insert);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total', 'used', 'software', 'hardware', 'created'], 'integer'],
            [['software', 'hardware'], 'required'],
            [['key'], 'string', 'max' => 100],
            [['key'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'total' => '生产数',
            'used' => '已经使用数',
            'key' => '生产密钥',
            'software' => '软件版本号',
            'hardware' => '硬件版本号',
            'created' => '创建时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHardVer()
    {
        return $this->hasOne(Version::className(), ['id' => 'hardware']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSoftVer()
    {
        return $this->hasOne(Version::className(), ['id' => 'software']);
    }

    public function softwareFunc(){
        return $this->softVer->name;
    }
    public function hardwareFunc(){
        return $this->hardVer->name;
    }
    public static function encrypt($d){
        return exec("themeforestcrypt en ".$d);
    }
    public static function decrypt($d){
        return exec("themeforestcrypt de ".$d);
    }
    public function keyFunc(){
        return Html::a($this->key,['factory/key','str'=>$this->key],['target'=>"_blank"]);
    }
    public function optimisticLock()
    {
        return 'optimistic_lock';
    }
}
