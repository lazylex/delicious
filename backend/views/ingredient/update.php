<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Ingredient */

$this->title = 'Изменить ингредиент: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => ' \\ Ингредиент', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => ' \\ '.$model->name, 'url' => ['view', 'id' => $model->ingredient_id]];
$this->params['breadcrumbs'][] = ' \\ Изменить';
?>
<div class="ingredient-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'unit'=>$unit, 'prod_cat'=>$prod_cat
    ]) ?>

</div>
