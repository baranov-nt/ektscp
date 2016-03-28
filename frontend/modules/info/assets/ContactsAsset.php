<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.01.2016
 * Time: 10:40
 */

namespace frontend\modules\info\assets;

use yii\web\AssetBundle;

class ContactsAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/info/assets';

    public $css = [
        'css/contacts.css',
    ];

    public $js = [
        'js/contacts.js'
    ];

    public $images = [
        'images/'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
