<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 09.10.2018
 * Time: 8:07
 */

namespace common\widgets\SquareRecipe;


use backend\models\Ingredients;
use backend\models\Recipe;
use backend\models\Unit;
use common\components\ConverterUtil;
use common\components\Debug;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class SquareRecipe extends Widget
{
    public $id;
    private $name;
    private $calories;
    private $portions;
    private $calories_per_portion;
    private $ingredients = [];
    private $unit;
    private $annotation;
    private $img_url;

    public function init()
    {
        parent::init();
        $bundle = SquareRecipeAsset::register($this->getView());
        $model = Recipe::findOne($this->id);
        if ($model == null)
            return;
        $this->name = $model->name;
        $this->calories = rtrim(rtrim($model->calories, '0'), '.');
        $this->portions = $model->portions;
        $this->calories_per_portion = rtrim(rtrim($model->calories_per_portion, '0'), '.');
        $this->annotation = $model->annotation;
        $this->ingredients = $model->ingredients0;
        $this->img_url = $model->img_url;
        if (is_null($this->img_url)||$this->img_url=='')
            $this->img_url = $bundle->baseUrl . '/images/ratatui.png';
        $unit = Unit::find()->all();
        foreach ($unit as $item) {
            $this->unit[$item->unit_id] = $item->name;
        }

    }

    public function run()
    {

        echo "<div class='srw_main_div' style='background-size: cover; background-image: url({$this->img_url})'>";
        echo "<a class='srw_a_header' href='" . Url::to(['recipe/view', 'id' => $this->id]) . "'><div class='srw_header'>" . $this->name . "</div></a>";
        //echo "<images src='https://www.fromrussia.com/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/1/3/134436_2.jpg' class='srw_img' id='srw_img_{$this->id}'>";

        echo "<div id='srw_dummy_div_{$this->id}' class='srw_dummy_div'></div>";
        echo "<div id='srw_annotation_{$this->id}' class='srw_annotation' >{$this->annotation}</div><div class='clearfix'></div>";
        echo "<div id='srw_ing_div_{$this->id}' class='srw_ing_div' style='position: absolute'>";
        //echo "name: {$this->name}, calories: {$this->calories}, calories per portion: {$this->calories_per_portion}, portions: {$this->portions}<br>";
        //Debug::display($this->ingredients);
        echo "<table class='srw_table' id='srw_table_{$this->id}'><thead><th>Название</th><th>Количество</th></thead>";
        foreach ($this->ingredients as $key => $ingredient) {
            //echo $key;
            //Debug::display();
            echo "<tr>";
            echo "<td>{$ingredient['name']}</td>";
            echo "<td><i>" . ConverterUtil::UnitToString($this->unit[$ingredient->unit_id], Ingredients::findOne(['ingredient_id' => $ingredient['ingredient_id'], 'recipe_id' => $this->id])['count'], true) . "</i></td>";

            //echo $ingredient['name'] . ' ' . $ingredient['calories'] . ' ' . Ingredients::findOne(['ingredient_id' => $ingredient['ingredient_id'], 'recipe_id' => $this->id])['count'] . '<br>';
            echo "</tr>";
        }
        echo "</table>";
        if (count($this->ingredients) > 3) {
            $hidden_ing = ' + ' . (count($this->ingredients) - 3).' ';
            echo "<span id='srw_hidden_ing_{$this->id}' class='srw_hidden_ing'>" . $hidden_ing . "</span>";

        }
        if (count($this->ingredients) > 10) {
            $hidden_ing = ' + ' . (count($this->ingredients) - 10).' ';
            echo "<span id='srw_hidden_ing_full_{$this->id}' class='srw_hidden_ing srw_invisible'>" . $hidden_ing . "</span>";
        }
        echo "</div>";
        echo "<div class='srw_footer'>";

        echo "<span class='srw_badge'>";
        echo $this->portions > 1 ? "Ккал всего: " : "Килокалорий: ";
        echo $this->calories;
        echo "</span> ";

        if ($this->portions > 1) {
            if (is_numeric($this->calories_per_portion)) {
                echo "<span class='srw_badge'>";
                echo "Ккал порция: " . $this->calories_per_portion;
                echo "</span> ";
            }
            echo "<span class='srw_badge'>";
            echo 'Порций: ' . $this->portions;
            echo "</span>";
        }
        echo "</div>";
        echo "</div>";
    }
}