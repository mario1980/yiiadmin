<?php

namespace app\modules\themeforest\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use app\models\Employee;

/**
 * 后台管理员、公司使用的后台管理Controller基类
 */
class themeforestController extends \yii\web\Controller
{

    private $user;
    public $title;
    public $descriptions;
    public $model;
    public $items;
    public $styleSheet = "pink-blue";
    public $hideAddBtn = false;

    public function init()
    {
    }

    public function actionError($message)
    {

        return $this->render('@app/views/layouts/message.php', [
            'message' => $message,
            'error' => true
        ]);
    }

    public function actionSuccess($message)
    {
        return $this->render('@app/views/layouts/message.php', [
            'message' => $message,
            'error' => false
        ]);
    }
}

