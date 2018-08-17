<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Holidays */

$this->title = 'Update Holidays: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Праздники', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->holiday_id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="holidays-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
