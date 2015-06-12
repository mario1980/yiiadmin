<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SysHookModules */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sys Hook Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-hook-modules-view">

    <div class="col-lg-12">
        <div class="portlet box">

            <div class="panel">
                <div class="panel-heading">数据查看</div>

                <div class="form-body pal">
                    <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                                'id',
            'hook_id',
            'module_id',
            'market_id',
            'store_id',
            'config:ntext',
                    ],
                    ]) ?>
                    <p>
                        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('删除', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                        'confirm' => '确定要删除么?',
                        'method' => 'post',
                        ],
                        ]) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>



</div>






</div>
