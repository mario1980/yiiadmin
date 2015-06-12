<?php

namespace app\controllers;

use Yii;
use yii\base\Exception;
use yii\base\UserException;
use app\components\TokenHelper;
use yii\web\HttpException;

class UserController extends \yii\web\Controller {

    // public $layout = 'user/index';
    public function init()
    {

        // Yii::$app->user->on(\yii\web\User::EVENT_BEFORE_LOGIN, function ($event)
        // {
        // echo "Before";
        // var_dump(Yii::$app->user->getIdentity());
        // });
        // Yii::$app->user->on(\yii\web\User::EVENT_AFTER_LOGIN, function ($event)
        // {
        // echo "AFTER";
        // var_dump(Yii::$app->user->getIdentity());
        // exit();
        // });
    }

    /**
     * Login
     */
    public function actionLogin()
    {
        $token = Yii::$app->request->get("token");
        if (!$token)
        {
            if (!\Yii::$app->user->isGuest)
            {
                $this->redirect([
                    'dashboard/index'
                ]);
            }
        }

        $uid = false;
        if ($token)
        {
            $oauth = new \app\components\OAuth();
            $user = $oauth->getUser($token);

            $uid = $user['user_id']; //TokenHelper::decode($token);
        }
        else
        {
            $code = Yii::$app->request->get('code');
            $jump = Yii::$app->request->get('jump');
            if ($code)
            {
                $oauth = new \app\components\OAuth();
                $oauth->getAccessToken('code', array('code' => $code));
                $token = $oauth->access_token;
                $user = $oauth->getUser($oauth->access_token);

                $uid = $user['user_id']; //TokenHelper::decode($token);
            }
        }

        if ($uid)
        {
            Yii::$app->user->logout();
            $account = \app\models\Users::findIdentity($uid);
            if (!$account)
            {
                echo $this->renderFile("@app/views/user/login.php", ['message' => "不是平台用户，如果需要开通，请于当地分公司联系"]);
                return;
            }
            elseif ($account->status == 0)
            {
                echo $this->renderFile("@app/views/user/login.php", ['message' => "帐户在审核中，审核通过后方可登录"]);
                return;
            }
            Yii::$app->user->login($account, 1 ? 3600 * 24 * 30 : 0);            
            Yii::$app->session->set('token', $token);
            $this->redirect([$jump]);
        }
        else
        {
            echo $this->renderFile("@app/views/user/login.php");
        }
    }

    public function actionForward()
    {
        $code = Yii::$app->request->get('code');
        $jump = Yii::$app->request->get('jump');
        if ($code)
        {
            $user = \app\models\Users::loginByAuthorizCode($code);
            if ($user)
            {
                $this->redirect($jump);
            }
        }
        
        echo $this->renderFile("@app/views/user/message.php", [
            'name' => '跳转失败，请重试',
            'message' => '<a href="javascript:;" onclick="history.back()">点此重试</a>',
        ]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect([
                    'user/login'
        ]);
    }

    public function actionError()
    {

        if (($exception = Yii::$app->getErrorHandler()->exception) === null)
        {
            return '';
        }

        if ($exception instanceof HttpException)
        {
            $code = $exception->statusCode;
        }
        else
        {
            $code = $exception->getCode();
        }
        if ($exception instanceof Exception)
        {
            $name = $exception->getName();
        }
        else
        {
            $name = $this->defaultName ? : Yii::t('yii', 'Error');
        }
        if ($code)
        {
            $name .= " (#$code)";
        }

        if ($exception instanceof UserException)
        {
            $message = $exception->getMessage();
        }
        else
        {
            $message = $this->defaultMessage ? : Yii::t('yii', 'An internal server error occurred.');
        }

        if (!\Yii::$app->user->isGuest)
        {

            echo $this->renderFile("@app/views/user/error.php", [
                'name' => $name,
                'message' => $message,
                'exception' => $exception,
            ]);
        }
        else
        {
            echo $this->renderFile("@app/views/user/error.php", [
                'name' => $name,
                'message' => $message,
                'exception' => $exception,
            ]);
        }
        return false;
    }

//     public function actions()
//     {
//         return [
//             'error' => [
//                 'class' => 'yii\web\ErrorAction',
//                 'view' => '@app/views/user/error.php'
//             ],
//             'captcha' => [
//                 'class' => 'yii\captcha\CaptchaAction',
//                 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
//             ]
//         ];
//     }
}
