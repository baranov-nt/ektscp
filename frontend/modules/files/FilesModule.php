<?php
namespace frontend\modules\files;

class FilesModule extends \yii\base\Module
{
	public $controllerNamespace = 'frontend\modules\files\controllers';
	
	public $fs;
	
	public function init()
	{
		 parent::init();
	}

	/**
	* Registers the necessary scripts.
	*/
	public function registerScripts()
	{
		/*// Get the url to the module assets
		$assetsUrl = $this->getAssetsUrl();

		// Register the necessary scripts
		$cs = Yii::$app->getClientScript();
		$cs->registerCoreScript('jquery');
		$cs->registerCoreScript('jquery.ui');
		$cs->registerScriptFile($assetsUrl.'/js/wall.js');
		$cs->registerCssFile($assetsUrl.'/css/wall.css');*/
	}
	
	/**
	* Publishes the module assets path.
	* @return string the base URL that contains all published asset files of Rights.
	*/
	/* public function getAssetsUrl()
	{
		if( $this->_assetsUrl===null )
		{
			$assetsPath = Yii::getPathOfAlias('wall.assets');

			// We need to republish the assets if debug mode is enabled.
			if( $this->debug===true )
				$this->_assetsUrl = Yii::$app->getAssetManager()->publish($assetsPath, false, -1, true);
			else
				$this->_assetsUrl = Yii::$app->getAssetManager()->publish($assetsPath);
		}

		return $this->_assetsUrl;
	} */
}
