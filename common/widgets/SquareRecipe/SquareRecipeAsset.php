<?php
/**
 * Created by PhpStorm.
 * User: Lex
 * Date: 13.10.2018
 * Time: 16:17
 */

namespace common\widgets\SquareRecipe;

use yii\web\AssetBundle;

class SquareRecipeAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/SquareRecipe/assets';

    public $css = ['css/style.css'];

    public $js = [];

    public $depends = [];
}