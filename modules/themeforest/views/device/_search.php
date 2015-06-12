<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ei') ?>

    <?= $form->field($model, 'software') ?>

    <?= $form->field($model, 'hardware') ?>

    <?= $form->field($model, 'mac') ?>

    <?php // echo $form->field($model, 'imei') ?>

    <?php // echo $form->field($model, 'sn') ?>

    <?php // echo $form->field($model, 'created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
