<?php
namespace frontend\modules\files\components;
/**
* Wall controller class file.
*
* @author Denis Baklaev
* @copyright Copyright &copy; 2014 Aliscom
*/
$servers = array('', 'fs1');
use Yii;
use yii\web\Controller;
use frontend\modules\files\models\FileImage;
use frontend\modules\files\models\FileDoc;

class FilesController extends Controller
{
	public static function uploadFile($post_file, $type, &$errors, $validates = array(), $processings = array()) {
		set_time_limit(0);
		$errors = array();
		
		if(!$post_file) { $errors['file'] = Yii::t('files', 'Ошибка загрузки файла'); return false; }
		switch($post_file['error']) {
			case UPLOAD_ERR_OK:
				break;
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				$errors['size'] = Yii::t('files', 'Файл слишком большой');
				break;
		}
		if($errors) return false;
		
		$path_info = pathinfo($post_file['name']);
		$name = $path_info['basename'];
		$ext = strtolower($path_info['extension']);
		switch($type) {
			case 1:
				$file = new FileImage;
				$dir = '/files/images';
				if(!in_array(exif_imagetype($post_file['tmp_name']), array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG)))
					$errors['type'] = Yii::t('files', 'Некорректный тип изображения');
				else { $size = getimagesize($post_file['tmp_name']); $file->width = $size[0]; $file->height = $size[1]; }
				break;
			case 2:
				$file = new FileDoc;
				$file->name = $name;
				$file->type = substr($ext, 0, 10);
				$file->is_tmp = 1;
				$dir = '/files/docs';
				if(in_array($ext, array('exe', 'bat', 'cmd')))
					$errors['type'] = Yii::t('files', 'Загрузка исполняемых файлов не допускается');
				break;
		}		
		if($errors) return false;
		
		foreach($validates as $key => $val) {
			switch($key) {
				case 'ext':
					if(!in_array($ext, $val)) $errors['ext'] = Yii::t('files', 'Допускается загрузка файлов только с расширением '.implode(',', $val));
					break;
				case 'imagesize':
					if($size[0] != $val['width'] || $size[1] != $val['height']) $errors['size'] = Yii::t('files', 'Размер изображения должен быть '.$val['width'].'x'.$val['height'].' px');
					break;
			}
		}
		
		$file->user = Yii::$app->user->id > 0 ? Yii::$app->user->id : 1;
		$file->server = 2;
		if(!$errors && $file->save()) {
			$name = substr(md5($path_info['filename']), 0, 8);
			$idstr = str_pad((string)$file->id_file, 7, '0');
			for($i = 0; $i < 7; $i++) { if($i % 3 == 0) $dir .= '/'; $dir .= $idstr[$i]; }
			$path = $dir . '/' . $name . '.' . $ext;
			$i = 1;
			while(file_exists($_SERVER['DOCUMENT_ROOT'].$path)) {
				$path = $dir . '/' . $name . $i . '.' . $ext;
				$i++;
			}
			$file->path = $path;
			$file->md5 = md5_file($post_file['tmp_name']);
			if($file->save()) {
				if(!file_exists($_SERVER['DOCUMENT_ROOT'].$dir)) mkdir($_SERVER['DOCUMENT_ROOT'].$dir, 0777, true);
				if(move_uploaded_file($post_file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$file->path)) {
					foreach($processings as $key => $val) {
						switch($key) {
							case 'imagesize':
								Yii::$app->ih
									->load($_SERVER['DOCUMENT_ROOT'].$file->path)
									->thumb($val['width'], $val['height'])
									->save();
								$size = getimagesize($_SERVER['DOCUMENT_ROOT'].$file->path); $file->width = $size[0]; $file->height = $size[1];
								if(!$file->save()) {
									$errors[] = Yii::t('files', 'Внутренняя ошибка сервера при загрузке файла');
									return false;
								}
								break;
						}
					}
					return $file;
				}
			}
			
			$file->delete();
		}
		if(!$errors) $errors[] = Yii::t('files', 'Внутренняя ошибка сервера при загрузке файла');
		return false;
	}
	
	public static function getFileLink($file, $crop_set = false, $width = false, $height = false, $adaptivethumb = false, $ratio = false) {
		if(is_numeric($file)){
			$id_file = FileImage::findOne($file);
			$crop_sets = json_decode($id_file->crop_sets, true);
			if(!(int)$crop_sets[$crop_set]['h']) break;
			$url = $servers[$id_file->server].'/getimage?path='.urlencode($id_file->path).'&op=crop&cw='.$crop_sets[$crop_set]['w'].'&ch='.$crop_sets[$crop_set]['h'].'&x='.$crop_sets[$crop_set]['x'].'&y='.$crop_sets[$crop_set]['y'];
			if($width) $url .= "&width=$width&height=$height";
			else $url .= "&width=".$crop_sets[$crop_set]['w']."&height=".$crop_sets[$crop_set]['h'];
			if($ratio) $url .= "&ratio=1";
			return $url;
		}
		switch(get_class($file)) {
			case 'app\modules\files\models\FileImage':
				if($crop_set) {
					$crop_sets = json_decode($file->crop_sets, true);
					if(!(int)$crop_sets[$crop_set]['h']) break;
					$url = $servers[$file->server].'/getimage?path='.urlencode($file->path).'&op=crop&cw='.$crop_sets[$crop_set]['w'].'&ch='.$crop_sets[$crop_set]['h'].'&x='.$crop_sets[$crop_set]['x'].'&y='.$crop_sets[$crop_set]['y'];
					if($width) $url .= "&width=$width&height=$height";
					else $url .= "&width=".$crop_sets[$crop_set]['w']."&height=".$crop_sets[$crop_set]['h'];
					if($ratio) $url .= "&ratio=1";
					return $url;
				}
				else if($adaptivethumb) 
					return $servers[$file->server].'/getimage?path='.urlencode($file->path)."&op=adaptivethumb&width=$width&height=$height";
				else if($width || $height)
					return $servers[$file->server].'/getimage?path='.urlencode($file->path)."&op=thumb&width=$width&height=$height";
				break;
			case 'app\modules\files\models\FileDoc':
				return $url = $servers[$file->server].'/getdoc?id_file='.$file->id_file;
				break;
		}
		
		return $servers[$file->server].$file->path;
	}
	
	public static function cropImg($file, $crop_set) {
		try {
			Yii::$app->ih
				->load($_SERVER['DOCUMENT_ROOT'].$file->path)
				->crop($crop_set['w'], $crop_set['h'], $crop_set['x'], $crop_set['y'])
				->save(false, false, 100);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	
	public static function getCropSet($file, $crop_data, $width, $height) {
		$crop_set = array();
		$file->setSize();
		$wp = $file->width / (int)$crop_data['id_file_w'];
		$hp = $file->height / (int)$crop_data['id_file_h'];
		$crop_set['x'] = -1*(int)($crop_data['id_file_x']*$wp);
		$crop_set['y'] = -1*(int)($crop_data['id_file_y']*$hp);
		$crop_set['w'] = (int)($wp * $width);
		$crop_set['h'] = (int)($hp * $height);
		return $crop_set;
	}
}
