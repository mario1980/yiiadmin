<?php

namespace app\modules\backend\controllers;

use Yii;

class BackendController extends \yii\web\Controller {

    private $user;
    public $title;
    public $descriptions;
    public $model;
    public $items;
    public $roleName;
    public $market;
    public $layout = '@app/views/layouts/backend';
    public $styleSheet = "yellow-grey";
    public $hideAddBtn;

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
