<?php
namespace frontend\modules\files\controllers;

use Yii;
use yii\web\Controller;
use frontend\modules\files\models\FileVideo;

class DefaultController extends Controller
{
	public function actionAddvideo()
	{
		$video = new FileVideo;
		if($video->initVideo($_POST['url'])) {
			if($video->save()) {
				print json_encode(array("id_file" => $video->id_file, "preview" => $video->getPreview()));
			} else print_r($video->getErrors());//print json_encode(array("error" => Yii::t('genral', 'Внутренняя ошибка сервера')));
		}
		else print json_encode(array("error" => Yii::t('files', 'Некорректная ссылка на видео')));
	}
	
	public function actionGetplayer()
	{
		$video = FileVideo::getByPk($_POST['id_file']);
		print json_encode($video->getPlayer());
	}
}