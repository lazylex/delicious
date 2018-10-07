<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 27.07.2018
 * Time: 11:54
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \common\components\ConverterUtil;
use \common\widgets\TimeSet\TimeSetWidget;

$this->title = "Добавить рецепт";
$this->params['breadcrumbs'][] = ' \\ ' . $this->title;
?>
<!-- // https://bootswatch.com/materia/ -->

<div class="content-form form-group">


    <?php $form = ActiveForm::begin([
        'id' => 'recipe-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => '{input}<span style="color: orangered">{error}</span>',
        ],
    ]); ?>

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

    /* Заполняю массив кнопками добавления в рецепт ингредиентов */
    foreach ($ingredient as $ing_item) {

        $nice_name = str_replace(' ', ' ', $ing_item['name']);
        $color = ConverterUtil::CaloriesToColor($ing_item['calories']);

        /* Очень калорийные продукты выведутся на красных кнопках, лучше им поставить светлый цвет текста*/
        $ing_item['calories'] > 5 ? $but_text_color = 'white;' : $but_text_color = 'black';
        $unit_str = $unit[$ing_item['unit_id']];
        $buttonsByCategory[$ing_item['product_category_id']][] = "
        <li id=ing_but_{$ing_item['ingredient_id']} class='list-group-item d-flex justify-content-between align-items-center list-group-item-can-change-back'
            onClick=addIngredient('{$ing_item['ingredient_id']}','ing_but_{$ing_item['ingredient_id']}','{$nice_name}','{$color}','{$unit_str}','{$ing_item['calories']}')
            style='cursor: pointer;'>
        <strong>" . mb_strtoupper($ing_item['name'], "UTF-8") . "</strong>

        <span class='badge badge-primary badge-pill' style='background: {$color}; color: {$but_text_color}'>" . $ing_item['calories'] . " ккал / " . $unit_str . "</span>
        
        
        </li>";
    }

    /* Извлекаю названия категорий ингредиентов в отдельный массив */
    foreach ($prod_cat as $pc) {
        $product_category_name[$pc['product_category_id']] = $pc['name'];
    }
    ?>

    <div class="row">
        <div class="col-3" style="padding-top: 13px">
            <button class="btn-success btn-num-green" id="btn-num-green1" type="button">
                1
            </button>&nbsp;
            Категория рецепта:
        </div>
        <div class="col-9">
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
                ])->label('Выберите категорию:'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-3" style="padding-top: 13px">
            <button class="btn-success btn-num-green" id="btn-num-green2" type="button">
                2
            </button>&nbsp;
            Праздник:
        </div>
        <div class="col-9">
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
            label('Выберите праздник:'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-3" style="padding-top: 13px">
            <button class="btn-success btn-num-green" id="btn-num-green3" type="button">
                3
            </button>&nbsp;
            Название рецепта:
        </div>
        <div class="col-9">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-3" style="padding-top: 13px">
            <button class="btn-success btn-num-green" id="btn-num-green4" type="button">
                4
            </button>&nbsp;
            Время приготовления:
        </div>
        <div class="col-9" style="padding-left: 0">
            <?= $form->field($model, 'time')->widget(TimeSetWidget::className()) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-3" style="padding-top: 13px">
            <button class="btn-success btn-num-green" id="btn-num-green5" type="button">
                5
            </button>&nbsp;
            Время до полной готовности блюда:
        </div>
        <div class="col-9" style="padding-left: 0">
            <?= $form->field($model, 'full_time')->widget(TimeSetWidget::className(), ['view_day' => 'true']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-3" style="padding-top: 13px">
            <button class="btn-success btn-num-green" id="btn-num-green6" type="button">
                6
            </button>&nbsp;
            Порций:
        </div>
        <div class="" style="padding-left: 15px">
            <?= $form->field($model, 'portions')->textInput(['type'=>'number','class'=>'form-control text-align-center','value'=>1,'min'=>1,'max'=>100]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-3" style="padding-top: 13px">
            <button class="btn-success  btn-num-green" id="btn-num-green7" type="button">
                7
            </button>&nbsp;
            Краткое описание рецепта:
        </div>
        <div class="col-9">
            <?= $form->field($model, 'annotation')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <br>
    <div>
        <button class="btn-success btn-num-green" id="btn-num-green8" type="button">
            8
        </button>&nbsp;
        Ингредиенты:

        <?= $form->field($model, 'calories', ['template' => '{input}{error}'])->hiddenInput(['value' => 0]) ?>
        <div>
            <div>
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
                <button type="button" data-toggle="modal" id="add_button"
                        data-target="#modal_add_ing"
                        style="font-size: large; width: 40px; height: 40px; border-radius: 50%; border: none; background: red; color: white; float: left; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.4); margin-left: 150%"
                >+
                </button>
            </div>
            <div class="modal fade" id="modal_add_ing">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Выберите необходимые ингредиенты:</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="accordion">
                                <?php
                                /* Вывожу кнопки с ингредиентами, используя разбивку по категориям */
                                foreach ($buttonsByCategory as $prod_cat_id => $but_array) {
                                    echo "<h3  class='btn btn-primary btn-lg btn-block'>" . mb_strtoupper($product_category_name[$prod_cat_id], 'UTF-8') . "</h3>";
                                    echo "<ul class='list-group collapse'>";

                                    foreach ($but_array as $buttons)
                                        echo $buttons;
                                    echo "</ul>";
                                }

                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="clearfix"></div>

    <div  style="padding-top: 13px">

        <button class="btn-success  btn-num-green" id="btn-num-green9" type="button">
            9
        </button>&nbsp;
        Полный текст рецепта:

        <div style="padding: 20px; margin-bottom: 20px; margin-top: 20px; background: rgba(255,255,255,0.8); border-radius: 3px; border: lightgrey solid 1px">
            <?= $form->field($model, 'article')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <?= $form->field($model, 'author', ['template' => '{input}'])->hiddenInput(['value' => Yii::$app->user->identity->getId(),/* 'disabled' => 'true'*/]) ?>
    <div class="form-group" style="text-align: right">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
