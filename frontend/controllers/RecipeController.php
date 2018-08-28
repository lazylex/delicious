<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 27.07.2018
 * Time: 11:56
 */
namespace frontend\controllers;

use backend\models\Category;
use backend\models\CategorySearch;
use backend\models\Holidays;
use yii\web\Controller;

class RecipeController extends Controller
{
    public function actionAdd()
    {
        $category= new Category();
        $holidays=new Holidays();

        return $this->render('add',compact('category','holidays'));
    }
}