<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Apk */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-body pan">
<div class="apk-form">

    <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [],
                    'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>



    <?= $form->field($model, 'name')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\ApkNames::find()->all(),"id",'formatName')) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'DEV' => 'DEV', 'PROD' => 'PROD', ]) ?>





    <?= $form->field($model, 'file')->widget(kartik\widgets\FileInput::classname(), ['options' => ['multiple' => false,],'pluginOptions' => ['allowedPreviewTypes' => [],'showUpload'=>false]]) ?>



    <?= $form->field($model, 'platformArr')->checkboxList(\app\models\Apk::platformOptions()) ?>

    <?= $form->field($model, 'is_system')->dropDownList([ '0' => '不是', '1' => '是']) ?>
    <?= $form->field($model, 'release_note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
         <div class="col-md-offset-3 col-md-9">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>