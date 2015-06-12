<?php

namespace app\modules\api\controllers;

use Yii;
use app\models\HealthKnowledge;
use yii\helpers\Url;

class HealthKnowledgeController extends ApiController
{
    public function actionList()
    {
        //$type    = Yii::$app->request->get('type', 'id');
        $type    = Yii::$app->request->get('id', 0);
        $page    = Yii::$app->request->get('page', 1);
        $limit   = Yii::$app->request->get('limit', 4);
        
        $query = HealthKnowledge::find();
        if ($type)
        {
            $query->where("loreclass=:type", [':type' => $type]);
        }
        $count = $query->count();
        
        $query->offset(($page-1)*$limit);
        $query->limit($limit);
        $query->orderBy('id desc');
        $models = $query->all();
        
        foreach ($models as $k => $v)
        {
            if ($v->message === NULL)
            {
                $v->message = $this->spiderDetail($v->id);
                $v->update();
            }
        }
        
        return ['error_code' => 0, 'result' => ['total' => $count, 'data' => $models]];
    }
    public function actionDetail()
    {
        $id    = Yii::$app->request->get('id', 0);
        
        $model = HealthKnowledge::findOne($id);
        
        return ['error_code' => 0, 'result' => $model];
    }

    public function actionSpider()
    {
        $page = Yii::$app->request->get('page', 1);
        
        $url = 'http://japi.juhe.cn/health_knowledge/infoList';
        $param = ['key' => '289532a3aa4f40081362a85c78cec66a', 'dtype' => 'json', 'page' => $page, 'limit' => 50];
        $resp = \app\components\themeforestHelper::curl($url, $param);
        
        $data = json_decode($resp, true);
        if ($data['error_code'] == 0)
        {
            if ( ! $data['result']['data'])
            {
                die('采集完成');
            }
            
            foreach ($data['result']['data'] as $v)
            {
                $one = HealthKnowledge::findOne($v['id']);
                if ($one)
                {
                    continue;
                }
                
                $model = new HealthKnowledge();
                $v['time'] = strtotime($v['time']);
                $v['sort_order'] = 0;
                $model->attributes = $v;
                if ( ! $model->save(true))
                {
                    print_r($model->errors);
                }
            }
            die('update finish');
        }
        else
        {
            die($data['reason']);
        }
    }

    public function spiderDetail($id)
    {
        $url = 'http://japi.juhe.cn/health_knowledge/infoDetail';
        $param = ['key' => '289532a3aa4f40081362a85c78cec66a', 'dtype' => 'json', 'id' => $id];
        $resp = \app\components\themeforestHelper::curl($url, $param);
        
        $data = json_decode($resp, true);
        if ($data['error_code'] == 0)
        {
            return $data['result']['message'];
        }
        else
        {
            return '';
        }
    }
}
