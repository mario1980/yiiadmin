<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "health_knowledge".
 *
 * @property integer $id
 * @property string $title
 * @property string $img
 * @property integer $count
 * @property string $author
 * @property integer $loreclass
 * @property string $className
 * @property string $md
 * @property integer $time
 * @property string $message
 * @property integer $sort_order
 */
class HealthKnowledge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'health_knowledge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'count', 'loreclass', 'time', 'sort_order'], 'integer'],
            [['message'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['img'], 'string', 'max' => 200],
            [['author', 'className'], 'string', 'max' => 20],
            [['md'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'img' => '图片',
            'count' => '浏览',
            'author' => '来源',
            'loreclass' => '分类id',
            'className' => '类名',
            'md' => 'MD',
            'time' => '时间',
            'message' => '内容',
            'sort_order' => '排序',
        ];
    }
}
