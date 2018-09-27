<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \common\components\ConverterUtil;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IngredientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ингредиент';
$this->params['breadcrumbs'][] = ' \\ '.$this->title;

$dataProvider->pagination = ['pageSize' => 20];

/*
if(!isset($unit_filter))
$unit_filter = [];
if(empty($unit_filter))
foreach ($dataProvider->getModels() as $models) {
    $unit_filter[$models['unit']['unit_id']] = UnitConverter::toString($models['unit']['name'], 1, false);
}*/

foreach ($unit_filter as &$unit_item)
        $unit_item = ConverterUtil::UnitToString($unit_item, 1, false);

//\common\components\Debug::display($unit_name);
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

                'name',
                ['attribute' => 'calories', 'headerOptions' => ['width' => 90]],
                ['attribute' => 'unit_id',
                    'value' => function ($model) {
                        return ConverterUtil::UnitToString($model->unit->name, 1, false);
                    },

                    'filter' => $unit_filter,
                ],

                ['attribute' => 'product_category_id',
                    'value' => 'productCategory.name',

                    'filter' =>$productCategoryFilter,// \backend\models\ProductCategory::find()->select(['name', 'product_category_id'])->indexBy('product_category_id')->column(),
                ],
                ['attribute' => 'ingredient_id', /*'headerOptions' => ['width' => 90]*/],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
