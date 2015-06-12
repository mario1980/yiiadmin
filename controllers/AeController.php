<?php
/**
 * Created by PhpStorm.
 * User: kint
 * Date: 15/6/8
 * Time: 下午3:20
 */
namespace app\controllers;

use app\models\Factory;

class AeController extends PublicController{
    function actionEncrypt($str){
        echo Factory::encrypt($str);

    }
    function actionDecrypt($str){
        echo Factory::decrypt($str);

    }
}
