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
use backend\models\IngredientSearch;
use backend\models\ProductCategory;
use backend\models\Recipe;
use common\components\Debug;
use yii\web\Controller;
use Yii;

class RecipeController extends Controller
{
    public function actionAdd()
    {
        $this->layout='add';
        //$category = new Category();
        $category = Category::find()->select(['name', 'category_id'])->orderBy('category_id');
        $holidays = new Holidays();
        $ingredient = Ingredient::find()->asArray()->orderBy('name')->all();
        $model = new Recipe();
        $prod_cat=ProductCategory::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /*return $this->redirect(['view', 'id' => $model->ingredient_id]);*/
            //Debug::display($model->recipe_id);

        }

        return $this->render('add', compact('model', 'category', 'holidays', 'ingredient','prod_cat'));
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}