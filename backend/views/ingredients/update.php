<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Ingredients */

$this->title = 'Update Ingredients: ' . $model->recipe_id;
$this->params['breadcrumbs'][] = ['label' => 'Ingredients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recipe_id, 'url' => ['view', 'recipe_id' => $model->recipe_id, 'ingredient_id' => $model->ingredient_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ingredients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
