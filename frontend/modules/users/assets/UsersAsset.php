<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.01.2016
 * Time: 14:37
 */
namespace frontend\modules\users\assets;

use yii\web\AssetBundle;

class UsersAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/users/assets';

    public $css = [
        'css/users.css',
    ];

    public $js = [
        'js/users.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}