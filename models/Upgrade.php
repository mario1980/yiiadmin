<?php

namespace app\models;

use app\components\UploadBehavior;
use Yii;

/**
 * This is the model class for table "upgrade".
 *
 * @property integer $id
 * @property integer $from
 * @property integer $to
 * @property integer $file
 * @property integer $status
 * @property integer $fileModel
 *
 * @property Version $fromVer
 * @property Version $toVer
 * @property Version $type
 */
class Upgrade extends \app\models\themeforestActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'upgrade';
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
            [['from', 'to', 'status','type'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => '起始版本',
            'to' => '目标版本',
            'file' => '附件',
            'type' => '升级类型',
            'status' => '状态',
        ];
    }
    public function behaviors() {
        return [

            [
                'class' => UploadBehavior::className(),
                'attribute' => 'file', // required, use to receive input file
                'savedAttribute' => 'file', // optional, use to link model with saved file.
                'uploadPath' => '@webroot/upload', // saved directory. default to '@runtime/upload'
                'tag'=>'upgrade'
            ],
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromVer()
    {
        return $this->hasOne(Version::className(), ['id' => 'from']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToVer()
    {
        return $this->hasOne(Version::className(), ['id' => 'to']);
    }
    public function getFileModel()
    {
        return $this->hasOne(FileModel::className(), ['id' => 'file']);

    }
    public function fromFunc($model){

        return $this->fromVer->name;
    }
    public function toFunc($model){

        return $this->toVer->name;
    }
}
