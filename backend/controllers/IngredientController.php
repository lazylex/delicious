<?php

namespace backend\controllers;

use backend\models\ProductCategory;
use backend\models\Unit;
use Yii;
use backend\models\Ingredient;
use backend\models\IngredientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IngredientController implements the CRUD actions for Ingredient model.
 */
class IngredientController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ingredient models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IngredientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$productCategoryFilter = ProductCategory::find()->select(['name', 'product_category_id'])->indexBy('product_category_id')->column();

        $productCategoryFilter = Yii::$app->cache->getOrSet('productCategoryFilter', function () {
            return ProductCategory::find()->select(['name', 'product_category_id'])->indexBy('product_category_id')->column();
        });

        $unit_filter = Yii::$app->cache->getOrSet('unit_filter', function () {
            return Unit::find()->select(['name', 'unit_id'])->indexBy('unit_id')->column();
        });

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'productCategoryFilter' => $productCategoryFilter,
            'unit_filter' => $unit_filter,
        ]);
    }

    /**
     * Displays a single Ingredient model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Ingredient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ingredient();
        //$unit = Unit::find()->all();
        //$prod_cat = ProductCategory::find()->all();

        $unit = Yii::$app->cache->getOrSet('unit', function () {
            return Unit::find()->all();
        });

        $prod_cat = Yii::$app->cache->getOrSet('prod_cat', function () {
            return ProductCategory::find()->all();
        });

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ingredient_id]);
        }

        return $this->render('create', [
            'model' => $model, 'unit' => $unit, 'prod_cat' => $prod_cat,
        ]);
    }

    /**
     * Updates an existing Ingredient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$unit = Unit::find()->all();
        $unit = Yii::$app->cache->getOrSet('unit', function () {
            return Unit::find()->all();
        });
        //$prod_cat = ProductCategory::find()->all();

        $prod_cat = Yii::$app->cache->getOrSet('prod_cat', function () {
            return ProductCategory::find()->all();
        });

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ingredient_id]);
        }

        return $this->render('update', [
            'model' => $model, 'unit' => $unit, 'prod_cat' => $prod_cat,
        ]);
    }

    /**
     * Deletes an existing Ingredient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ingredient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ingredient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ingredient::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
