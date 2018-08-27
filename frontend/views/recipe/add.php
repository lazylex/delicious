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

$this->title="Добавить рецепт";
?>



<div class="ingredient-form">

    <?php $form = ActiveForm::begin(); ?>

    <p>Выберите категорию рецепта</p>

<?php \common\components\Debug::display($category)?>

    <?php $form->field($category, 'category_id')->dropDownList(ArrayHelper::map($category->find()->all(), 'category_id', 'name'))->label('Выберите категорию'); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
