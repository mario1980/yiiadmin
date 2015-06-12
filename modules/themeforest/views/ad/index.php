<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\super\models\AdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ad Contents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-content-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ad Content', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pos_id',
            'title',
            'img',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
