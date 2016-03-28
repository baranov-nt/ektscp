<?php
namespace frontend\modules\info\assets;

use yii\web\AssetBundle;

class AdvertisingPlatformAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/info/assets';

    public $css = [
        'css/platform.css',
    ];

    public $js = [
        'js/platform.js'
    ];

    public $images = [
        'images/'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
