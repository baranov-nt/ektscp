<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GoogleMapsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
		'js/gmaps.js',
		'https://maps.googleapis.com/maps/api/js?key=AIzaSyDclF_gvj1cInsMlTxPrUVTLpf8V6l0uAc&signed_in=true&callback=initMap&oe=utf-8',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
