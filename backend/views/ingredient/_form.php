<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Ingredient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calories')->textInput() ?>

    <?= $form->field($model, 'unit_id')->dropDownList(ArrayHelper::map($unit, 'unit_id', 'name'))->label('Выберите единицу измерения'); ?>

    <?= $form->field($model, 'product_category_id')->dropDownList(ArrayHelper::map($prod_cat, 'product_category_id', 'name'))->label('Выберите категорию продукта'); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
