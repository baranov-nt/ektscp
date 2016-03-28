<?php
namespace frontend\modules\adv\assets;

use yii\web\AssetBundle;

class AdvAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/adv/assets';

    public $css = [
        'css/style.css',
        'css/style-media.css',
        'css/slick.css',
        'css/slick-theme.css',
    ];

    public $js = [
        'js/index.js',
        'js/slick.js',
    ];

    public $images = [
        'images/'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}