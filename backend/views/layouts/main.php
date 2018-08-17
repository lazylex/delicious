<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body  style="background: black; background-image: url('http://www.zwalls.ru/pic/201310/1920x1200/zwalls.ru-31235.jpg')"><!-- Плохо так прописывать. Временная мера -->
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Таблицы БД (контент)', 'url' => ['#'], 'items' => [
            ['label' => 'Category', 'url' => '/backend/web/Category'],
            ['label' => 'Recipe', 'url' => '/backend/web/Recipe'],
            ['label' => 'Holidays', 'url' => '/backend/web/holidays'],
            ['label' => 'Unit', 'url' => '/backend/web/Unit'],
            ['label' => 'Ingredient', 'url' => '/backend/web/Ingredient'],
            ['label' => 'Ingredients', 'url' => '/backend/web/Ingredients'],
        ],],
        ['label' => 'Таблицы БД (RBAC)', 'url' => ['#'], 'items' => [
            ['label' => 'User', 'url' => '#'],
            ['label' => 'auth_item', 'url' => '#'],
            ['label' => 'auth_rule', 'url' => '#'],
            ['label' => 'auth_assignment', 'url' => '#'],
            ['label' => 'auth_item_child', 'url' => '#'],
        ],],
        ['label' => 'PHPmyAdmin', 'url' => ['http://localhost/phpmyadmin']],

        ['label' => 'Домой', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выход (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container"  style="background: white;"><!-- Плохо так прописывать. Вынести в CSS. Временная мера -->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
