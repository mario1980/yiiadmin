<?php
/* @var $this yii\web\View */
use \yii;

use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
$this->title = $data[0]->apkName->name;
$this->params['breadcrumbs'][] = ['label' => '版本列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$js = <<<EOF
\$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover()
    $('.collapse').collapse()
})
EOF;
$this->registerJs($js);
?>


<? //=Yii::$app->session['token']; ?>

<h3 id="overview" class="page-header"><?= $data[0]->apkName->name ?><small> 版本历史</small><a class="anchorjs-link" href="#overview"><span class="anchorjs-icon"></span></a></h3>

<? foreach ($data as $k => $v): ?>
    <h5>Version <?=$v->version_name?><a class="anchorjs-link" href="#version"><span class="anchorjs-icon"></span></a></h5>
    <small>发布日期<?=$v->created?></small>
<p><?=$v->release_note?></p>
    <p class="text-left"><?=Html::a('下载', ['site/download', 'id' => $v->id], ['class' => 'btn btn-xs btn-success'])?></p>

<? endforeach; ?>
