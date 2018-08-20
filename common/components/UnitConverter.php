<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 14.08.2018
 * Time: 9:45
 */

namespace common\components;

use yii\base\Component;

class UnitConverter extends Component
{
    public function toString($unit, $count = 1, $returnWithCount = true)
    {
        if (!is_numeric($count) || $count <= 0)
            return '';
        $count_result = $returnWithCount ? $count . ' ' : '';

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

        return $unit;
    }
}