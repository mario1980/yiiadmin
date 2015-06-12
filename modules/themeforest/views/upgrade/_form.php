<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Upgrade */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-body pan">
<div class="upgrade-form">

    <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [],
                    'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>


    <?= $form->field($model, 'from')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Version::find()->where(['type'=>1])->all(),'id','name')) ?>
    <?= $form->field($model, 'to')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Version::find()->where(['type'=>1])->all(),'id','name')) ?>


    <?= $form->field($model, 'file')->widget(kartik\widgets\FileInput::classname(), ['options' => ['multiple' => false,],'pluginOptions' => ['allowedPreviewTypes' => []]]) ?>

    <?= $form->field($model, 'status')->dropDownList(["停用","启用"]) ?>
    <?= $form->field($model, 'type')->dropDownList(["手动升级","自动升级","强制升级"]) ?>

    <div class="form-group">
         <div class="col-md-offset-3 col-md-9">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>