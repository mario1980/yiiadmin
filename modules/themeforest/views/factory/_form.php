<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Factory */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-body pan">
<div class="factory-form">

    <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [],
                    'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

    <?= $form->field($model, 'total')->textInput() ?>



    <?= $form->field($model, 'key')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'software')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Version::find()->where(['type'=>1])->all(),'id','name')) ?>

    <?= $form->field($model, 'hardware')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Version::find()->where(['type'=>2])->all(),'id','name')) ?>



    <div class="form-group">
         <div class="col-md-offset-3 col-md-9">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>