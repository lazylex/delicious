<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \common\components\ConverterUtil;

/* @var $this yii\web\View */
/* @var $model backend\models\Ingredient */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ингредиент', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->ingredient_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->ingredient_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данную запись?',
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
            ['attribute' => function ($model) {
                return ConverterUtil::UnitToString($model->unit->name, 1, false);
            },
                'label' => 'Единица измерения'
            ],
            ['attribute' =>'productCategory.name','label' => 'Категория продукта']
            //['label' => 'Категория продукта', 'value' => $prod_cat]
        ],
    ]) ?>

</div>
