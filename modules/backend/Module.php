<?php

namespace app\modules\backend;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\backend\controllers';

    public function init()
    {
        parent::init();

        if (!$this->vaild(Yii::$app->requestedRoute))
        {
            throw new \yii\web\ForbiddenHttpException('对不起，您现在还没获此操作的权限');
        }
    }
    
    
    private function vaild($action)
    {
        if ($action{0} != "/")
        {
            $action = "/" . $action;
        }

        if (Yii::$app->user->isGuest AND  ! YII_ENV_DEV)
        {
            Yii::$app->getResponse()->redirect(["/user/login", 'jump' => $action]);
        }
        
        if (Yii::$app->user->can($action) OR \Yii::$app->user->can("/*") OR \Yii::$app->user->can("/themeforest/*") OR YII_ENV_DEV)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
