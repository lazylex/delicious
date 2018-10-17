<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Вкусняшки';
?>
<div class="site-index">
    <?php $recipies=\backend\models\Recipe::find()->select('recipe_id')->where(['verified' => '1'])->all();
    foreach ($recipies as $recipe)
    echo \common\widgets\SquareRecipe\SquareRecipe::widget(['id'=>$recipe->recipe_id])
    ?>
    <div style="clear: both"></div>
    <div>Если в ближайшее время намечается праздник, то отобразить соответствующие блюда</div>
    <div>Самые популярные рецепты</div>
    <div>Новые рецепты</div>
    <div>Случайные рецепты</div>
</div>
