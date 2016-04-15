<?php
namespace common\widgets\ColorPicker;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.04.2016
 * Time: 15:02
 */
class AssetColorPicker extends \yii\web\AssetBundle
{

    /**
     * @inherit
     */
    public $sourcePath = '@bower/bootstrap-colorpicker';

    /**
     * @inherit
     */
    public $css = [
        'dist/css/bootstrap-colorpicker.min.css',
    ];

    /**
     * @inherit
     */
    public $js = [
        'dist/js/bootstrap-colorpicker.min.js',
    ];

    public $images = [
        'dist/img/bootstrap-colorpicker/alpha.png',
        'dist/img/bootstrap-colorpicker/alpha-horizontal.png',
        'dist/img/bootstrap-colorpicker/hue.png',
        'dist/img/bootstrap-colorpicker/hue-horizontal.png',
        'dist/img/bootstrap-colorpicker/saturation.png',
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
		    $('.colorpicker-element').colorpicker({});
		    $('#cp2').colorpicker();
SCRIPT;
        \Yii::$app->view->registerJs($js, \yii\web\View::POS_READY);
        return $this;
    }
}