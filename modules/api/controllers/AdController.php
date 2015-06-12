<?php

namespace app\modules\api\controllers;


use app\models\AdPos;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\rest\Controller;
use yii\web\Response;

class AdController extends ApiController
{
    public function actionIndex()
    {
        $pid = Yii::$app->request->get('pid',1);
        $token = Yii::$app->request->get('token');
        $token = urlencode($token);
        $adPos = AdPos::findOne($pid);
        if($pid===null OR $adPos == null)
        {
            return ['code'=>-1 ,'message'=>"Can not find this pid=".$pid];
        }

        if( ! $adPos->ads){

            return ['code'=>-2 ,'message'=>"Empty ads"];
        }
        foreach($adPos->ads as $k=>$v){
            if(!$v->ext){
                continue;
            }
            $extData = $this->parseTpl($v->ext,$adPos->tpl);
            $ads[] = ArrayHelper::merge(['aid'=>$v->id,'title'=>$v->title,'img'=>$v->imgUrl],$extData);

        }

        return [
            'code'=>0,
            'ret'=>0,
            'lastUpdate' => date("Y-m-d H:i:s",$adPos->ads[0]->updated ),
            'list'=>$ads
        ];


    }
    protected  function parseTpl($ext,$tpl){

        $extArray = unserialize($ext);
        $token = Yii::$app->request->get('token');
        $template = $tpl->template;
        foreach($extArray as $k=>$v){
           $template= str_replace("{".$k."}",$v,$template);

        }
        $template= str_replace("{token}",$token,$template);
        return json_decode($template,true);

    }
    public function getAd($pid){
        var_dump($pid); exit;
        $token = Yii::$app->request->get('token');
        $token = urlencode($token);
        $adPos = AdPos::findOne($pid);



    }

}
