<?php
namespace app\controllers;

use Yii;
use yii\base\Action;
use yii\base\Exception;
use yii\base\UserException;
use app\models\User;

class PublicController extends \yii\web\Controller
{
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
  
    function actionIndex(){
        $imgUrl = Yii::$app->request->get('url');
         return $this->renderFile('@app/views/layouts/modal.php',['imgUrl'=>$imgUrl]);
    }
}
