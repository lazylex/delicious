<?php

/* @var $this yii\web\View */

$this->title = 'Административный раздел';
?>
<div class="site-index">

    <div class="row">

        <div class="col-lg-6">
            <div style="background: #cdc3b7; padding: 0; margin: 0; width: 90%">
                <table class="table table-striped table-bordered">
                    <thead style="background: black; color: antiquewhite">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Таблица</th>
                        <th scope="col">Количество записей</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><a style="color: black" href=" <?= \yii\helpers\Url::to(['/holidays'])?>">Праздники (Holidays)</a></td>
                        <td><?= \backend\models\Holidays::find()->count() ?></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><a style="color: black" href=" <?= \yii\helpers\Url::to(['/unit'])?>">Единицы измерения (Unit)</a></td>
                        <td><?= \backend\models\Unit::find()->count() ?></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td><a style="color: black" href=" <?= \yii\helpers\Url::to(['/ingredient'])?>">Ингредиент (Ingredient)</a></td>
                        <td><?= \backend\models\Ingredient::find()->count() ?></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td><a style="color: black" href=" <?= \yii\helpers\Url::to(['/product-category'])?>">Категория продукта (ProductCategory)</a></td>
                        <td><?= \backend\models\ProductCategory::find()->count() ?></td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td><a style="color: black" href=" <?= \yii\helpers\Url::to(['/category'])?>">Категории и подкатегории (Category)</a></td>
                        <td><?= \backend\models\Category::find()->count() ?></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <p><a class="btn btn-lg btn-success" href="https://yiiframework.com.ua/ru/doc/guide/2/" target="_blank">Yii2
                    Framework полное руководство</a></p>
            <p><a class="btn btn-lg btn-success" href="https://bootstrap-4.ru/docs/4.1/getting-started/introduction/"
                  target="_blank">Bootstrap документация на русском языке</a></p>
            <p><a class="btn btn-lg btn-warning"
                  href="http://127.0.0.1/phpmyadmin/db_structure.php?server=1&db=delicious"
                  target="_blank">Просмотр БД в PHPmyAdmin</a></p>
            <p><a class="btn btn-lg btn-danger" href="http://delicious/backend/web/gii" target="_blank">GII</a></p>
        </div>
    </div>
</div>
