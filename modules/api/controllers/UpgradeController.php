<?php
/**
 * Created by PhpStorm.
 * User: kint
 * Date: 15/2/5
 * Time: 下午5:12
 */
namespace app\modules\api\controllers;

use app\models\FileModel;
use app\models\Upgrade;
use app\models\UpgradeLog;
use app\models\Version;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Yii;

class UpgradeController extends ApiController
{

    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $ver = \Yii::$app->request->get('version');
        $sn = \Yii::$app->request->get('sn');
        $user = \Yii::$app->request->get('user');
        if (empty($ver)) {
            return ['code' => -1, 'message' => "version is empty"];
        }
        if (empty($sn)) {
            return ['code' => -1, 'message' => "sn is empty"];
        }
        $verModel = Version::find()->where(['name' => $ver])->one();
        if (!$verModel) {
            return ['code' => -2, 'message' => "invalid version name"];
        }


        $upModel = Upgrade::find()->where(['from' => $verModel->id])->one();

        //Start write log....
        $log = new UpgradeLog();
        $log->sn = $sn;
        $log->ip = Yii::$app->request->userIP;
        $log->user = $user;
        if (!$upModel) {

            $log->from = $ver;
            $data = ['code' => 1, 'message' => "no update"];
        }
        else{
            $log->from = $upModel->fromVer->name;
            $log->to = $upModel->toVer->name;
            $data = [
                'code' => 0,
                'message' => 'new version',
                'old_version' => $upModel->fromVer->name,
                'version' => $upModel->toVer->name,
                'type' => $upModel->type,
                'url' => $upModel->fileModel->url,
                'md5' => $upModel->fileModel->md5,
                'description' => $upModel->toVer->log
            ];
        }



        $log->save();

//        $file = $this->findModel($upModel->file);


        return $data;
    }

    protected function findModel($id)
    {
        if (($model = FileModel::findOne($id)) !== null) {
            return $model;
        } else {

            throw new NotFoundHttpException('The requested page does not exist.', -4);
        }
    }
}