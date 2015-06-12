<?php

namespace app\controllers;

use app\components\themeforestHelper;
use app\models\Apk;
use app\models\FileModel;
use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\helpers\FileHelper;

class SiteController extends \yii\web\Controller
{
    public $title = "账户总览";

    public function actionIndex()
    {

        return $this->renderFile('@app/themes/basic/site/index.php');
    }

    /**
     * Login
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest)
        {
            $this->redirect([
                'dashboard/index'
            ]);
        }

        echo $this->renderFile("@app/views/user/login.php");
    }

    /**
     * 登录跳转
     */
    public function actionForward()
    {
        $code = Yii::$app->request->get('code');
        $jump = Yii::$app->request->get('jump');

        if (\app\models\Users::loginByAuthorizCode($code))
        {
            if (!$jump)
            {
                $jump = 'site/index';
            }

            $this->redirect([$jump]);
        }
        else
        {
            echo $this->renderFile("@app/views/user/error.php", [
                'name' => '登录失败',
                'message' => '',
                'exception' => NULL,
            ]);
        }
    }

    public function actionLogout()
    {
        $jump = Yii::$app->request->get('jump');
        Yii::$app->user->logout();
        return $this->redirect(['user/login', 'jump' => $jump]);
    }




}
