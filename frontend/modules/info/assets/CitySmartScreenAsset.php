<?php
namespace frontend\modules\info\assets;

use yii\web\AssetBundle;

class CitySmartScreenAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/info/assets';

    public $css = [
        'css/citysmartscreen.css',		
    ];
	
    public $images = [
        'images/',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
