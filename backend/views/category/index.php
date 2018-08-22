<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'category_id',
            [
                'attribute' => 'parent_id',
                'value' => function ($model) use($dataProvider){
                    $categories_name=[];
                    foreach ($dataProvider->getModels() as $models)
                    {
                        //echo $key;
                        $categories_name[$models['category_id']]=$models['name'];
                    }
                    if ($model->parent_id != null)
                        return $categories_name[$model->parent_id];
                    return '';
                }
            ],
            'name',
            'url:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
