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
<!-- // https://bootswatch.com/materia/ -->

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
        $ing_item['calories'] > 5 ? $but_text_color = 'color: white;' : $but_text_color = '';
        $unit_str = $unit[$ing_item['unit_id']];
        /* $buttonsByCategory[$ing_item['product_category_id']][] = "<button
             type='button'
             style='
             background:{$color};
             {$but_text_color};'

             name='{$nice_name}'
             id=ing_but_{$ing_item['ingredient_id']}

             onClick=addIngredient('{$ing_item['ingredient_id']}','ing_but_{$ing_item['ingredient_id']}','{$nice_name}','{$color}','{$unit_str}','{$ing_item['calories']}')
             ><strong>".mb_strtoupper($ing_item['name'],"UTF-8")."</strong>
             </button>";*/

        $buttonsByCategory[$ing_item['product_category_id']][] = "
        <li id=ing_but_{$ing_item['ingredient_id']} class='list-group-item d-flex justify-content-between align-items-center list-group-item-can-change-back'
            
            onClick=addIngredient('{$ing_item['ingredient_id']}','ing_but_{$ing_item['ingredient_id']}','{$nice_name}','{$color}','{$unit_str}','{$ing_item['calories']}')
            style='cursor: pointer;'>
        <strong>" . mb_strtoupper($ing_item['name'], "UTF-8") . "</strong>

        <span class='badge badge-primary badge-pill' style='background: {$color}; color: black'>" . $ing_item['calories'] . " ккал / " . $unit_str . "</span>
        
        
        </li>";
    }

    //Debug::display($buttonsByCategory);

    /* Извлекаю названия категорий ингредиентов в отдельный массив */
    foreach ($prod_cat as $pc) {
        $product_category_name[$pc['product_category_id']] = $pc['name'];
    }
    ?>

    <div class="row">

        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card border-dark mb-3">
                <div class="card-header">Информация о рецепте:</div>
                <div class="card-body">
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

                    <?= ''//$form->field($model, 'author', ['template' => '{input}'])->hiddenInput(['value' => Yii::$app->user->identity->getId(),/* 'disabled' => 'true'*/])                    ?>

                    <?= $form->field($model, 'annotation')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="card border-dark mb-3">
                <div class="card-header">Необходимые для приготовления ингредиенты:</div>
                <div class="card-body" style="background: linear-gradient(to top, lightgreen 50px, white 32px)">
                    <?= $form->field($model, 'calories', ['template' => '{input}{error}'])->hiddenInput(['value' => 0]) ?>
                    <table class="table" id="added_ing_div" style="display: none;">
                        <thead>
                        <tr>
                            <th scope="col">Название</th>
                            <th scope="col">Количество</th>
                            <th scope="col">Единица измерения</th>
                            <th scope="col">Килокалорий</th>
                            <th scope="col">Удалить</th>
                        </tr>
                        </thead>
                        <tbody id="added_ing">
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_add_ing"
                            style="font-size: large; width: 56px; height: 56px; border-radius: 50%; float: right"
                            onclick="{document.getElementById('modal_add_ing').style.display='inline';}">+
                    </button>
                    <div class="modal" id="modal_add_ing" role="dialog" tabindex="-1" aria-labelledby="modal_add_ing"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Выберите необходимые ингредиенты:</h5>
                                    <button onclick="{document.getElementById('modal_add_ing').style.display='none';}"
                                            type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="max-height: 550px; overflow: auto">
                                    <div class="accordion">
                                        <?php
                                        /* Вывожу кнопки с ингредиентами, используя разбивку по категориям */
                                        foreach ($buttonsByCategory as $prod_cat_id => $but_array) {
                                            echo "<h3  class='btn btn-primary btn-lg btn-block'>" . mb_strtoupper($product_category_name[$prod_cat_id], 'UTF-8') . "</h3>";
                                            echo "<ul class='list-group'>";

                                            foreach ($but_array as $buttons)
                                                echo $buttons;
                                            echo "</ul>";
                                        }

                                        ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                            onclick="{document.getElementById('modal_add_ing').style.display='none';}">
                                        Закрыть
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card border-dark mb-3">
                <div class="card-header">Рецепт:</div>
                <div style="padding: 20px">
                    <?= $form->field($model, 'article')->textarea(['rows' => 6]) ?>
                </div>
            </div>

        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>


</div>
