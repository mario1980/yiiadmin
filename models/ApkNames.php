<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vrs_apk_names".
 *
 * @property integer $id
 * @property string $package
 * @property string $name
 * @property string $export_file
 *
 * @property VrsApk[] $vrsApks
 */
class ApkNames extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vrs_apk_names';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['package'], 'string', 'max' => 200],
            [['name'], 'string', 'max' => 100],
            [['export_file'], 'string', 'max' => 50]
        ];
    }

    /**
     * 格式化后的应用名称显示
     * @return string
     */
    public function getFormatName(){
        return $this->name." | ".$this->package;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'package' => '包名',
            'name' => '应用名称',
            'export_file' => '输出文件名',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVrsApks()
    {
        return $this->hasMany(VrsApk::className(), ['name' => 'id']);
    }
}
