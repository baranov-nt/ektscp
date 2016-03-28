<?php

namespace frontend\modules\terminals\controllers;

use common\models\TTerminalSearch;
use yii;
use yii\web\Controller;
use frontend\models\GCity;
use frontend\models\GalAlbum;
use frontend\models\GalAlbumImages;
use frontend\models\FileImage;
use common\models\GReferens;
use frontend\models\TTerminal;
use frontend\modules\terminals\models\TTerminalAdvBlock;
use frontend\modules\terminals\models\TTerminalServices;
use frontend\modules\terminals\Module;
use frontend\modules\catalog\models\CatalogForm;

class DefaultController extends Controller
{
	public function actionMap($id = 0)
	{
		$cities = GCity::find()->where("id_city IN (SELECT city FROM t_terminal WHERE status = 1 OR is_feature = 1)")->orderBy("name")->all();
		return $this->render('map', ['cities' => $cities, 'type' => $id]);
	}

	public function actionMap2()
	{
		$cities = GCity::find()->where("id_city IN (SELECT city FROM t_terminal WHERE status = 1 OR is_feature = 1)")->orderBy("name")->all();
		return $this->render('map2', ['cities' => $cities]);
	}

	public function actionAdd()
	{
		/* @var $modelTerminalForm TTerminal */
		$modelTerminalForm = new TTerminal();

		if (Yii::$app->request->post()) {

			$transaction = Yii::$app->db->beginTransaction();
			
			$street = $_POST["TTerminal"][street];
			$house = $_POST["TTerminal"][house];
			$housing = $_POST["TTerminal"][housing];

			if($street && !$house && !$housing){
				$address = $street;
			}else if($street && $house && !$housing){
				$address = $street.', '.$house;
			}else if($street && $house && $housing){
				$address = $street.', '.$house.', '.$housing;
			}

			$TerminalModel = new TTerminal();
			$TerminalModel->category_place = $_POST["TTerminal"][category_place];
			$TerminalModel->place = $_POST["TTerminal"][place];
			$TerminalModel->city = $_POST["TTerminal"][city];
			$TerminalModel->address = $address;
			$TerminalModel->passability = $_POST["TTerminal"][passability];
			$TerminalModel->worktime = $_POST["TTerminal"][worktime];

			if($_POST["TTerminal"][internet_give] == 1){
				$TerminalModel->internet_type = $_POST["TTerminal"][internet_type];
				if($_POST["TTerminal"][internet_type] == 1){
					$TerminalModel->internet_price = $_POST["TTerminal"][internet_price];
				}
			}

			if($_POST["TTerminal"][arenda_type] == 0){
				$TerminalModel->arenda_type = $_POST["TTerminal"][arenda_type];
			}else if($_POST["TTerminal"][arenda_type] == 1){
				$TerminalModel->arenda_type = $_POST["TTerminal"][arenda_type];
				$TerminalModel->arenda_price = $_POST["TTerminal"][arenda_price];
			}else if($_POST["TTerminal"][arenda_type] == 2){
				$TerminalModel->arenda_type = $_POST["TTerminal"][arenda_type];
				$TerminalModel->tender_type = $_POST["TTerminal"][tender_type];
				$TerminalModel->tender_start_price = $_POST["TTerminal"][tender_start_price];
				$TerminalModel->tender_url = $_POST["TTerminal"][tender_url];
				$TerminalModel->tender_end_date = $_POST["TTerminal"][tender_end_date];
			}

			if($_POST["TTerminal"][elec_type] == 0){
				$TerminalModel->elec_type = $_POST["TTerminal"][elec_type];
			}else if($_POST["TTerminal"][elec_type] == 1){
				$TerminalModel->elec_type = $_POST["TTerminal"][elec_type];
				$TerminalModel->elec_price = $_POST["TTerminal"][elec_price];
			}

			$TerminalModel->comments = $_POST["TTerminal"][comments];
			$TerminalModel->admin_phone = $_POST["TTerminal"][admin_phone];
			$TerminalModel->admin_email = $_POST["TTerminal"][admin_email];
			$TerminalModel->admin_name = $_POST["TTerminal"][admin_name];
			$TerminalModel->is_feature = true;
			$TerminalModel->is_need_moderate = true;

			$TerminalModel->scenario = 'complite';

			if($TerminalModel->save()){
				if($_POST["TTerminal"][services]){
					$pos = strpos($_POST["TTerminal"][services], ';');
					if($pos === false){
						$TerminalServicesModel = new TTerminalServices();
						$TerminalServicesModel->id_terminal = $TerminalModel->id_terminal;			
						$TerminalServicesModel->id_service = $_POST["TTerminal"][services];	
						if(!$TerminalServicesModel->save()){
							$transaction->rollback();
							$isError = true;
							break;
						}							
					}else{					
						$services = explode(';', $_POST["TTerminal"][services]);
				
						for($i=0;$i<count($services);$i++){
							$TerminalServicesModel = new TTerminalServices();
							$TerminalServicesModel->id_terminal = $TerminalModel->id_terminal;			
							$TerminalServicesModel->id_service = $services[$i];	
							if(!$TerminalServicesModel->save()){
								$transaction->rollback();
								$isError = true;
								break;
							}							
						}						
					}
				}
				
				if(!$isError){
					if($_POST["TTerminal"][blockadv]){
						$pos = strpos($_POST["TTerminal"][blockadv], ';');
						if($pos === false){
							$TerminalAdvBlockModel = new TTerminalAdvBlock();
							$TerminalAdvBlockModel->id_terminal = $TerminalModel->id_terminal;			
							$TerminalAdvBlockModel->id_adv_category = $_POST["TTerminal"][blockadv];	
							$TerminalAdvBlockModel->save();	
							if(!$TerminalAdvBlockModel->save()){
								$transaction->rollback();
								$isError = true;
								break;
							}	
						}else{	
							$blockadv = explode(';', $_POST["TTerminal"][blockadv]);
					
							for($i=0;$i<count($blockadv);$i++){
								$TerminalAdvBlockModel = new TTerminalAdvBlock();
								$TerminalAdvBlockModel->id_terminal = $TerminalModel->id_terminal;			
								$TerminalAdvBlockModel->id_adv_category = $blockadv[$i];	
								$TerminalAdvBlockModel->save();	
								if(!$TerminalAdvBlockModel->save()){
									$transaction->rollback();
									$isError = true;
									break;
								}							
							}						
						}
					}					
				}
				
				if(!$isError){
					if($_POST["TTerminal"][attached]){				
						$GalAlbum = new GalAlbum();
						$GalAlbum->name = 'Альбом терминала: id'.$TerminalModel->id_terminal;			
						$GalAlbum->description = 'Альбом';	
						$GalAlbum->status = true;	
						$GalAlbum->id_terminal = $TerminalModel->id_terminal;	
						
						if($GalAlbum->save()){
							$pos = strpos($_POST["TTerminal"][attached], ';');
							if($pos === false){
								$GalAlbumImage = new GalAlbumImages();
								$GalAlbumImage->id_album = $GalAlbum->id_album;			
								$GalAlbumImage->id_file = $_POST["TTerminal"][attached];	
								$GalAlbumImage->status = true;		
								$GalAlbumImage->created = date("Y-m-d\TH:i:s", time());
								if($GalAlbumImage->save()){
									$FileImage = FileImage::find()->where(['id_file' => $_POST["TTerminal"][attached]])->one();
									$FileImage->is_tmp = 0;
									if(!$FileImage->save()){
										$transaction->rollback();
										$isError = true;
										break;											
									}
								}else{
									$transaction->rollback();
									$isError = true;
									break;
								}								
							}else{	
								$attached = explode(';', $_POST["TTerminal"][attached]);
				
								for($i=0;$i<count($attached);$i++){
									$GalAlbumImage = new GalAlbumImages();
									$GalAlbumImage->id_album = $GalAlbum->id_album;			
									$GalAlbumImage->id_file = $attached[$i];	
									$GalAlbumImage->status = true;	
									$GalAlbumImage->created = date("Y-m-d\TH:i:s", time());									
									if($GalAlbumImage->save()){
										$FileImage = FileImage::find()->where(['id_file' => $attached[$i]])->one();
										$FileImage->is_tmp = 0;
										if(!$FileImage->save()){
											$transaction->rollback();
											$isError = true;
											break;											
										}
									}else{
										$transaction->rollback();
										$isError = true;
										break;
									}										
								}						
							}						
						}else{
							$transaction->rollback();
							$isError = true;
							break;						
						}					
					}
				}
				
				$transaction->commit();
				
				$this->goHome();
			}else{
				$transaction->rollback();
			}
		}

		$category = GReferens::find()->where(["base_ref" => 423])->all();

		$services = GReferens::find()->where(["base_ref" => 419])->all();

		return $this->render('add', ['modelTerminalForm' => $modelTerminalForm, 'category' => $category, 'cities' => $cities, 'services' => $services, 'places' => $places, 'postarray' => $postarray]);
	}

	public function actionGet_terminals_by_city($id) {
		$m_terminals = TTerminal::find()->where("city = :city AND (status = 1 OR is_feature = 1)", [":city" => (int)$id])->orderBy("place")->all();
		$terminals = [];
		foreach($m_terminals as $terminal) {
			if(!$terminal->coordinates) {
				$address = $terminal->city0->region0->country0->name . ', ' . $terminal->city0->name . ', ' . $terminal->address;
				$resp = @file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key=AIzaSyApdy0LERTusT7pyBaK0mZ3K2duBMIp50c');
				if($resp) {
					$address = json_decode($resp);
					if(isset($address->results[0]->geometry)) {
						$terminal->coordinates = $address->results[0]->geometry->location->lat . ', ' . $address->results[0]->geometry->location->lng;
						$terminal->save(false);
					} else continue;
				} else continue;
			}
			$terminals[] = array('id_terminal' => $terminal->id_terminal,
				'coordinates' => $terminal->coordinates,
				'status' => $terminal->status,
				'place' => $terminal->place,
				'address' => $terminal->address,
				'install_date' => $terminal->install_date ? Module::t("terminals.base", "Дата установки:") . ' <strong>' . Yii::$app->params['month'][(int)date('m', strtotime($terminal->install_date))] . ' ' . date('Y', strtotime($terminal->install_date)) . '</strong>' : ''
			);
		}
		print \yii\helpers\Json::encode($terminals);
	}

	public function actionTest()
	{
		return $this->render('_card');
	}

	public function actionFeature()
	{
		$searchModel = new TTerminalSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('feature', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}
}
