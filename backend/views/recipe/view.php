<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Recipe */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Recipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->recipe_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->recipe_id], [
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
            'recipe_id',
            'name',
            'calories',
            'time',
            'holiday_id',
            'author',
            'annotation',
            'article:ntext',
            'category_id',
        ],
    ]) ?>

</div>
