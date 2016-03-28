<?php
namespace frontend\modules\terminals\TerminalsAssets;

use yii\web\AssetBundle;

class TerminalsAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/terminals/TerminalsAssets';

    public $css = [
        'css/terminals.css',
    ];
    public $js = [
        'js/terminals.js'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];	
}
