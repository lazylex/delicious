<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Recipe */

$this->title = 'Обновить рецепт: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => ' \\ Рецепты \\ ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name . ' \\ ', 'url' => ['view', 'id' => $model->recipe_id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="recipe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
