<?php
/**
 * AssetBundle.php
 * @author Revin Roman
 * @link https://rmrevin.ru
 */

namespace common\widgets\iGrowl;

use Yii;
/**
 * Class AssetBundle
 * @package rmrevin\yii\fontawesome
 */
class AssetBundle extends \yii\web\AssetBundle
{
    /**
     * @inherit
     */
    public $sourcePath = '@common/widgets/iGrowl';

    /**
     * @inherit
     */
    public $css = [
        'app-igrowl.css',
    ];

    /**
     * @inherit
     */
    public $js = [
        'app-igrowl.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'common\widgets\iGrowl\iGrowlAsset',
    ];
}