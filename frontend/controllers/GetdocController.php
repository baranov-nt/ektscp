<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\modules\files\models\FileDoc;

class GetdocController extends Controller
{
	public function actionIndex()
	{
		set_time_limit(0);
		$file = FileDoc::findOne((int)$_GET['id_file']);
		if($file) $this->output_file($_SERVER['DOCUMENT_ROOT'].$file->path, $file->name);
	}

	private function output_file($file, $name) 
	{ 
		//do something on download abort/finish 
		//register_shutdown_function( 'function_name'  ); 
		if(!file_exists($file)) 
			die('file not exist!'); 
		$size = filesize($file); 
		$name = rawurldecode($name); 

		if (preg_match('/Opera(\/| )([0-9].[0-9]{1,2})/', $_SERVER['HTTP_USER_AGENT'])) 
			$UserBrowser = "Opera"; 
		elseif (preg_match('/MSIE ([0-9].[0-9]{1,2})/', $_SERVER['HTTP_USER_AGENT'])) 
			$UserBrowser = "IE"; 
		else 
			$UserBrowser = ''; 

		/// important for download im most browser 
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime_type = finfo_file($finfo, $file);
		if(!$mime_type) $mime_type = ($UserBrowser == 'IE' || $UserBrowser == 'Opera') ? 
			'application/octetstream' : 'application/octet-stream'; 
		@ob_end_clean(); /// decrease cpu usage extreme 
		header('Content-Type: ' . $mime_type); 
		header('Content-Disposition: attachment; filename='.str_replace(',', ' ', $name)); 
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		header('Accept-Ranges: bytes'); 
		header("Cache-control: private"); 
		header('Pragma: private'); 

		/////  multipart-download and resume-download 

		if(isset($_SERVER['HTTP_RANGE'])) 
		{ 
			list($a, $range) = explode("=",$_SERVER['HTTP_RANGE']); 
			str_replace($range, "-", $range); 
			$size2 = $size-1; 
			$new_length = $size-$range; 
			header("HTTP/1.1 206 Partial Content"); 
			header("Content-Length: $new_length"); 
			header("Content-Range: bytes $range$size2/$size"); 
		} 
		else 
		{
			$size2=$size-1; 
			header("Content-Length: ".$size); 
		} 
		$chunksize = 1*(1024*1024); 
		$bytes_send = 0; 
		if ($file = fopen($file, 'r')) 
		{
			if(isset($_SERVER['HTTP_RANGE'])) 
				fseek($file, $range); 
			while(!feof($file) and (connection_status()==0)) 
			{ 
				$buffer = fread($file, $chunksize);
				print($buffer);//echo($buffer); // is also possible
				flush();
				$bytes_send += strlen($buffer);
				//sleep(1);//// decrease download speed 
			} 
			fclose($file); 
		} 
		else
			die('error can not open file'); 
		if(isset($new_length)) 
			$size = $new_length; 
		die(); 
	}
}