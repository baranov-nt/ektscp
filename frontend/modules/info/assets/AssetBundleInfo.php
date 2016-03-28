<?php
namespace frontend\modules\info\assets;

use yii\web\AssetBundle;

class AssetBundleInfo extends AssetBundle
{
    public $sourcePath = '@frontend/modules/info/assets';

    public $css = [
        'css/info.css',
        'css/info-media.css',
        'css/slick.css',
        'css/slick-theme.css',
        'css/authorities.css',
        'css/terminals.css',
    ];

    public $js = [
        'js/info.js',
        'js/slick.js',
    ];
	
    public $images = [
        'images/',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
