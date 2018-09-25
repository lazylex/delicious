<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
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
<!--<body style="background: Url('<?php //echo \yii\helpers\Url::to( ['/images/background.svg'])?>') no-repeat">-->
<body style="background: Url('<?= \yii\helpers\Url::to( ['/images/background.jpg'])?>') no-repeat">
<?php $this->beginBody() ?>

<div class="wrap">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: forestgreen">
        <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>"><?= Yii::$app->name ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
                aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= Yii::$app->homeUrl ?>">Домой</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/recipe/search']) ?>">Искать</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/recipe/add']) ?>">Добавить</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/about']) ?>">Справка</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/contact']) ?>">Контакты</a>
                </li>
                <?php if (Yii::$app->user->isGuest) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/signup']) ?>">Зарегистрироваться</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/login']) ?>">Войти</a>
                    </li>
                <?php elseif (Yii::$app->user->identity->username == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/admin']) ?>">Административная
                            панель</a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php if (!Yii::$app->user->isGuest): ?>
                <form class="form-inline my-2 my-lg-0" target="<?= \yii\helpers\Url::to(['/site/logout']) ?>">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit" formmethod="post">Выход
                        (<?= Yii::$app->user->identity->username ?>)
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </nav>

    <div class="col-12 col-lg-8" style=" margin: auto; margin-top: 60px">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>