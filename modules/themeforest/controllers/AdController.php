<?php

namespace app\modules\themeforest\controllers;

use app\modules\themeforest\controllers\themeforestController;
use Yii;
use app\models\AdContent;
use app\modules\themeforest\models\AdSearch;

use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\themeforestColumns;
use kartik\grid\GridView;

/**
 * AdController implements the CRUD actions for AdContent model.
 */
class AdController extends themeforestController
{
    public $title = "广告内容管理";
    public $descriptions = "";
    public $hideAddBtn = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all AdContent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->model = $searchModel;
        $attributeLabels = $searchModel->attributeLabels();
        //获取$attributeLabels的变量进行初始化
        $labels = array_fill_keys(array_keys($attributeLabels), []);

        /**
         * 自定义列显示规则
         *
         * $labels['type']['filterType'] = GridView::FILTER_SELECT2;
         * $labels['bank']['filterType'] = GridView::FILTER_SELECT2;
         * $labels['money']['pageSummary'] = true;
         * $labels['id']['pageSummary'] = "小计";
         * $labels['status']['class'] = 'kartik\grid\BooleanColumn';
         * $labels['created']['format'] = [
         * 'date',
         * 'Y-M-d'
         * ];
         */
        $labels['pos_id']['filterType'] = GridView::FILTER_SELECT2;
        //$labels['ext']['noWrap'] = false;
        $labels['title']['noWrap'] = false;
        //$labels['ext']['mergeHeader'] = true;
        $labels['img']['mergeHeader'] = true;
        
        unset($labels['ext']);
        foreach ($labels as $k => $v) {
            $labels[$k]['attribute'] = $k;
            $labels[$k]['model'] = $this->model;
            $columns[] = (new themeforestColumns($labels[$k]))->gen();
        }

        $columns[] = [
            'class' => '\app\components\ActionColumn'
        ];

        return $this->render('@app/views/layouts/index.php', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'columns' => $columns
        ]);
    }

    /**
     * Displays a single AdContent model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdContent();
        $postData = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->saveUploadedFile(true);
            $model->ext = serialize($postData['ext']);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if (!isset($postData['AdContent']['pos_id'])) {
                return $this->render('choose', [
                    'model' => $model,
                ]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

        }
    }

    /**
     * Updates an existing AdContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $postData = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!empty($_FILES)) {
                $model->saveUploadedFile(true);
            }
            $model->ext = serialize($postData['ext']);
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdContent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTpl()
    {

        $tpl[0] = [

            'package' => 'com.themeforest.phone.wxb',
            'activity' => 'com.themeforest.phone.wxb.webview.WebActivity',
            'action' => '',
            'intentCategory' => '',
            'bg' => '',
            'apk' => '',
            'param' => [
                "paramCount" => 1,
                'v' => [['key' => 'url',
                    'type' => 'string',
                    'value' => "{url}",
                ]]
            ],
        ];

        $tpl[1] = [

            'package' => 'com.themeforest.phone.wxb',
            'activity' => 'com.themeforest.phone.wxb.webview.WebActivity',
            'action' => '',
            'intentCategory' => '',
            'bg' => '',
            'apk' => '',
            'price' => '{price}',
            'param' => [
                "paramCount" => 1,
                'v' => [['key' => 'url',
                    'type' => 'string',
                    'value' => "{url}",
                ]]
            ],
        ];

        $tpl[2] = [

            'package' => 'com.themeforest.phone.wxb',
            'activity' => 'com.themeforest.phone.wxb.webview.WebActivity',
            'action' => '',
            'intentCategory' => '',
            'bg' => '',
            'apk' => '',
            'price' => '{price}',
            'sold' => '{sold}',
            'param' => [
                "paramCount" => 1,
                'v' => [['key' => 'url',
                    'type' => 'string',
                    'value' => "{url}",
                ]]
            ],
        ];
        $tpl[3] = [

            'package' => 'com.themeforest.phone.wxb.setting',
            'activity' => 'com.themeforest.phone.wxb.setting.SetActivity',
            'action' => '',
            'intentCategory' => '',
            'bg' => '',
            'apk' => '',
            'param' => [
                "paramCount" => 1,
                'v' => [['key' => 'url',
                    'type' => 'string',
                    'value' => "{url}",
                ]]
            ],
        ];
        $tpl[3] = [
            'url'=> "{url}",

        ];


        $tpl[4] = [

            'package' => 'com.themeforest.wxb.miniplayer',
            'activity' => 'com.themeforest.wxb.miniplayer.MainActivity',
            'action' => '',
            'intentCategory' => '',
            'pos_x' => '{pos_x}',
            'pos_y' => '{pos_y}',
            'duration' => '{duration}',
            'hits' => '{hits}',
            'wifi_only' => '{wifi_only}',
            'bg' => '',
            'apk' => '',
            'param' => [
                
                'v' => [
                ['key' => 'url',
                    'type' => 'string',
                    'value' => "{url}",
                ]]
            ],
        ];
//        {"url":{"lable":"\u7f51\u5740","type":"text","name":"url"}}

        $param[1] = ['url' =>
            [
                'lable' => '微信文章地址', 'type' => 'text', 'name' => 'url']

            ];
        $param[4] = 
            [
                'pos_x' =>['lable' => '广告显示坐标x', 'type' => 'text', 'name' => 'pos_x'],
                'pos_y' =>['lable' => '广告显示坐标y', 'type' => 'text', 'name' => 'pos_y'],
                'duration' =>['lable' => '持续时间戳', 'type' => 'text', 'name' => 'duration'],
                'hits' =>['lable' => '点击次数', 'type' => 'text', 'name' => 'hits'],
                'wifi_only' =>['lable' => '是否允许3G', 'type' => 'text', 'name' => 'wifi_only'],
                'url' =>['lable' => '视频播放地址', 'type' => 'text', 'name' => 'url']
            ];   

        echo json_encode($param[4]);
        exit;

    }
}
