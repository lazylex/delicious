<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 25.09.2018
 * Time: 12:56
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ' \\ '.$this->title;
?>
<h1><?= $model->name ?></h1>

<h2>category: <?= $category ?></h2>
<?php if($holiday!=null):?>
<h2>holiday: <?= $holiday ?></h2>
<?php endif;?>
<?php \common\components\Debug::display($ingredients)?>
