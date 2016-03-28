<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.02.2016
 * Time: 11:55
 */

namespace common\widgets\FlagIconCss;

/**
 * Class AssetBundle
 * @package rmrevin\yii\fontawesome
 */
class FlagsAsset extends \yii\web\AssetBundle
{

    /**
     * @inherit
     */
    public $sourcePath = '@bower/flag-icon-css';

    /**
     * @inherit
     */
    public $css = [
        'css/flag-icon.css',
    ];
    public $images = [
        'flags/',
    ];

}