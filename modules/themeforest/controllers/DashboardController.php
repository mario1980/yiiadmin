<?php

namespace app\modules\themeforest\controllers;
use Yii;

class DashboardController extends themeforestController
{
    public $title = "";
    public function actionIndex()
    {
        $user = Yii::$app->user->getIdentity();
        return $this->render('index',["user"=>$user]);
    }


}
