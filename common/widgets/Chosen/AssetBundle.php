<?php
/**
 * AssetBundle.php
 * @author Revin Roman
 * @link https://rmrevin.ru
 */

namespace common\widgets\Chosen;

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
    public $sourcePath = '@common/widgets/Chosen';

    public $js = [
        'pjax.js'
    ];

    public $depends = [
        'common\widgets\Chosen\ChosenAsset',
    ];
}