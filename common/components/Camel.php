<?php
/**
 * Created by PhpStorm.
 * User: Lex
 * Date: 25.08.2018
 * Time: 16:41
 */

namespace common\components;


class Camel
{
    static function from_camel_case($input, $glue = '-')
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode($glue, $ret);
    }
}