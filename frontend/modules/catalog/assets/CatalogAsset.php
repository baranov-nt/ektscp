<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.01.2016
 * Time: 14:37
 */
namespace frontend\modules\catalog\assets;

use yii\web\AssetBundle;

class CatalogAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/catalog/assets';

    public $css = [
        'css/catalog.css',
    ];

    public $js = [
        'js/catalog.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}