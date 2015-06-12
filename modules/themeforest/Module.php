<?php

namespace app\modules\themeforest;

use Yii;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'app\modules\themeforest\controllers';
    public $defaultRoute = 'dashboard';
    public $layout = 'main';
    public $title;

    public function init()
    {
        parent::init();

        if (!$this->vaild(Yii::$app->requestedRoute))
        {
            throw new \yii\web\ForbiddenHttpException('对不起，您现在还没获此操作的权限');
        }

        $this->modules = [
            'admin' => [
                'class' => 'mdm\admin\Module',
                //'layout' => 'left-menu',
                //'mainLayout' => __DIR__.'/views/layouts/main.php',
                'navbar' => [
                    ['label' => 'Application', 'url' => 'ssss']
                ]
            ],
        ];
    }

    private function vaild($action)
    {
        if ($action{0} != "/")
        {
            $action = "/" . $action;
        }

        if (Yii::$app->user->isGuest)
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
