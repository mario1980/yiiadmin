<?php
/**
 * 设备激活接口
 */

namespace app\modules\api\controllers;
use app\models\Device;
use Yii;
use app\models\Factory;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ActivateController extends ApiController {

    public function actionIndex(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $ei = Yii::$app->request->get('ei');
        $key = Yii::$app->request->get('key');
        $ver = Yii::$app->request->get('ver');
        $mac = Yii::$app->request->get('mac');
        $imei = Yii::$app->request->get('imei');

        if(!$ei ){
            return ['code'=>-1,'message'=>'EI is empty'];
        }
        if(!$key ){
            return ['code'=>-1,'message'=>'key is empty'];
        }
        if(!$ver ){
            return ['code'=>-1,'message'=>'ver is empty'];
        }
        if(!$mac ){
            return ['code'=>-1,'message'=>'mac is empty'];
        }
        if(!$imei ){
            return ['code'=>-1,'message'=>'IMEI is empty'];
        }
        if($device = $this->getDeviceByEI($ei)){

            return ['code'=>0,'key'=>Factory::encrypt($ei),'sn'=>$device->sn,'hardware'=>$device->hardware,'message'=>'RECOVERY'];

        }
        $clientKey = Factory::decrypt($key);
        if(strlen($clientKey)==12){
//            $transaction=\Yii::$app->db4->beginTransaction();
            $factory = $this->getFacByKey($clientKey);

            //生成SN
            $sn = $this->generate($factory);

            $device = new Device();
            $device->sn = $sn;
            $device->ei = $ei;
            $device->software = $ver;
            $device->hardware = $factory->hardVer->name;
            $device->mac = $mac;
            $device->imei = $imei;
            $device->save();
//            sleep(10);
//            $transaction->commit();
            return ['code'=>0,'key'=>Factory::encrypt($ei),'sn'=>$sn,'hardware'=>$factory->hardVer->name,'message'=>'NEW'];
        }
        elseif(strlen($clientKey)==17){

        }
        else{
            return ['code'=>-2,'message'=>'key is invalid'];
        }
//        var_dump($clientKey); exit;

    }
    private function getFacByKey($key){

        if (($model = Factory::find()->where(['key'=>$key])->one()) !== null) {
            if($model->used >=$model->total){
                throw new NotAcceptableHttpException('activate already finish.',-4);
            }
            return $model;
        } else {

            throw new NotFoundHttpException('The key does not exist.',-4);
        }
    }

    private function generate(Factory $factory){



        $factory->refresh();

        $ext = str_pad($factory->used,5,"0",STR_PAD_LEFT);
        $factory->used ++;
        $factory->save();
        return $factory->key.$ext;
    }


    private function getDeviceByEI($ei){
        $device = Device::find()->where(['ei'=>$ei])->one();
        return $device;
    }




}