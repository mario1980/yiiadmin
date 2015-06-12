<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SysHooks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sys Hooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-hooks-view">

    <div class="col-lg-12">
        <div class="portlet box">

            <div class="panel">
                <div class="panel-heading">数据查看</div>

                <div class="form-body pal">
                    <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                                'id',
            'name',
            'title',
            'description:ntext',
            'type',
            'updated',
            'modules',
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
