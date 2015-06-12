<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class themeforestActiveRecord extends ActiveRecord  {

    public function createdFunc($model){
        return date("Y-m-d H:i:s",$model->created);
    }

}
