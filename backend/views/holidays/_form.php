<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Holidays */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="holidays-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row col-lg-5">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-2">
            <?= $form->field($model, 'holiday_id')->textInput() ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-2">
            <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::class, [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
                'options' => ['class' => 'form-control']
            ]) ?>

        </div>
    </div>
    <div class="clearfix"></div>

    <div class="form-group">
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
