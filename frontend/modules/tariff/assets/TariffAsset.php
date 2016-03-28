<?php
namespace frontend\modules\tariff\assets;

use yii\web\AssetBundle;

class TariffAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/tariff/assets';

    public $css = [
        'css/calculator.css',
    ];

    public $js = [
        'js/calculator.js'
    ];

    public $images = [
        'images/'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}