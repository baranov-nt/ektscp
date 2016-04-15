<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.01.2016
 * Time: 14:37
 */
namespace frontend\modules\bussness\assets;

use yii\web\AssetBundle;

class BussnessAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/bussness/assets';

    public $css = [
        'css/bussness.css',
    ];

    public $js = [
        'js/bussness.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}