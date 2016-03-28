<?php

namespace frontend\modules\adv;
use yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\adv\controllers';
	private static $_assetsUrl;

    public function init()
    {
        parent::init();
    }
	
	public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/adv/*'] = [
            'class'          => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'ru-RU',
            'basePath'       => '@app/modules/adv/messages',
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/adv/' . $category, $message, $params, $language);
    }
}
