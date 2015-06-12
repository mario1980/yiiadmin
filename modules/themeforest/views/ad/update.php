<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdContent */

$this->title = 'Update Ad Content: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ad Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
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
