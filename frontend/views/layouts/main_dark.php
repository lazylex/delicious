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
    <div style="width: 100%; height: 100%; background: rgba(100,100,100,0.5 )">
    <div class="wrap">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background: forestgreen; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
            <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>"><i class="glyphicon glyphicon-cutlery"></i><?= ' '.Yii::$app->name ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
                    aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= Yii::$app->homeUrl ?>"><i class="glyphicon glyphicon-home"></i> Домой</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/recipe']) ?>"><i class="glyphicon glyphicon-cutlery"></i> Рецепты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/about']) ?>"><i class="glyphicon glyphicon-info-sign"></i> Справка</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/contact']) ?>"><i class="glyphicon glyphicon-phone-alt"></i> Контакты</a>
                    </li>
                    <?php if (Yii::$app->user->isGuest) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/signup']) ?>"><i class="glyphicon glyphicon-user"></i> Зарегистрироваться</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/login']) ?>"><i class="glyphicon glyphicon-log-in"></i> Войти</a>
                        </li>
                    <?php elseif (Yii::$app->user->identity->username == 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/admin']) ?>"><i class="glyphicon glyphicon-cog"></i> Административная
                                панель</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <div style="position: relative; width: 250px; margin-right: 15px">
                    <input class="mr-sm-2" style="width: 100%; padding: 5px" type="text" placeholder="Поиск" id="searchInput"
                           onkeyup="
                       if(document.getElementById('searchInput').value.length<3)
                           document.getElementById('searchResult').style.display='none';
                       else
                       $.ajax({
                            url:'recipe/search',
                            type: 'POST',
                            data:
                            {
                                searchString:document.getElementById('searchInput').value
                            },
                            success: function (res) {
                                //var ul=document.createElement('ul');
                                //ul.innerHTML=res;
                                if(res.toString().length<10)
                                    return false;
                                document.getElementById('searchResult').innerHTML=res;
                                $('#searchResult').fadeIn(300);

                                //alert(res);
                            },
                            error: function(){
                                //alert('Error!');
                            }
                        }


                        );
                   return false;"

                           onfocusout="$('#searchResult').fadeOut(1000);"
                    >
                    <ul class="nav nav-pills flex-column" id="searchResult" style="position: absolute; background: white; width: 120%; border: lightgrey solid 1px; border-radius: 3px; margin: 5px; display: none"></ul>
                </div>

                <?php if (!Yii::$app->user->isGuest): ?>
                    <form class="form-inline my-2 my-lg-0" target="<?= \yii\helpers\Url::to(['/site/logout']) ?>">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit" formmethod="post"><i class="glyphicon glyphicon-log-out"></i> Выход
                            (<?= Yii::$app->user->identity->username ?>)
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </nav>

        <div class="col-12 col-lg-8" style=" margin: auto; margin-top: 60px">
            <?= Breadcrumbs::widget(
                    [
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>