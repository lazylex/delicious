<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 31.08.2018
 * Time: 10:34
 */

use yii\helpers\Html;

$this->title = 'Все рецепты';
$this->params['breadcrumbs'][] = ' \\ ' . $this->title;
foreach ($recipe as $key => $name) {
    echo "<a href='recipe/view?id={$key}'>{$name}</a><br>";
}
?>