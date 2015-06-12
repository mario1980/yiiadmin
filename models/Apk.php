<?php

namespace app\models;


use Yii;
use app\components\UploadBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;


/**
 * This is the model class for table "vrs_apk".
 *
 * @property integer $id
 * @property string $package
 * @property integer $name
 * @property string $type
 * @property integer $user_id
 * @property string $version_name
 * @property integer $version_code
 * @property integer $file
 * @property string $platform
 * @property string $sign
 * @property integer $is_system
 * @property string $release_note
 */
class Apk extends \yii\db\ActiveRecord
{
    private $platformArr;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vrs_apk';
    }
    public function behaviors() {
        return [

            [
                'class' => UploadBehavior::className(),
                'attribute' => 'file', // required, use to receive input file
                'savedAttribute' => 'file', // optional, use to link model with saved file.
                'uploadPath' => '@webroot/upload', // saved directory. default to '@runtime/upload'
            ],
        ];
    }
    public function beforeSave($insert)
    {
        $this->user_id  = Yii::$app->user->id;
        $apk = ArrayHelper::getValue(Yii::$app->request->post(),'Apk');
        if(!empty($apk['platformArr']))
        $this->platform = implode(",",$apk['platformArr']);
        return parent::beforeSave($insert);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['file'], 'validateFile'],
            [['name',"release_note"], 'required'],
            [['type', 'release_note'], 'string'],
            [['user_id','name', 'version_code', 'is_system'], 'integer'],
            [['package'], 'string', 'max' => 200],
            [[ 'version_name', 'platform','sign'], 'string', 'max' => 100]

        ];
    }
    /**
     * 附件验证
     * @param type $attribute
     * @param type $params
     * @return boolean
     */
    public function validateFile($attribute, $params)
    {
        $exist = Apk::find()->where([
            'package'=>$this->package,
            'version_code'=>$this->version_code,

        ])->one();
//        VarDumper::dump($exist); exit;
        if($exist){
            $this->addError($attribute, '相同的version_code已经存在');
            return false;
        }

        return true;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'package' => '包名',
            'name' => '应用名',
            'type' => '发布类型',
            'user_id' => '作者',
            'version_name' => '版本号',
            'version_code' => '内部号',
            'file' => 'APK文件',
            'sign' => '签名方式',
            'platform' => '运行平台',
            'platformArr' => '运行平台',
            'is_system' => '是否系统应用',
            'release_note' => '修改日志',
            'created' => '上传日期',
        ];
    }
    public function platformArrFunc(){
        return $this->platform;
    }
    public function getPlatformArr(){
        return explode(",",$this->platform);
    }
    public function getAuthor(){
        return Users::findOne($this->user_id);
    }
    public function nameFunc(){
        if($this->apkName->package != $this->package)
        {
            return $this->apkName->name." ".$this->apkName->package;
        }
        return $this->apkName->name;

    }
    public static function platformOptions(){
        return ["WA1"=>"WA1","WB1"=>"WB1","Phone"=>"Phone"];
    }
    public function getApkName()
    {
        return $this->hasOne(ApkNames::className(), ['id' => 'name']);
    }
    public function getApkFile()
    {
        return $this->hasOne(FileModel::className(), ['id' => 'file']);
    }
    public function userIdFunc(){


        return $this->author->nickname;
    }
}
