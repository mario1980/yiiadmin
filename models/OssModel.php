<?php
/**
 * Created by PhpStorm.
 * User: themeforest
 * Date: 2015/3/24
 * Time: 15:44
 */

namespace app\models;

use Yii;

/**
 * This is the model class for table "uploaded_file".
 *
 * @property integer $id
 * @property string $name
 * @property string $filename
 * @property integer $size
 * @property integer $md5
 * @property string $type
 * @property string $aliyun
 */
class OssModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uploaded_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aliyun'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aliyun' => 'Aliyun',
        ];
    }

}