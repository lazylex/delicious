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

    public function init()
    {
        parent::init();
        SquareRecipeAsset::register($this->getView());
        $model = Recipe::findOne($this->id);
        if ($model == null)
            return;
        $this->name = $model->name;
        $this->calories = rtrim(rtrim($model->calories, '0'), '.');
        $this->portions = $model->portions;
        $this->calories_per_portion = rtrim(rtrim($model->calories_per_portion, '0'), '.');
        $this->annotation = $model->annotation;
        $this->ingredients = $model->ingredients0;
        $unit = Unit::find()->all();
        foreach ($unit as $item) {
            $this->unit[$item->unit_id] = $item->name;
        }
    }

    public function run()
    {
        echo "<div class='srw_main_div' style='background-size: cover; background-image: url(\"https://s1.1zoom.ru/b5050/905/408798-svetik_2560x1600.jpg\")'>";
            echo "<a class='srw_a_header' href='" . Url::to(['recipe/view', 'id' => $this->id]) . "'><div class='srw_header'>" . $this->name . "</div></a>";
            //echo "<img src='https://www.fromrussia.com/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/1/3/134436_2.jpg' class='srw_img' id='srw_img_{$this->id}'>";

            echo "<div style='height: 100px; width: 100%'></div>";
            echo "<div class='srw_annotation' id='srw_annotation_{$this->id}'>{$this->annotation}</div><div class='clearfix'></div>";
            echo "<div style='background: rgba(255,255,255,0.75); width: 100%; height: 112px'>";
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

                echo "<div class='srw_footer'>";

                echo "<span class='badge-pill badge badge-light'>";
                echo $this->portions > 1 ? "Ккал всего " : "Килокалорий: ";
                echo $this->calories;
                echo "</span> ";

                if ($this->portions > 1) {
                    echo "<span class='badge-pill badge badge-light'>";
                    echo "Ккал порция " . $this->calories_per_portion;
                    echo "</span> ";
                    echo "<span class='badge-pill badge badge-light'>";
                    echo 'Порций: ' . $this->portions;
                    echo "</span>";
                }
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
}