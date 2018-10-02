<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 28.09.2018
 * Time: 9:24
 */

namespace common\widgets\IngredientsTable;


use common\components\Debug;
use yii\bootstrap\Widget;
use common\components\ConverterUtil;

class IngredientsTable extends Widget
{
    public $ingredients;

    public function init()
    {
        parent::init();

    }

    function cmp($a, $b)
    {
        if ($a['count'] == $b['count']) {
            return 0;
        }
        return ($a['count'] > $b['count']) ? -1 : 1;
    }


    public function run()
    {
        echo "<div class='card border-success mb-3' style='max-width: 25rem;'>
                <div class='card-header'>Ингредиенты";

        if (count($this->ingredients) == 0) {
            echo "<strong> отсутствуют</strong>.<br>Вероятно в рецепте содержится ошибка</div>";
            return;
        }

        uasort($this->ingredients, function ($a, $b) {
            if ($a['calories'] == $b['calories']) {
                return 0;
            }
            return ($a['calories'] < $b['calories']) ? -1 : 1;
        });
        //ksort();
        echo "</div>
                    <div class='card-body' style='padding: 0'>";

        echo "<table class='table table-hover' style='margin-bottom: 0'>  
                <thead style='color: white; background: black'>
                    <tr>
                        <th scope='col'>Название</th>
                        <th scope='col'>Количество</th>
                        <th scope='col'>Килокалорий</th>
                    </tr>
                </thead>";
        $sum_cal = 0;
        foreach ($this->ingredients as $ingredient) {
            $count = rtrim(rtrim($ingredient['count'], '0'), '.');
            $cc = $ingredient['calories'] * $ingredient['count'];
            $sum_cal += $cc;
            $color = ConverterUtil::CaloriesToColor($ingredient['calories']);
            $darkestColor=ConverterUtil::darkestColor($color);
            /* Очень калорийные продукты выведутся на красных кнопках, лучше им поставить светлый цвет текста*/
            $ingredient['calories'] > 5 ? $text_color = 'white;' : $text_color = 'black';
            //$text_color=ConverterUtil::darkestColor($color);

            echo "<tr style='color: {$text_color}; background: {$color}' onmouseout='this.style.background=\"{$color}\";' onmouseover='this.style.background= \"{$darkestColor}\";'>";
            echo "<td>{$ingredient['name']}:</td>";
            echo "<td style='text-align: center'><strong>{$count}</strong> {$ingredient['unit']}</td>";
            echo "<td style='text-align: center'>{$cc}</td>";
            echo "</tr>";

        }
        echo "<tr class='table-dark'><td colspan='2' align='right'><i>Калорийность блюда: </i></td><td align='center'><i><strong>{$sum_cal}</strong></i></td></tr>";
        echo "</table>";
        echo "</div></div>";
    }
}