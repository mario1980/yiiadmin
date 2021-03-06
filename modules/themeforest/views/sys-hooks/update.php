<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysHooks */

$this->title = 'Update Sys Hooks: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sys Hooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
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
