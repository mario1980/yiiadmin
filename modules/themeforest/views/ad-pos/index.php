<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\super\models\AdPosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ad Pos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-pos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ad Pos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'tpl_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
