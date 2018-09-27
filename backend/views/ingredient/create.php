<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Ingredient */

$this->title = 'Добавить ингредиент';
$this->params['breadcrumbs'][] = ['label' => ' \\ Ингредиент', 'url' => ['index']];
$this->params['breadcrumbs'][] = ' \\ '.$this->title;
?>
<div class="ingredient-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'unit'=>$unit, 'prod_cat'=>$prod_cat
    ]) ?>

</div>
