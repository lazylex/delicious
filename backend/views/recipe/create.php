<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Recipe */

$this->title = 'Создать рецепт';
$this->params['breadcrumbs'][] = ['label' => ' \\ Рецепты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ' \\ ' . $this->title;
?>
<div class="recipe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
