<?php
/* @var $this yii\web\View */
use \yii;

use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
$this->title = $platform."版本打包";
$this->params['breadcrumbs'][] = ['label' => '版本列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<h3 id="overview" class="page-header"><?= $platform ?><small> 版本打包</small><a class="anchorjs-link" href="#overview"><span class="anchorjs-icon"></span></a></h3>

<?=Html::a("下载APP包（打包时间".date("Y-m-d H:i:s",$created)."）",['site/download-package',"platform"=>$platform],[
        "class"=>'btn btn-primary btn-lg btn-block',

    ]
)?>
<?=Html::a("重新打包",['site/pack',"platform"=>$platform,"pack"=>1],[
        "class"=>'btn btn-danger btn-lg btn-block',
        "data-target"=>"#modal",


    ]
)?>
<div class="page-header">
    <h3>APP 包详情</h3>
</div>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?foreach($data as $k=>$v):?>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <?=$k?>
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <ol>
                <?foreach($v as $file):?>



                    <?
                    $f = explode('/',$file);
                    ?>

                    <li><?=end($f)?> </li>
                <?endforeach;?>
                </ol>
            </div>
        </div>
    </div>


<?endforeach;?>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
