<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 14.08.2018
 * Time: 9:45
 */

namespace common\components;

use yii\base\Component;

class ConverterUtil extends Component
{
    public function UnitToString($unit, $count = 1, $returnWithCount = true)
    {
        if (!is_numeric($count) || $count <= 0)
            return '';
        if (!is_integer($count))
            $count = rtrim(rtrim($count, '0'), '.');
        $count_result = $returnWithCount ? $count . ' ' : '';

        /* Если число дробное, то не мудрствуя лукаво возвращаем в таком виде:*/
        if (!is_integer($count) && ((int)$count != $count)) {
            switch ($unit) {
                case 'кг':
                    return $count_result . 'килограмма';
                    break;
                case 'г':
                    return $count_result . 'грамма';
                    break;
                case  'мг':
                    return $count_result . 'миллиграмма';
                    break;
                case  'мл':
                    return $count_result . 'миллилитра';
                    break;
                case  'ложка':
                    return $count_result . 'ложки';
                    break;
                case  'чайная ложка':
                    return $count_result . 'чайной ложки';
                    break;
            }
        }
        $isDec = (floor($count / 10) % 10) == 1 ? true : false;
        $lastDigit = $count % 10;

        switch ($unit) {
            case 'кг':
                $prefix = 'кило';
                break;
            case  'мг':
                $prefix = 'милли';
                break;
            case  'мл':
                $prefix = 'милли';
                break;
            case  'чайная ложка':
                $prefix = 'чайн';
                break;
            default:
                $prefix = '';
                break;
        }

        if (in_array($unit, ['кг', 'г', 'мг'])) {
            if (in_array($lastDigit, [2, 3, 4]) && !$isDec) {
                return $count_result . $prefix . 'грамма';
            } else
                return $count_result . $prefix . 'грамм';
        }

        if ($unit == 'л' || $unit == 'мл') {
            if ($count == 1 || (!$isDec && $lastDigit == 1))
                return $count_result . $prefix . 'литр';
            if (in_array($lastDigit, [2, 3, 4]) && !$isDec) {
                return $count_result . $prefix . 'литра';
            } else {
                return $count_result . $prefix . 'литров';
            }
        }

        if ($unit == 'ложка' || $unit == 'чайная ложка') {
            if ($count == 1 || (!$isDec && $lastDigit == 1))
                return $count_result . (empty($prefix) ? $prefix : $prefix . 'ая ') . 'ложка';
            if (in_array($lastDigit, [2, 3, 4]) && !$isDec) {
                return $count_result . (empty($prefix) ? $prefix : $prefix . 'ые ') . 'ложки';
            } else {
                return $count_result . (empty($prefix) ? $prefix : $prefix . 'ых ') . 'ложек';
            }
        }

        if ($unit == 'шт') {
            if (!$isDec && $lastDigit == 1)
                return $count_result . 'штука';
            if ($isDec)
                return $count_result . 'штук';
            if (in_array($lastDigit, [2, 3, 4]))
                return $count_result . 'штуки';
            else
                return $count_result . 'штук';
        }

        return $unit;
    }

    public function CaloriesToColor($calories)
    {
        $cc = [
            '10' => '#FFFFF5',
            '20' => '#F5F3CA',
            '30' => '#F5E8BC',
            '40' => '#f9e491',
            '50' => '#f4d982',
            '60' => '#e9d86c',
            '70' => '#f3d342',
            '80' => '#f0cb35',
            '90' => '#f3cf1f',
            '100' => '#f2ca35',
            '150' => '#faefd9',
            '200' => '#f6e2c7',
            '250' => '#fad9ba',
            '300' => '#f6ca8d',
            '350' => '#dba16f',
            '400' => '#ec9f67',
            '450' => '#f66a1d',
            '500' => '#e47a0c',
            '550' => '#ee3e19',
            '600' => '#eb1900',];
        foreach ($cc as $cal => $color) {
            if ($calories < ($cal / 100))
                return $color;
        }
        return '#eb1900';
    }
}