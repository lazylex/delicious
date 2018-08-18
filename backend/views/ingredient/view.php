<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Ingredient */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ingredients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ingredient_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ingredient_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ingredient_id',
            'name',
            'calories',
            'unit_id',
        ],
    ]) ?>

</div>
