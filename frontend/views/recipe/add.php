<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 27.07.2018
 * Time: 11:54
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use \common\components\Debug;

$this->title = "Добавить рецепт";
?>


<div class="ingredient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

    $cat = Yii::$app->request->post('Category')['category_id'];
    $hol = Yii::$app->request->post('Holidays')['holiday_id'];
    Debug::display($_POST);

    foreach ($ingredient as $ing_item) {

        $nice_name = str_replace(' ', ' ', $ing_item['name']);
        $color = \common\components\ConverterUtil::CaloriesToColor($ing_item['calories']);

        echo "<button 
            type='button'
            style='background: {$color}'
            name='{$nice_name}'
            id=ing_but_{$ing_item['ingredient_id']}
            onClick=addIngredient('{$ing_item['ingredient_id']}','ing_but_{$ing_item['ingredient_id']}','{$nice_name}','{$color}')
            >{$ing_item['name']}
            </button>";
    }

    ?>
    <br><br>
    <div style="background:gray; margin: auto; width: 90%; visibility: hidden; border-radius: 15px; border: black solid 1px; text-align: center"
         id="added_ing_div">
        <p style="color: yellow; padding-top: 5px">Необходимые для приготовления ингредиенты:</p>
        <div style="background: #cdc3b7; padding: 0; margin: auto;">
            <table class="table table-striped table-bordered">
                <thead style="background: black; color: antiquewhite">
                <tr>
                    <th scope="col">Количество</th>
                    <th scope="col">Название</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="added_ing">
                </tbody>
            </table>
        </div>
    </div>

    <?= $form->
    field($model, 'category_id')->
    dropDownList($category->column(),
        [
            'options' =>
                [
                    $cat => [
                        'selected' => true
                    ]
                ]
        ])->label('Выберите категорию'); ?>

    <?= $form->
    field($model, 'holiday_id')->
    dropDownList($holidays->find()->select(['name', 'holiday_id'])->orderBy('holiday_id')->
    column(),
        [
            'prompt' => 'Выберите праздник, для которого данное блюдо является традиционным',
            'options' =>
                [
                    $hol => [
                        'selected' => true
                    ]
                ]
        ])->
    label('Выберите праздник'); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'calories')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= ''//$form->field($model, 'author', ['template' => '{input}'])->hiddenInput(['value' => Yii::$app->user->identity->getId(),/* 'disabled' => 'true'*/])    ?>

    <?= $form->field($model, 'annotation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
