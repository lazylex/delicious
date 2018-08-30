<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 27.07.2018
 * Time: 11:54
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

$this->title = "Добавить рецепт";
?>


<div class="ingredient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $cat = Yii::$app->request->post('Category')['category_id'];
    $hol = Yii::$app->request->post('Holidays')['holiday_id'];
    \common\components\Debug::display($model->recipe_id);
    ?>

    <?= $form->
    field($model, 'category_id')->
    dropDownList($category->column(),
        [
            'options' =>
                [
                    $cat => [
                        'selected' => true
                    ]
                ]
        ])->label('Выберите категорию'); ?>

    <?= $form->
    field($model, 'holiday_id')->
    dropDownList($holidays->find()->select(['name', 'holiday_id'])->orderBy('holiday_id')->
    column(),
        [
            'prompt' => 'Выберите праздник, для которого данное блюдо является традиционным',
            'options' =>
                [
                    $hol => [
                        'selected' => true
                    ]
                ]
        ])->
    label('Выберите праздник'); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php $data = [
        ['id' => 1, 'name' => 'name 1', 'calories' => 14],
        ['id' => 2, 'name' => 'name 2', 'calories' => 11],

        ['id' => 100, 'name' => 'name 100', 'calories' => 13],
    ];

    $provider = new ArrayDataProvider([
        'allModels' => $data,
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'attributes' => ['id', 'name', 'calories'],
        ],
    ]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $provider,
        /*'filterModel' => $searchModel,*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'calories',
            'unit.name',
        ],
    ]);

    ?>

    <?= $form->field($model, 'calories')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= ''//$form->field($model, 'author', ['template' => '{input}'])->hiddenInput(['value' => Yii::$app->user->identity->getId(),/* 'disabled' => 'true'*/]) ?>

    <?= $form->field($model, 'annotation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
