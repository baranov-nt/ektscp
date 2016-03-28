<?php
namespace frontend\modules\info\assets;

use yii\web\AssetBundle;

class MobileAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/info/assets';

    public $css = [
        'css/mobile.css',
    ];

    public $js = [
        'js/mobile.js'
    ];

    public $images = [
        'images/'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
