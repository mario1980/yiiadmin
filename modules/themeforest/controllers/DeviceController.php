<?php

namespace app\modules\themeforest\controllers;

use Yii;
use app\models\Device;
use app\models\DeviceSearch;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\themeforestColumns;
/**
 * DeviceController implements the CRUD actions for Device model.
 */
class DeviceController extends themeforestController
{
    public $title = "设备管理";
    public $descriptions = "";
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
     * Lists all Device models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->hideAddBtn = true;
        $searchModel = new DeviceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->model = $searchModel;
        $attributeLabels = $searchModel->attributeLabels(); 
        //获取$attributeLabels的变量进行初始化
        $labels = array_fill_keys(array_keys($attributeLabels), []);
        
        /**
         * 自定义列显示规则
         *
        $labels['type']['filterType'] = GridView::FILTER_SELECT2;
        $labels['bank']['filterType'] = GridView::FILTER_SELECT2;
        $labels['money']['pageSummary'] = true;
        $labels['id']['pageSummary'] = "小计";
        $labels['status']['class'] = 'kartik\grid\BooleanColumn';
        $labels['created']['format'] = [
            'date',
            'Y-M-d'
        ];
        */
        
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
     * Displays a single Device model.
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
     * Creates a new Device model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Device();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Device model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Device model.
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
     * Finds the Device model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Device the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Device::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
