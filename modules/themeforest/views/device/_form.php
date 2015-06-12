<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Device */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-body pan">
<div class="device-form">

    <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [],
                    'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

    <?= $form->field($model, 'ei')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'software')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'hardware')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'mac')->textInput() ?>

    <?= $form->field($model, 'imei')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'sn')->textInput(['maxlength' => 300]) ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <div class="form-group">
         <div class="col-md-offset-3 col-md-9">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>