<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ApkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apk-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'package') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'user_id') ?>
    <?= $form->field($model, 'sign') ?>

    <?php // echo $form->field($model, 'version_name') ?>

    <?php // echo $form->field($model, 'version_code') ?>

    <?php // echo $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'platform') ?>

    <?php // echo $form->field($model, 'is_system') ?>

    <?php // echo $form->field($model, 'release_note') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
