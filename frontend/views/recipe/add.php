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

$this->title = "Добавить рецепт";
?>


<div class="ingredient-form">

    <?php $form = ActiveForm::begin(); ?>

    <p>1. Выберите категорию рецепта</p>

    <?php $cat = Yii::$app->request->post('Category')['category_id'];
    //\common\components\Debug::display($cat)
    ?>

    <?= $form->field($category, 'category_id')->dropDownList($category->find()->select(['name', 'category_id'])->orderBy('category_id')->column(),
        [
            'options' =>
                [
                     $cat  => [
                        'selected' => true
                    ]
                ]
        ])->label('Выберите категорию'); ?>

    <p>2. Для какого праздника этот рецепт является традиционным:</p>

    <?= $form->field($holidays, 'holiday_id')->dropDownList($holidays->find()->select(['name', 'holiday_id'])->orderBy('holiday_id')->column(), ['prompt' => 'Выберите праздник, если есть подходящий',])->label('Выберите праздник'); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
