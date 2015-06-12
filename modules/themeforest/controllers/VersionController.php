<?php

namespace app\modules\themeforest\controllers;

use Yii;
use app\models\Version;
use app\models\VersionSearch;
use app\modules\themeforest\controllers\themeforestController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\themeforestColumns;
/**
 * VersionController implements the CRUD actions for Version model.
 */
class VersionController extends themeforestController
{
    public $title = "版本管理";
    public $descriptions = "
    <b>软件版本号规则：WA1-1.0-1.0.0.20140509</b>
    <p>第一段方案类型如A31为A1之后的A80为A2，第二段硬件关联改动版本，目前第一版为1，第二版如果修改wifi则为2，后面修改过Nand为3，如果修改了个摄像头，但是驱动没做任何更改，则不用重新编号。第三段基于Android 4.2的第一版本我们编号为1.0.0，BUG Fix的为1.0.1驱动等得新功能更新为1.1.0使用第二位如果是操作系统级或者是ROM重构类型的则从2.0.0开始</p>
    <p><b>硬件版本号规则：WA1-1.1.0-1.0.2</b></p>
    <p>第一段为产品类型,W为微孝宝平板,S机顶盒方案类型如A31为A1之后的A80为A2。第二段第一位为大的ID改变，导致的重新画板，这个数字重置之后，后面所有位数都被重置。第二位为主板PCB，主板PCB改变为2第三位为其他附属PCB的改变。第三段其他PCB物料BOM改变，原则风险搞得放在前面，风险低的放在后面。</p>

    ";
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
     * Lists all Version models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VersionSearch();
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
     * Displays a single Version model.
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
     * Creates a new Version model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Version();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Version model.
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
     * Deletes an existing Version model.
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
     * Finds the Version model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Version the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Version::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
