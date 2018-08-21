<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 21.08.2018
 * Time: 13:14
 */

namespace common\components;


class Debug
{
    public static function display($object)
    {
        if($object!=null)
        {
            echo '<pre>';
            print_r($object);
            echo '</pre>';
        }
        else
        {
            echo '<span style="color: red;">NULL</span>>';
        }
    }
}