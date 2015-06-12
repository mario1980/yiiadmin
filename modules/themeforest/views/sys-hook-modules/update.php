<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysHookModules */

$this->title = 'Update Sys Hook Modules: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sys Hook Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="col-lg-12">
    <div class="portlet box">




        <div class="panel panel-blue">
            <div class="panel-heading">更新数据</div>

            <div class="form-body pal">
                <?= $this->render('_form', [
                'model' => $model,
                ]) ?>

            </div>

        </div>



    </div>
</div>
