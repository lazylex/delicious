<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Запрос на сброс пароля';
$this->params['breadcrumbs'][] = ' \\ '.$this->title;
?>
<div class="jumbotron card border-primary mb-3 white-half-window">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, введите свой почтовый ящик. На него будет отправлена ссылка для сброса пароля.</p>

            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>

</div>
