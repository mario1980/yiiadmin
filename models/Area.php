<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "area".
 *
 * @property string $area_id
 * @property string $parent_id
 * @property string $path
 * @property string $grade
 * @property string $name
 * @property string $language
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'grade'], 'integer'],
            [['path', 'name', 'language'], 'required'],
            [['path'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 45],
            [['language'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'area_id' => 'Area ID',
            'parent_id' => 'Parent ID',
            'path' => 'Path',
            'grade' => 'Grade',
            'name' => 'Name',
            'language' => 'Language',
        ];
    }
    
    
    public function getAreas($state = 0, $city = 0, $district = 0)
    {
        $data = array();
        $areas = Area::find()->where(['grade' => 1])->all();
        
        $list = ['' => '请选择省份'];
        $list += ArrayHelper::map($areas, "area_id", "name");
        array_push($data, $list);
        
        if ($state > 0)
        {
            foreach (['state', 'city', 'district'] as $area)
            {
                $list = ['' => '请选择...'];
                if ($$area)
                {
                    $areas = Area::find()->where(['parent_id'  => $$area])->all();
                    $list += ArrayHelper::map($areas, "area_id", "name");
                }
                array_push($data, $list);
            }
        } 
        else 
        {
            array_push($data, ['' => '请选择城市'], ['' => '请选择地区'], ['' => '']);
        }
        return $data;
    }
    
    public function getAreasName($state = 0, $city = 0, $district = 0)
    {
        $model = new Area();
        $state    = $model->findOne(['area_id' => $state]);
        $city     = $model->findOne(['area_id' => $city]);
        $district = $model->findOne(['area_id' => $district]);
        $data = [
            ! $state ? '' : $state->name,
            ! $city ? '' : $city->name,
            ! $district ? '' : $district->name,
        ];
        return $data;
    }
    
    public static function getName($id)
    {
        $model = Area::findOne(['area_id' => $id]);
        return ( ! $model ? '' : $model->name);
    }
}
