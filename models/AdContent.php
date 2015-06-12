<?php

namespace app\models;

use app\components\themeforestHelper;
use Yii;
use app\components\UploadBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "ad_content".
 *
 * @property integer $id
 * @property integer $pos_id
 * @property string $title
 * @property string $img
 * @property string $ext
 * @property string $updated
 * @property string $fileModel
 */
class AdContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'pos_id',  'title'
                ],
                'required'
            ],
            [['ext'], 'string'],
            [['title'], 'string', 'max' => 128]
        ];
    }

    public function beforeSave($insert){

        $this->updated = time();
        return parent::beforeSave($insert);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pos_id' => '广告位',
            'title' => '标题',
            'img' => '图片',
            'ext' => '内容',
        ];
    }
    public function behaviors() {
        return [

            [
                'class' => UploadBehavior::className(),
                'attribute' => 'img', // required, use to receive input file
                'savedAttribute' => 'img', // optional, use to link model with saved file.
                'uploadPath' => '@webroot/upload', // saved directory. default to '@runtime/upload'
                'tag'=>'adpics'
            ],
        ];
    }
    public function getPos()
    {
        return $this->hasOne(AdPos::className(), ['id' => 'pos_id']);
    }

    public function getTpl()
    {
        return $this->pos->tpl;
    }
    public function getImgUrl(){
        return $this->fileModel->url;
    }
    public function getFileModel()
    {
        return $this->hasOne(FileModel::className(), ['id' => 'img']);

    }
    public function extFunc($model){
        $arr = unserialize($model->ext);
        $ext = '';
        foreach($arr as $k=>$v){
            $ext .= $k.":".$v." ";
        }
        return $ext;
    }
    public function posIdFunc($model){
        return $this->pos->name;
    }
    public function posIdFilter(){
        return ArrayHelper::map(AdPos::find()->all(),'id','name');
    }
    public function imgFunc($model){
        return themeforestHelper::modalImg($model->img);
    }
}
