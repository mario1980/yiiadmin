<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SysModules */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-body pan">
<div class="sys-modules-form">

    <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [],
                    'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'class')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'config')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'version')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'created')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'has_adminlist')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <div class="form-group">
         <div class="col-md-offset-3 col-md-9">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>