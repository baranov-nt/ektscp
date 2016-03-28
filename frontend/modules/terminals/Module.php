<?php

namespace frontend\modules\terminals;
use yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\terminals\controllers';
	private static $_assetsUrl;
	
    public function init()
    {
        parent::init();
		$this->registerTranslations();
        // custom initialization code goes here
		Yii::$app->view->registerJsFile(self::getAssetsUrl() . '/js/terminals.js', ['depends' => ['yii\web\JqueryAsset']]);
		Yii::$app->view->registerCssFile(self::getAssetsUrl() . '/css/terminals.css');
    }
	
	public static function getAssetsUrl()
    {
		if(self::$_assetsUrl === null)
		{
			$assets = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets';
			self::$_assetsUrl = Yii::$app->getAssetManager()->publish($assets, ['forceCopy' => YII_DEBUG]);
		}
			
		return self::$_assetsUrl[1];
    }
	
	public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/terminals/*'] = [
            'class'          => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'ru-RU',
            'basePath'       => '@app/modules/terminals/messages',
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/terminals/' . $category, $message, $params, $language);
    }
}
