<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdContent */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-body pan">
    <div class="ad-content-form">

        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [],
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

        <?= $form->field($model, 'pos_id')->textInput(['readonly' => true]) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

        <?php $pluginOptions = $model->isNewRecord ? [] : ["initialPreview" => [
            "<img src='/file/show?id=$model->img' class='file-preview-image' alt='Desert' title='Desert'>",

        ],];?>
        <?= $form->field($model, 'img')->widget(kartik\widgets\FileInput::classname(), ['options' => ['multiple' => false,]
            , 'pluginOptions' => $pluginOptions,
        ]) ?>
        <?
        foreach (json_decode($model->tpl->param) as $k => $v):?>
            <div class="form-group field-adcontent-img has-success">
                <label class="control-label col-sm-3" for="adcontent-img"><?= $v->lable ?></label>

                <div class="col-sm-6">
                    <input type="text" id="adcontent-img" class="form-control" name="ext[<?= $v->name ?>]"
                           maxlength="128" value="<?=unserialize($model->ext)[$v->name]?>">

                    <div class="help-block help-block-error "></div>
                </div>

            </div>
        <? endforeach; ?>



        <div class="form-group">
            <div class="col-md-offset-3 col-md-9">
                <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>