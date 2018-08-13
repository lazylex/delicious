<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Holidays */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Holidays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="holidays-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->holiday_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->holiday_id], [
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
            'holiday_id',
            'date',
            'name',
        ],
    ]) ?>

</div>
