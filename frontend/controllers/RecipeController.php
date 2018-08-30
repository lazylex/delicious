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
use backend\models\Recipe;
use yii\web\Controller;

class RecipeController extends Controller
{
    public function actionAdd()
    {
        //$category = new Category();
        $category = Category::find()->select(['name', 'category_id'])->orderBy('category_id');
        $holidays = new Holidays();
        $model = new Recipe();
        return $this->render('add', compact('model', 'category', 'holidays'));
    }
}