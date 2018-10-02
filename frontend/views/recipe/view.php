<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 25.09.2018
 * Time: 12:56
 */
use \common\widgets\IngredientsTable\IngredientsTable;


$this->title = $model->name;

?>
<div class="content-form form-group">
<h1><?= $model->name ?></h1>

<h2>Категория: <?= $category ?></h2>
<?php if($holiday!=null):?>
<h2>Праздник: <?= $holiday ?></h2>
<?php endif;?>
<?php //\common\components\Debug::display($ingredients)?>


<?= IngredientsTable::widget(['ingredients'=>$ingredients]);?>
<h2> Килокалорий: <?= $model->calories ?></h2>

<?= $model->article ?>
</div>