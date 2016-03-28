<?php
namespace frontend\modules\info\assets;

use yii\web\AssetBundle;

class InfoAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/info/assets';

    public $css = [
        'css/business.css',
    ];

    public $js = [
        'js/business.js'
    ];

    public $images = [
        'images/'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}