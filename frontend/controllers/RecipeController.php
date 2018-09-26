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
use yii\filters\AccessControl;

class RecipeController extends Controller
{
    public $layout = 'recipe';

    public function actionAdd()
    {
        if (YII::$app->user->identity == null) {
            return $this->redirect(['site/login']);
        }


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
                if ($ing->validate()) {
                    $ing->save();
                } else {
                    $recipe = Recipe::findOne($model->recipe_id);
                    $recipe->delete();
                    Yii::$app->session->setFlash('danger', 'При сохранении произошла ошибка! Рецепт не сохранен.');
                    return $this->render('add', compact('model', 'category', 'holidays', 'ingredient', 'prod_cat', 'unit'));
                }
            }
            Yii::$app->session->setFlash('success', 'Рецепт успешно добавлен!');
            return $this->redirect(['index']);
        }
        return $this->render('add', compact('model', 'category', 'holidays', 'ingredient', 'prod_cat', 'unit'));
    }

    public function actionSearch()
    {
        if (Yii::$app->request->isAjax) {
            $searchString = Yii::$app->request->post('searchString');
            if($searchString==null)
                return false;
            $recipe = Recipe::find()->select(['name','recipe_id'])->where(['like', 'name', $searchString])->all();
            $res='';
            //Debug::display($recipe);
            foreach ($recipe as $item) {
                $res = $res . "<li class='nav-item'><a class='dropdown-item' style='width: 100%' href='/recipe/view?id={$item['recipe_id']}'> {$item['name']}</li>";
            }
            return $res;
        }

        return $this->render('search');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        //$model = $this->findModel($id);
        //Debug::display($model);
        if (!Yii::$app->cache->exists('Recipe_model_' . $id)) {
            $model = $this->findModel($id);

            if($model==null)
            {
                Yii::$app->session->setFlash('danger', 'Запрашиваемы рецепт отсутсвует!');
                return $this->redirect(['index']);
            }

            Yii::$app->cache->set('Recipe_model_' . $id, $model,3600);
        } else
            $model = Yii::$app->cache->get('Recipe_model_' . $id);


        /*
        $ingredient = Ingredient::find()->asArray()->orderBy('name')->all();


        */


        $category=Category::findOne($model->category_id)->name;
        $holiday=Holidays::findOne($model->holiday_id);
        $ingredients=Ingredients::find()->where(['recipe_id'=>$model->recipe_id])->all();
        $unit_array = Unit::find()->asArray()->all();

        if($holiday!=null)
            $holiday=$holiday->name;
        return $this->render('view', [
            'model' => $model, 'category'=>$category, 'holiday'=>$holiday,'unit_array'=>$unit_array,'ingredients'=>$ingredients
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Recipe::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }
}