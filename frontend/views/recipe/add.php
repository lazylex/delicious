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
use \common\components\ConverterUtil;

$this->title = "Добавить рецепт";
?>


<div class="ingredient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

    /**
     * $prod_cat - массив, содержащий массивы с названиями категорий и их ключами
     * $ingredient - массив ингредиентов
     * $model - модель Recipe
     * $category - выборка имен и ключей категорий рецепта, отсортированная по ключу
     * $holidays - модель Holidays
     * $unit - массив с названиями единиц измерения (индекс массива совпадает с первичным ключем таблицы Unit)
     */

    $cat = Yii::$app->request->post('Category')['category_id'];
    $hol = Yii::$app->request->post('Holidays')['holiday_id'];
    //Debug::display($unit);

    /* Заполняю массив кнопками добавления в рецепт ингредиентов */
    foreach ($ingredient as $ing_item) {

        $nice_name = str_replace(' ', ' ', $ing_item['name']);
        $color = ConverterUtil::CaloriesToColor($ing_item['calories']);

        /* Очень калорийные продукты выведутся на красных кнопках, лучше им поставить светлый цвет текста*/
        $ing_item['calories'] >5 ? $but_text_color = 'color: white;' : $but_text_color = '';
        $unit_str = $unit[$ing_item['unit_id']];
        $buttonsByCategory[$ing_item['product_category_id']][] = "<button 
            type='button'
            style='
            background:{$color};
            {$but_text_color};'

            name='{$nice_name}'
            id=ing_but_{$ing_item['ingredient_id']}
            
            onClick=addIngredient('{$ing_item['ingredient_id']}','ing_but_{$ing_item['ingredient_id']}','{$nice_name}','{$color}','{$unit_str}','{$ing_item['calories']}')
            ><strong>".mb_strtoupper($ing_item['name'],"UTF-8")."</strong>
            </button>";
    }

    //Debug::display($buttonsByCategory);

    /* Извлекаю названия категорий ингредиентов в отдельный массив */
    foreach ($prod_cat as $pc) {
        $product_category_name[$pc['product_category_id']] = $pc['name'];
    }
    ?>

    <div class="row">

        <div class="col-lg-9" >

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

            <?= $form->field($model, 'time')->textInput() ?>

            <?= ''//$form->field($model, 'author', ['template' => '{input}'])->hiddenInput(['value' => Yii::$app->user->identity->getId(),/* 'disabled' => 'true'*/])           ?>

            <?= $form->field($model, 'annotation')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'calories',['template' => '{input}{error}'])->hiddenInput(['value'=>0]) ?>
            <div style="height: 1px; padding: 10px; border-radius: 5px; background:white; visibility: hidden;  box-shadow: 0 0 20px rgba(0,0,0,0.5);  text-align: center"
                 id="added_ing_div">
                <p style="padding-top: 5px"><strong>Необходимые для приготовления ингредиенты:</strong></p>
                <div style="background: #cdc3b7; padding: 0; margin: auto;">
                    <table class="table">
                        <thead style="background: black; color: antiquewhite;">
                        <tr>
                            <th scope="col" style="text-align: center;">Название</th>
                            <th scope="col" style="text-align: center;">Количество</th>
                            <th scope="col" style="text-align: center;">Единица измерения</th>
                            <th scope="col" style="text-align: center;">Килокалорий</th>
                            <th scope="col" style="text-align: center;">Удалить</th>
                        </tr>
                        </thead>
                        <tbody id="added_ing">
                        </tbody>
                    </table>

                </div>


            </div>

            <?= $form->field($model, 'article')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>


        <div class="col-lg-3" id="ing_but_div">

                <div class="accordion">
                <?php
                /* Вывожу кнопки с ингредиентами, используя разбивку по категориям */
                foreach ($buttonsByCategory as $prod_cat_id => $but_array) {
                    $background = 'gray';
                    switch ($product_category_name[$prod_cat_id]) {
                        case 'Зерновые и бобовые':
                            $background = 'lightyellow';
                            break;
                        case 'Мясо (птица и мясопродукты)':
                            $background = 'pink';
                            break;
                        case 'Рыба и морепродукты':
                            $background = 'lightblue';
                            break;
                        case 'Молочные продукты':
                            $background = 'white';
                            break;
                        case 'Яйца':
                            $background = 'antiquewhite';
                            break;
                    }
                    echo "<h3 style='background: {$background}'>".mb_strtoupper($product_category_name[$prod_cat_id],'UTF-8')."</h3>";
                    echo "<div>";

                    foreach ($but_array as $buttons)
                        echo $buttons;
                    echo "</div>";
                }

                ?>

        </div>


    </div>


</div>
