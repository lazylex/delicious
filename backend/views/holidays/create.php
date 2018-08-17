<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Holidays */

$this->title = 'Добавить праздник';
$this->params['breadcrumbs'][] = ['label' => 'Праздники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="holidays-create">

    <h1 class="text-success"><?= Html::encode($this->title) ?></h1>
    <br>
    <?= $this->render('_formCreate', [
        'model' => $model,
    ]) ?>

</div>
