<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdContent */

$this->title = $this->context->title;
$this->params['breadcrumbs'][] = ['label' => 'Ad Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="portlet box">
        <div class="panel">
            <div class="panel-heading">选择广告位</div>
            <div class="form-body pal">
                <div class="panel-body pan">
                    <div class="ad-content-form">

                        <?php $form = ActiveForm::begin([
                            'layout' => 'horizontal',
                            'fieldConfig' => [],
                            'options' => ['enctype' => 'multipart/form-data'],
                        ]); ?>



                        <?= $form->field($model, 'pos_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\AdPos::find()->all(),'id','name')) ?>



                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>

            </div>

        </div>



    </div>
</div>
