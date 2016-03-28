<?php
namespace frontend\components\widgets\assets;

use yii\web\AssetBundle;

class WidgetUploadAsset extends AssetBundle
{
    public $sourcePath = '@frontend/components/widgets/assets';

    public $css = [
        'css/jquery.jcrop.css',
        'css/popup.css',
    ];

    public $js = [
        'js/jcrop/jquery.jcrop.js',	
    ];

    public $images = [
        'images/'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}