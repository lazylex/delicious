<?php
/**
 * Created by PhpStorm.
 * User: Anonimus
 * Date: 20.09.2018
 * Time: 11:52
 */

namespace common\widgets\TimeSet;


use common\components\Debug;
use yii\base\Widget;
use yii\bootstrap\InputWidget;

class TimeSetWidget extends InputWidget
{
    private $input_name;
    public function init()
    {
        parent::init();
        $className=explode("\\",get_class($this->model));
        $this->input_name=$className[count($className)-1]."[{$this->attribute}]";
    }

    public function run()
    {



        echo "<input type='hidden' id='{$this->input_name}' name='$this->input_name' value='0'>";
        echo "<div class='row col-6'>";
        echo "<div class='col-4'><input type='number' min='0' max='31' class='form-control' placeholder='дней' title='дней' id='day-set' style='text-align: center'   onchange='{
        document.getElementById(\"{$this->input_name}\").value = parseInt(document.getElementById(\"day-set\").value*60*24+ document.getElementById(\"hour-set\").value*60+document.getElementById(\"minute-set\").value, 10);:
        }'></div>";
        echo "<div class='col-4'><input type='number' min='0' max='23' class='form-control' placeholder='часов' title='часов' id='hour-set' style='text-align: center' onchange='{
        document.getElementById(\"{$this->input_name}\").value = parseInt(document.getElementById(\"day-set\").value*60*24+ document.getElementById(\"hour-set\").value*60+document.getElementById(\"minute-set\").value, 10);
}'></div>";
        echo "<div class='col-4'><input type='number' min='0' max='59' class='form-control' placeholder='минут' title='минут' id='minute-set'  style='text-align: center'  onchange='{
        document.getElementById(\"{$this->input_name}\").value = parseInt(document.getElementById(\"day-set\").value*60*24+ document.getElementById(\"hour-set\").value*60+document.getElementById(\"minute-set\").value, 10);:
        }'></div>";
        echo "</div>";
    }
}