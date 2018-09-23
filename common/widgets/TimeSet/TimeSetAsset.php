<?php

namespace common\widgets\TimeSet;

use yii\web\AssetBundle;

class TimeSetAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/TimeSet/assets';

    public $css = [];

    public $js = [
        'js/timeset.js'
    ];

    public $depends = [];
}