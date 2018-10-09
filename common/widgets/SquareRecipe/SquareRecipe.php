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

    public function init()
    {
        parent::init();
        $model = Recipe::findOne($this->id);
        if ($model == null)
            return;
        $this->name = $model->name;
        $this->calories = $model->calories;
        $this->portions = $model->portions;
        $this->calories_per_portion = $model->calories_per_portion;
        $this->ingredients = $model->ingredients0;

    }

    public function run()
    {
        echo "<div style='height: 100px; width: 100px'>";
        echo Html::a($this->name, Url::to(['recipe/view', 'id' => $this->id]));
        //echo "name: {$this->name}, calories: {$this->calories}, calories per portion: {$this->calories_per_portion}, portions: {$this->portions}<br>";
        //Debug::display($this->ingredients);
        foreach ($this->ingredients as $key => $ingredient) {
            //echo $key;
            // Debug::display($ingredient);

            echo $ingredient['name'] . ' ' . $ingredient['calories'] . ' ' . Ingredients::findOne(['ingredient_id' => $ingredient['ingredient_id'], 'recipe_id' => $this->id])['count'] . '<br>';
        }
        echo "</div>";
    }
}