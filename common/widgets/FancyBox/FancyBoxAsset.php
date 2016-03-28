<?php
namespace common\widgets\FancyBox;
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 03.03.2016
 * Time: 13:45
 */
class FancyBoxAsset extends \yii\web\AssetBundle
{

    /**
     * @inherit
     */
    public $sourcePath = '@bower/fancybox';

    /**
     * @inherit
     */
    public $css = [
        'source/jquery.fancybox.css',
        'source/helpers/jquery.fancybox-buttons.css',
        'source/helpers/jquery.fancybox-thumbs.css',
    ];

    /**
     * @inherit
     */
    public $js = [
        'lib/jquery.mousewheel-3.0.6.pack.js',
        'source/jquery.fancybox.pack.js',
        'source/helpers/jquery.fancybox-buttons.js',
        'source/helpers/jquery.fancybox-media.js',
        'source/helpers/jquery.fancybox-thumbs.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

    public function init()
    {
        $this->registerJs();
        parent::init();
    }

    protected function registerJs()
    {
        $js = <<<SCRIPT
		    $(".fancybox").fancybox();
SCRIPT;
        \Yii::$app->view->registerJs($js, \yii\web\View::POS_READY);
        return $this;
    }
}


