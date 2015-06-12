<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\super\models\Receipt */


$this->params['breadcrumbs'][] = ['label' => 'Receipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="account-view">




    <div class="col-lg-12">
         <div class="note <?=$error?"note-danger":"note-success"?>">
            <h3><?=$error?"错误":"成功"?>信息提示</h3>
           <p><?=$message?></p>
           <p><?=  Html::a("返回上一步",'javascript:history.go(-1)')?></p>
         </div>
    </div>



</div>
