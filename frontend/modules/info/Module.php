<?php

namespace frontend\modules\info;
use yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\info\controllers';
	private static $_assetsUrl;

    public function init()
    {
        parent::init();
    }
}
