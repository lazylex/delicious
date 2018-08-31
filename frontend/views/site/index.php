<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Вкусняшки';
?>
<div class="site-index">
    <?= Html::a('Рецепты', \yii\helpers\Url::to(['/recipe']));?>
</div>
