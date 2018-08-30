<?php
use \yii\helpers\Url;
use \yii\helpers\Inflector;
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
                    <?php $row_number = 0;
                    foreach ($tableItemCount as $key => $count):?>
                        <tr>
                            <th scope="row"><?php $row_number++;
                                echo $row_number ?></th>
                            <td><a style="color: black"
                                   href=" <?= Url::to(['/' .Inflector::camel2id($key)]) ?>"><?= $key ?></a>
                            </td>
                            <td><?= $count ?></td>
                        </tr>
                    <?php endforeach; ?>

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
