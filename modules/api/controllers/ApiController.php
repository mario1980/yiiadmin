<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;

class ApiController extends Controller {

    public function init()
    {
        $token = \Yii::$app->request->get('token');
        Yii::$app->user->identityClass = \app\models\Users::className();
        if ($token)
        {
            \app\models\Users::loginByAccessToken($token);
        }
        
        return parent::init();
    }

    public function beforeAction($action)
    {
        $result = parent::beforeAction($action);
        return $result;
    }

    /**
     *
     */
    public function afterAction($action, $result)
    {

        $result = parent::afterAction($action, $result);
        $format = Yii::$app->request->getQueryParam('format', 'json');
        $callBack = Yii::$app->request->getQueryParam('callback', 'callback');

        if ($format == 'jsonp')
        {
            $data['data'] = $result;
            $data['callback'] = $callBack;
            Yii::$app->response->format = Response::FORMAT_JSONP;
            return $data;
        }
        elseif ($format == 'json')
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }
        else
        {
            Yii::$app->response->format = Response::FORMAT_XML;
        }



        return $result;
    }

}
