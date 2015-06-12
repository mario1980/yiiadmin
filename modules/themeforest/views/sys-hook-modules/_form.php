<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SysHookModules */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-body pan">
<div class="sys-hook-modules-form">

    <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [],
                    'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

    <?= $form->field($model, 'hook_id')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'module_id')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'market_id')->textInput() ?>

    <?= $form->field($model, 'store_id')->textInput() ?>

    <?= $form->field($model, 'config')->textarea(['rows' => 6]) ?>

    <div class="form-group">
         <div class="col-md-offset-3 col-md-9">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>