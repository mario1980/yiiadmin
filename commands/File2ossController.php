<?php

namespace app\commands;

use yii\console\Controller;
use app\models\OssModel;
use app\components\Oss;
use app\components\Curl;
use Yii;

class File2ossController extends Controller
{

    public function actionIndex()
    {
        $files = OssModel::find()->where(['aliyun' => null])->all();

        foreach ($files as $file) {
            $this->out("开始上传" . $file->name);
            $key = substr($file->md5,0,3) . "-" . $file->name;
            $key = empty($file->tag) ? $key : $file->tag . "/" . $key;
            Oss::upload($key, $file->filename);

            $file->aliyun = Oss::getUrl($key);

            $this->out("上传完成" . $file->aliyun);
            $this->out("正在检查...");
            $this->out(exec("curl -I " . $file->aliyun));
            $rst = $file->save(false);
            if ($rst) Yii::info($file->filename . " 上传到oss操作成功", 'custom/success');
            else Yii::info($file->filename . " 上传到oss操作失败", 'custom/fail');
        }
    }

    private function out($str)
    {
        echo $str . "\n";
    }


}