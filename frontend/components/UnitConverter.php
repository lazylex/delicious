<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 14.08.2018
 * Time: 9:45
 */

namespace frontend\components;

use yii\base\Component;

class UnitConverter extends Component
{
    public function toString($unit, $count = 1, $returnWithCount = true)
    {

        $count_result = $returnWithCount ? $count . ' ' : '';

        if (!is_integer($count))
            return '';//реализовать конвертацию для нецелочисленных значений и внести изменение в тип поля в БД. а пока просто вернуть пустое значение
        $isDec = (floor($count / 10) % 10) == 1 ? true : false;
        $lastDigit = $count % 10;

        if (in_array($unit, ['кг', 'г', 'мг'])) {
            $prefix = '';
            if ($unit != 'г')
                $unit == 'кг' ? $prefix = 'кило' : $prefix = 'мили';
            if (in_array($lastDigit, [2, 3, 4]) && !$isDec) {
                return $count_result . $prefix . 'грамма';
            } else
                return $count_result . $prefix . 'грамм';
        }

        if ($unit == 'л') {
            if ($count == 1)
                return $count_result . 'литр';
            if (in_array($lastDigit, [2, 3, 4]) && !$isDec) {
                return $count_result . 'литра';
            } else
                return $count_result . 'литров';
        }

        return '';
    }
}