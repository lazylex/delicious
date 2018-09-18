<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 27.07.2018
 * Time: 11:56
 */

namespace frontend\controllers;

use backend\models\Category;
use backend\models\Holidays;
use backend\models\Ingredient;
use backend\models\Ingredients;
use backend\models\IngredientSearch;
use backend\models\ProductCategory;
use backend\models\Recipe;
use backend\models\Unit;
use common\components\Debug;
use yii\web\Controller;
use Yii;
use \common\components\ConverterUtil;

class RecipeController extends Controller
{
    public function actionAdd()
    {
        $this->layout = 'add';
        $category = Category::find()->select(['name', 'category_id'])->orderBy('category_id');
        $holidays = new Holidays();
        $ingredient = Ingredient::find()->asArray()->orderBy('name')->all();
        $model = new Recipe();
        $prod_cat = ProductCategory::find()->asArray()->all();
        $unit_array = Unit::find()->asArray()->all();
        foreach ($unit_array as $unit_item) {
            $unit[$unit_item['unit_id']] = ConverterUtil::UnitToString($unit_item['name'], 1, false);
        }
        if (isset($_POST['ingredient']) && $model->load(Yii::$app->request->post()) && $model->save()) {
            $ingredient = $_POST['ingredient'];

            foreach ($ingredient as $ing_id => $count) {
                $ing = new Ingredients();
                $ing->recipe_id = $model->recipe_id;
                $ing->ingredient_id = $ing_id;
                $ing->count = $count;
                if ($ing->validate())
                {
                    $ing->save();
                }
                else
                {
                    $recipe = Recipe::findOne($model->recipe_id);
                    $recipe->delete();
                    Yii::$app->session->setFlash('danger','При сохранении произошла ошибка! Рецепт не сохранен.');
                    return $this->render('add', compact('model', 'category', 'holidays', 'ingredient', 'prod_cat', 'unit'));
                }
            }
            Yii::$app->session->setFlash('success','Рецепт успешно добавлен!');
            return $this->redirect(['index']);
        }
        return $this->render('add', compact('model', 'category', 'holidays', 'ingredient', 'prod_cat', 'unit'));
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}