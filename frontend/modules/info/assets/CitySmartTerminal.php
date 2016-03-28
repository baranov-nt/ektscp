<?php
namespace frontend\modules\info\assets;

use yii\web\AssetBundle;

class CitySmartTerminal extends AssetBundle
{
    public $sourcePath = '@frontend/modules/info/assets';

    public $css = [
        'css/citysmartterminal.css',
    ];

    public $images = [
        'images/',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}