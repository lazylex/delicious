<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RecipeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recipes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Recipe', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'recipe_id',
            'name',
            'calories',
            'time',
            'holiday_id',
            //'author',
            //'annotation',
            //'article:ntext',
            //'category_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
