<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HolidaysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Праздники';
$this->params['breadcrumbs'][] = ' \\ '.$this->title;
?>
<div class="holidays-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить праздник', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'name', 'headerOptions' => ['width' => '70%']],
            ['attribute' => 'date', 'headerOptions' => ['width' => 90]],
            ['attribute' => 'holiday_id', 'headerOptions' => ['width' => 140]],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
