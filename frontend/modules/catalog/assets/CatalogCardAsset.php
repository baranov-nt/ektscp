<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.01.2016
 * Time: 14:37
 */
namespace frontend\modules\catalog\assets;

use yii\web\AssetBundle;

class CatalogCardAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/catalog/assets';

    public $css = [
        'css/catalog-card.css',
        'css/nouislider.tooltips.css',
        'css/nouislider.pips.css',
        'css/nouislider.css',		
    ];

    public $js = [
        'js/catalog-card.js',
        'js/nouislider.js',		
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}