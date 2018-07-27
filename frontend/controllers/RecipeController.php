<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 27.07.2018
 * Time: 11:56
 */
namespace frontend\controllers;

use yii\web\Controller;

class RecipeController extends Controller
{
    public function actionAdd()
    {
        return $this->render('add');
    }
}