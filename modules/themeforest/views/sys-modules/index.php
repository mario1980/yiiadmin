<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\themeforest\models\SysModulesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sys Modules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-modules-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sys Modules', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'class',
            'title',
            'description:ntext',
            // 'status',
            // 'config:ntext',
            // 'author',
            // 'version',
            // 'created',
            // 'has_adminlist',
            // 'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
