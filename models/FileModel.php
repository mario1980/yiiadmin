<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "uploaded_file".
 *
 * @property integer $id
 * @property string $name
 * @property string $filename
 * @property integer $size
 * @property string $type
 * @property string $url
 * @property string $aliyun
 * @property string $tag
 */
class FileModel extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @var string Upload path
     */
    public $uploadPath = '@runtime/upload';

    /**
     * @var integer the level of sub-directories to store uploaded files. Defaults to 1.
     * If the system has huge number of uploaded files (e.g. one million), you may use a bigger value
     * (usually no bigger than 3). Using sub-directories is mainly to ensure the file system
     * is not over burdened with a single directory having too many files.
     */
    public $directoryLevel = 1;

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
            [['file'], 'required'],
            [['file'], 'file', 'skipOnEmpty' => false],
            [['uploadPath'], 'required', 'when' => function ($obj) {
                return empty($obj->filename);
            }],
            [['name', 'size'], 'default', 'value' => function ($obj, $attribute) {
                return $obj->file->$attribute;
            }],
            [['type'], 'default', 'value' => function () {
                return FileHelper::getMimeType($this->file->tempName);
            }],
            [['md5'], 'default', 'value' => function () {
                return md5_file($this->file->tempName);
            }],
            [['filename'], 'default', 'value' => function () {
                $key = md5(microtime() . $this->file->name);
                $base = Yii::getAlias($this->uploadPath);
                if ($this->directoryLevel > 0) {
                    for ($i = 0; $i < $this->directoryLevel; ++$i) {
                        if (($prefix = substr($key, $i + $i, 2)) !== false) {
                            $base .= DIRECTORY_SEPARATOR . $prefix;
                        }
                    }
                }
                return $base . DIRECTORY_SEPARATOR . "{$key}_{$this->file->name}";
            }],
            [['size'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['type'], 'string', 'max' => 32],
            [['filename'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Basename',
            'filename' => 'Filename',
            'size' => 'Filesize',
            'type' => 'Content Type',
            'md5' => 'md5',
        ];
    }

    /**
     * @inherited
     */
    public function beforeSave($insert)
    {
        if ($this->file && $this->file instanceof UploadedFile && parent::beforeSave($insert)) {
            FileHelper::createDirectory(dirname($this->filename));
            return $this->file->saveAs($this->filename, false);
        }
        return false;
    }

    /**
     * @inherited
     */
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            return unlink($this->filename);
        }
        return false;
    }

    /**
     * Save file
     * @param UploadedFile $file
     * @param string $path
     * @return boolean|static
     */
    public static function saveAs($file, $path = '@runtime/upload', $directoryLevel = 1,$tag)
    {
//        var_dump($file);exit;
        $model = new static([
            'file' => $file,
            'uploadPath' => $path,
            'directoryLevel' => $directoryLevel,
            'tag'=>$tag,
        ]);
        return $model->save() ? $model : false;
    }

    /**
     * 获取aliyun URL链接
     * @return string
     */
    public function getUrl()
    {
        if ($this->aliyun) {
            return $this->aliyun;
        } else {
            return Yii::$app->request->hostInfo . "/file/download/?id=" . $this->id;
        }
    }
}