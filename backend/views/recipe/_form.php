<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Recipe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recipe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calories')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'holiday_id')->textInput() ?>

    <?= $form->field($model, 'author')->textInput() ?>

    <?= $form->field($model, 'annotation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
