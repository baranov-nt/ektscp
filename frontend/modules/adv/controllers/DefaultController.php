<?php

namespace frontend\modules\adv\controllers;

use Yii;
use common\models\TAdv;
use common\models\GReferens;
use frontend\models\BDc;
use frontend\models\GCity;
use frontend\models\GCityArea;
use frontend\models\TTerminal;
use frontend\modules\adv\models\TAdvShedule;
use frontend\modules\files\models\FileDoc;
use frontend\modules\files\models\FileImage;
use yii\base\Exception;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd()
    {
        $modelTAdv = new TAdv();
		$category_place = GReferens::findAll(['base_ref' => 426]);

        if (Yii::$app->request->post()) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
				$city = GCity::find()->where("[name] = :name",
					[
						":name" => $_POST["CatalogForm"]["city"]
					]
				)->one();
				
				$model = new TAdv;
				//Если был выбран город
				if ($city->id_city) $model->id_city = $city->id_city;
				//Если есть файл
				if ($_POST["id_file_image"]) {
					$FileImage = FileImage::findOne(["id_file" => $_POST["id_file_image"]]);
					$model->file = end(explode(".", $FileImage["path"]));
					$model->id_file = $_POST["id_file_image"];
					if ($_POST["atype"] == 5) {
						$model->type = 5;
					} else if ($_POST["atype"]) {
						$model->type = 6;
					}
					$model->type_adv = 1;
					$model->txt = $_POST["text-adv"];
				}
				if ($_POST["id_file_banner"]) {
					$FileImage = FileImage::findOne(["id_file" => $_POST["id_file_banner"]]);
					$model->file = end(explode(".", $FileImage["path"]));
					$model->id_file = $_POST["id_file_banner"];
					$model->type = 7;
					$model->type_adv = 1;
				}
				if ($_POST["id_file_video"]) {
					$FileDoc = FileDoc::findOne(["id_file" => $_POST["id_file_video"]]);
					$model->file = $FileDoc["type"];
					$model->id_file = $_POST["id_file_video"];
					$model->type = 8;
					$model->type_adv = 3;
				}
				$model->user = 100;
				$model->place_type = 4;
				$model->created = date('d-m-Y H:i:s');
				if ($model->save()) {
					/****/
					for($i=0;$i<count($_POST["adv_terminal"]);$i++){

						$new_date = explode(' - ', $_POST["adate"]);
						$s_date = explode('.', $new_date[0]);
						$f_date = explode('.', $new_date[1]);
						$start_date = date('d.m.Y', strtotime($s_date[2].'-'.$s_date[1].'-'.$s_date[0]));
						$finish_date = date('d.m.Y', strtotime($f_date[2].'-'.$f_date[1].'-'.$f_date[0]));

						if ($_POST["atype"] == 5 || $_POST["atype"] == 6) {
							$place = 10;
						} else if ($_POST["atype"] == 7) {
							$place = 3;
						} else if ($_POST["atype"] == 8) {
							$place = 4;
						}
						
						$TAdvShedule = new TAdvShedule;
						$TAdvShedule->startdate = $start_date;
						$TAdvShedule->enddate = $finish_date;
						$TAdvShedule->place = $place;
						$TAdvShedule->status = 0;
						$TAdvShedule->adv = $model->id_adv;
						$TAdvShedule->terminal = $_POST["adv_terminal"][$i];
						if($TAdvShedule->save()){
							$BDc = new BDc;
							$BDc->user_debet = 888;
							$BDc->user_credit = 100;
							$BDc->create = date('d-m-Y H:i:s');
							$BDc->sum = 3900;
							$BDc->id_advshedule = $TAdvShedule->id_advshedule;
							$BDc->status = 0;
							if ($BDc->save()) {
								$transaction->commit();
								return $this->goHome();
							}
						}
					}
				}
			} catch (Exception $e) {
				$transaction->rollBack();
			}
        }

        return $this->render(
            'add',
            [
                'modelTAdv' => $modelTAdv,
				'category_place' => $category_place
            ]
        );
    }
	
	/*Ajax запросы*/
	public function actionTerminalarea()
	{
		if ($_POST['id_city']) {
			// Районы
			$GCityArea = GCityArea::find()->where(['city' => $_POST['id_city'], 'to_moderate' => false])->orderBy('name ASC')->all();
			$array_city_area = array();
			foreach($GCityArea as $key => $value) {
				$array_city_area[$key]['id_ca'] = $value['id_ca'];
				$array_city_area[$key]['name'] = $value['name'];
			}
			print json_encode(array("result" => true, "city_area" => $array_city_area));
		} else {
			print json_encode(array("result" => false, "error" => "id_city - пустое"));
		}
	}
	
	public function actionChangeformat()
	{
		if($_POST['action']) {
			$modelTAdv = new TAdv();
			print $this->renderPartial($_POST['action'],['modelTAdv' => $modelTAdv]);
		}
	}
	
	public function actionGetterminal()
	{
		if ($_POST['id_city']) {
			$city_area = '';$css = '';$cst = '';$csp = '';$category_place = '';$type = '';
			$work_array = array();
			$type_array = array();
			
			if (isset($_POST['districts'])) $city_area = ' AND city_area IN ('.implode(',', $_POST['districts']).')';
			if (isset($_POST['places'])) $category_place = ' AND category_place IN ('.implode(',', $_POST['places']).')';
			if ($_POST['work_time_12'] == 'true') {
				$work_array[] = 12;
			}
			if ($_POST['work_time_24'] == 'true') {
				$work_array[] = 24;
			}
			if ($_POST['css'] == 'true' || $_POST['cst'] == 'true') {
				$work = ' AND worktime IN ('.implode(',', $work_array).')';
			}
			
			if ($_POST['css'] == 'true') {
				$GReferens = GReferens::findOne(['name' => 'CSS']);
				$type_array[] = $GReferens->id_ref;
			}
			if ($_POST['cst'] == 'true') {
				$GReferens = GReferens::findOne(['name' => 'CST']);
				$type_array[] = $GReferens->id_ref;
			}
			if ($_POST['csp'] == 'true') {
				$GReferens = GReferens::findOne(['name' => 'CSP']);
				$type_array[] = $GReferens->id_ref;
			}
			if ($_POST['css'] == 'true' || $_POST['cst'] == 'true' || $_POST['csp'] == 'true') {
				$type = ' AND type IN ('.implode(',', $type_array).')';
			}
			
			$sql = 'city = '.$_POST['id_city'].$city_area.$type.$category_place;

			$TTerminal = TTerminal::find()->where($sql)->orderBy('id_terminal ASC')->all();
			
			$array_terminal = array();
			foreach($TTerminal as $key => $value) {
				$GReferensPlace = GReferens::findOne(['id_ref' => $value['category_place']]);
				$GReferensType = GReferens::findOne(['id_ref' => $value['type']]);
				
				$array_terminal[$key]['id_terminal'] = $value['id_terminal'];
				$array_terminal[$key]['place'] = $GReferensPlace->name;
				$array_terminal[$key]['name'] = $value['place'];
				$array_terminal[$key]['address'] = $value['address'];
				$array_terminal[$key]['worktime'] = $value['worktime'];
				$array_terminal[$key]['num'] = '';
				$array_terminal[$key]['platforma'] = $GReferensType->name.'('.$value['diag'].'&#34;)';
				$array_terminal[$key]['price'] = '';
			}
			print json_encode(array("result" => true, "array_terminal" => $array_terminal));
		} else {
			print json_encode(array("result" => false, "error" => "Районы пустой массив!"));
		}
	}
	
	public function actionGetdate()
	{
		if ($_POST) {
			print json_encode(array("result" => true, "date" => date("d.m.Y", strtotime($_POST['date']) + $_POST['date_time'])));
		} else {
			print json_encode(array("result" => false, "error" => "POST пустой!"));
		}
	}
}
