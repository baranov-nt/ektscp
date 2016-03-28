<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class GetimageController extends Controller
{
	public function actionIndex()
	{
		switch($_GET['op']) {
			case 'crop':
				if($_GET['x'] || $_GET['y']) {
					Yii::$app->ih
						->load($_SERVER['DOCUMENT_ROOT'].$_GET['path'])
						->crop($_GET['cw'], $_GET['ch'], $_GET['x'], $_GET['y'])
						->resize($_GET['width'], $_GET['height'], $_GET['ratio'] == 1 ? true : false)
						->show();
				} else {
					Yii::$app->ih
						->load($_SERVER['DOCUMENT_ROOT'].$_GET['path'])
						->crop($_GET['cw'], $_GET['ch'], 0, 0)
						->resize($_GET['width'], $_GET['height'])
						->show();
				}
				break;
			case 'thumb':
				Yii::$app->ih
					->load($_SERVER['DOCUMENT_ROOT'].$_GET['path'])
					->thumb($_GET['width'] ? $_GET['width'] : false, $_GET['height'] ? $_GET['height'] : false)
					->show();
				break;
			case 'adaptivethumb':
				Yii::$app->ih
					->load($_SERVER['DOCUMENT_ROOT'].$_GET['path'])
					->adaptiveThumb($_GET['width'], $_GET['height'])
					->show();
				break;
			default:
				Yii::$app->ih
					->load($_SERVER['DOCUMENT_ROOT'].$_GET['path'])
					->show();
				break;
		}
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}