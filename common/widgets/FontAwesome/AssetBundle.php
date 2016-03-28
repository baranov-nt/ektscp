<?php
/**
 * AssetBundle.php
 * @author Revin Roman
 * @link https://rmrevin.ru
 */

namespace common\widgets\FontAwesome;

/**
 * Class AssetBundle
 * @package rmrevin\yii\fontawesome
 */
class AssetBundle extends \yii\web\AssetBundle
{

    /**
     * @inherit
     */
    public $sourcePath = '@common/widgets/FontAwesome';

    /**
     * @inherit
     */
    public $css = [
        'css/fa.css',
    ];

    public $js = [
        'js/fa.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'common\widgets\FontAwesome\FAAsset',
    ];
}