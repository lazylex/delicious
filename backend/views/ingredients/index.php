<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IngredientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingredients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredients-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ingredients', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' =>
                    'recipe_id',
                    'value'=>'recipe.name',
                    'label'=>'Название рецепта'
            ],
            ['attribute' =>'ingredient_id',
                'value'=>'ingredient.name',
                'label'=>'Название ингредиента'
            ],
            'count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
