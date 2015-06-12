<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SysHooks */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-body pan">
<div class="sys-hooks-form">

    <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [],
                    'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'component' => 'Component', 'event' => 'Event', 'module' => 'Module', 'widget' => 'Widget', 'behavior' => 'Behavior', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'updated')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'modules')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
         <div class="col-md-offset-3 col-md-9">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>