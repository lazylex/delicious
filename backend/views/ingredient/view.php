<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
<?=\frontend\components\UnitConverter::toString(\backend\models\Unit::findOne($model->unit)->name,1,false)?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ingredient_id',
            'name',
            'calories',
            //['attribute' =>'unit.name', 'label'=>'Единица измерения'],
            ['attribute' =>function(){return \frontend\components\UnitConverter::toString(\backend\models\Unit::findOne($model->unit)->name,1,false);}, 'label'=>'Единица измерения'],
        ],
    ]) ?>

</div>
