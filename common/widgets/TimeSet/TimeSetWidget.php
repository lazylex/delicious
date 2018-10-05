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
use common\widgets\TimeSet\TimeSetAsset;

class TimeSetWidget extends InputWidget
{
    private $model_name, $daySet, $hourSet, $minuteSet;
    public $view_day=false;

    public function init()
    {
        parent::init();
        TimeSetAsset::register($this->getView());
        $className = explode("\\", get_class($this->model));
        $this->model_name = $className[count($className) - 1];
        $inputName = $className[count($className) - 1] . $this->attribute;
        $this->daySet = 'daySet' . $inputName;
        $this->hourSet = 'hourSet' . $inputName;
        $this->minuteSet = 'minuteSet' . $inputName;
    }

    public function run()
    {
        echo "<input type='hidden' id='{$this->model_name}-{$this->attribute}' name='{$this->model_name}" . "[{$this->attribute}]" . "' value='0'>";
        echo "<div class='row col-6'>";
        if($this->view_day) echo "<div class='col-4'>
                <input type='number' min='0' max='31' class='form-control' placeholder='дней' title='дней' id='{$this->daySet}' style='text-align: center'
                onchange=\"{recountTime('{$this->model_name}-{$this->attribute}','{$this->daySet}','{$this->hourSet}','{$this->minuteSet}');}\">
                </div>";
        echo "<div class='col-4'>
                <input type='number' min='0' max='23' class='form-control' placeholder='часов' title='часов' id='{$this->hourSet}' style='text-align: center' 
                onchange=\"{recountTime('{$this->model_name}-{$this->attribute}', '{$this->daySet}', '{$this->hourSet}', '{$this->minuteSet}');}\">
                </div>";
        echo "<div class='col-4'><input type='number' min='0' max='59' class='form-control' placeholder='минут' title='минут' id='{$this->minuteSet}'  style='text-align: center'  
                onchange=\"{recountTime('{$this->model_name}-{$this->attribute}', '{$this->daySet}', '{$this->hourSet}', '{$this->minuteSet}');}\">
                </div>";
        echo "</div>";
    }
}