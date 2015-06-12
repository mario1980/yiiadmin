<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserCenter */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Centers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-center-view">

    <div class="col-lg-12">
        <div class="portlet box">

            <div class="panel">
                <div class="panel-heading">数据查看</div>

                <div class="form-body pal">
                    <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                                'id',
            'level',
            'username',
            'mobile',
            'password',
            'nickname',
            'email:email',
            'verified_email:email',
            'verified_id',
            'avatar',
            'avatar_md5',
            'ip',
            'inviter',
            'state',
            'city',
            'district',
            'address',
            'created:datetime',
            'updated:datetime',
            'status',
                    ],
                    ]) ?>
                   
                </div>
            </div>
        </div>
    </div>



</div>






</div>
