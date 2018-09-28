<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 28.09.2018
 * Time: 9:24
 */

namespace common\widgets\IngredientsTable;


use yii\bootstrap\Widget;

class IngredientsTable extends Widget
{
    public $ingredients;

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        echo "<div class='card border-dark mb-3' style='max-width: 25rem;'>
                <div class='card-header'>Ингредиенты";

        if(count($this->ingredients)==0)
        {
            echo "<strong> отсутствуют</strong>.<br>Вероятно в рецепте содержится ошибка</div>";
            return;
        }

        echo "</div>
                    <div class='card-body'>";

        echo "<table class='table table-light'>  
                <thead>
                    <tr>
                        <th scope='col'>Название</th>
                        <th scope='col'>Количество</th>
                        <th scope='col'>Килокалорий</th>
                    </tr>
                </thead>";
        foreach ($this->ingredients as $ingredient) {
            $count = rtrim(rtrim($ingredient['count'], '0'), '.');
            $cc = $ingredient['calories'] * $ingredient['count'];
            echo "<tr>";
            echo "<td>{$ingredient['name']}:</td>";
            echo "<td style='text-align: center'><strong>{$count}</strong> {$ingredient['unit']}</td>";
            echo "<td style='text-align: center'>{$cc}</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div></div></div>";
    }
}