<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

//纯粹为了好看，引入editTable的CSS
\kartik\editable\EditableAsset::register($this);
?>
<?if($this->context->descriptions):?>
<div >
    <div class="note note-success">
        <h4 class="box-heading"><?= $this->context->title ?></h4>

        <p><?= $this->context->descriptions ?></p>
    </div>
</div>
<?endif;?>
<div>

    <?php
    $hideBtn = \yii\helpers\ArrayHelper::getValue($this->context, "hideAddBtn", false);
    $before = $hideBtn ? "" : Html::a('<i class="glyphicon glyphicon-plus"></i> 添加新数据', ['create'], ['class' => 'btn btn-success']);
    ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
        'pjax' => true,
        'floatHeader' => false,
        'hover' => true,
        'pjaxSettings' => [
            'neverTimeout' => true,
        ],
        'showPageSummary' => true,
        'export' => [
            'fontAwesome' => true
        ],
        'exportConfig' => [
            GridView::CSV => [
                'label' => 'CSV',
                'icon' => true ? 'file-code-o' : 'floppy-open',
                'iconOptions' => ['class' => 'text-primary'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => 'grid-export',
                'alertMsg' => 'The CSV export file will be generated for download',
                'options' => ['title' => 'Comma Separated Values'],
                'mime' => 'application/csv',
                'config' => [
                    'colDelimiter' => ",",
                    'rowDelimiter' => "\r\n",
                ]
            ],
            GridView::EXCEL => [
                'label' => 'Excel',
                'icon' => 'file-excel-o',
                'iconOptions' => ['class' => 'text-success'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => 'grid-export',
                'alertMsg' => 'The EXCEL export file will be generated for download.',
                'options' => ['title' => 'Microsoft Excel 95+'],
                'mime' => 'application/vnd.ms-excel',
                'config' => [
                    'worksheet' => 'ExportWorksheet',
                    'cssFile' => ''
                ]
            ],
        ],
        'panel' => [
            //'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h3 class="panel-title"><i class="fa fa-table fa-fw"></i> 数据列表</h3>',
            //'showFooter' => true,
            'before' => $before,
        ],
        'toolbar' => '',
        'beforeTemplate' => '<div class="pull-right">{toolbar}</div>{beforeContent}<div class="clearfix"></div>'
    ]);
    ?>




</div>          

