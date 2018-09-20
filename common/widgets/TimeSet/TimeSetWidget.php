<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 20.09.2018
 * Time: 11:52
 */

namespace common\widgets\TimeSet;


use yii\base\Widget;

class TimeSetWidget extends Widget
{
    public $attribute;
    public $model;
    public $time;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        echo "<div class='row col-6'>";
        echo "<div class='col-4'><input type='number' min='0' max='31' class='form-control' placeholder='дней' title='дней' id='day-set' style='text-align: center'   onchange='{
        document.getElementById(\"time\").value = parseInt(document.getElementById(\"day-set\").value*60*24+ document.getElementById(\"hour-set\").value*60+document.getElementById(\"minute-set\").value, 10);:
        }'></div>";
        echo "<div class='col-4'><input type='number' min='0' max='23' class='form-control' placeholder='часов' title='часов' id='hour-set' style='text-align: center' onchange='{
        document.getElementById(\"time\").value = parseInt(document.getElementById(\"day-set\").value*60*24+ document.getElementById(\"hour-set\").value*60+document.getElementById(\"minute-set\").value, 10);
}'></div>";
        echo "<div class='col-4'><input type='number' min='0' max='59' class='form-control' placeholder='минут' title='минут' id='minute-set'  style='text-align: center'  onchange='{
        document.getElementById(\"time\").value = parseInt(document.getElementById(\"day-set\").value*60*24+ document.getElementById(\"hour-set\").value*60+document.getElementById(\"minute-set\").value, 10);:
        }'></div>";
        echo "</div>";
    }
}