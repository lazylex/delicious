<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IngredientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ингредиент';
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->pagination=['pageSize'=>50];
?>
<div class="ingredient-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить ингредиент', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div style="background: lightsteelblue; border: grey solid 1px; padding: 4px; box-shadow: 0 0 5px 2px lightslategrey;">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'ingredient_id', 'headerOptions' => ['width' => 90]],
                'name',
                ['attribute' => 'calories','headerOptions' => ['width' => 90]],
                ['value' =>'unit.name'/*function( $unit) {return \frontend\components\UnitConverter::toString($unit->getUnit(),1,false);}*/, 'label' => 'Единица измерения','headerOptions' => ['width' => 90]],
                ['value' => 'productCategory.name', 'label' => 'Категория продукта'],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
