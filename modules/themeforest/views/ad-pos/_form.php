<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdPos */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-body pan">
<div class="ad-pos-form">

    <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [],
                    'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'tpl_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\AdTpl::find()->all(),'id','name')) ?>

    <div class="form-group">
         <div class="col-md-offset-3 col-md-9">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>