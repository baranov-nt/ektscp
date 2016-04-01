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
				/*
					Типы медиа;
					5 - готовые шаблоны
					6 - баннер, видеоролик
					7 - интерактивная визитка
					8 - интерактивный баннер
					9 - сайт, приложение
				*/
				
				$model = new TAdv;
				//Если был выбран город
				if ($city->id_city) $model->id_city = $city->id_city;
				//Если есть файл
				if ($_POST["id_file_image"]) {
					$FileImage = FileImage::findOne(["id_file" => $_POST["id_file_image"]]);
					$model->file = end(explode(".", $FileImage["path"]));
					$model->id_file = $_POST["id_file_image"];
					if ($_POST["atype"] == '_format_template') {
						$model->type = 5;
					} else if ($_POST["atype"] == '_format_video_banner') {
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

						if ($_POST["atype"] == '_format_template' || $_POST["atype"] == '_format_video_banner') {
							$place = 4;
						} else if ($_POST["atype"] == '_format_ineractive_vizitka') {
							$place = 4;
						} else if ($_POST["atype"] == '_format_ineractive_banner') {
							$place = 4;
						}/*  else if ($_POST["atype"] == '_format_site_app') {
							$place = 5;
						} */
						
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
			print $this->renderAjax($_POST['action'],['modelTAdv' => $modelTAdv]);
		}
	}
	
	public function actionGetterminal()
	{
		if ($_POST['id_city']) {
			$css = '';$cst = '';$csp = '';$type = '';$format = '';$place = '';$end_date = '';
			$work_array = array();
			$type_array = array();
			
			if ($_POST['work_time_12'] == 'true') $work_array[] = 12;
			if ($_POST['work_time_24'] == 'true') $work_array[] = 24;
			
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
			
			$sql = 'status = 1 AND city = '.$_POST['id_city'].$type;

			if ($_POST["format"] == '_format_template' || $_POST["format"] == '_format_video_banner') {
				$place = 4;
			} else if ($_POST["format"] == '_format_ineractive_vizitka') {
				$place = 3;
			} else if ($_POST["format"] == '_format_ineractive_banner') {
				$place = 4;
			}/*  else if ($_POST["format"] == '_format_site_app') {
				$place = 5;
			} */
			
			$sql =  'SELECT * '.
					' FROM t_terminal ter'.
					' LEFT JOIN t_advShedule advs'.
					' ON ter.id_terminal = advs.terminal'.
					' AND advs.startdate >= \''.$_POST['start_date'].'\''.
					' AND advs.enddate <= \''.$_POST['end_date'].'\''.
					' AND advs.status IN (-2, 1)'.
					($place ? ' AND advs.place = '.$place : '').
					' LEFT JOIN t_adv adv'.
					' ON advs.adv = adv.id_adv'.
					($_POST['selectTime'] ? ' AND adv.period = '.$_POST['selectTime'] : '').
					' WHERE '.$sql.
					' ORDER BY ter.id_terminal ASC';
			$TTerminal = Yii::$app->db->createCommand($sql)->queryAll();

			$array_terminal = array();
			$array_terminal_date = array();
			foreach($TTerminal as $key => $value) {
				//Запись диапазона дат в массив
				$start = new \DateTime($_POST['start_date']);
				$end   = new \DateTime($_POST['end_date']);
				$period = new \DatePeriod($start, new \DateInterval('P1D'), $end);
				$arrayOfDates = array_map(
					function($item){return $item->format('d.m.Y');},
					iterator_to_array($period)
				);
				$array_terminal_date[$value['id_terminal']] = $arrayOfDates;
				//Конец записи
				if ($value['startdate']) {
					if (in_array($value['startdate'], $array_terminal_date[$value['id_terminal']])) {
						//Запись диапазона дат из базы в массив
						$start = new \DateTime($value['startdate']);
						$end   = new \DateTime($value['enddate']);
						$period = new \DatePeriod($start, new \DateInterval('P1D'), $end);
						$arrayOfDates2 = array_map(
							function($item){return $item->format('d.m.Y');},
							iterator_to_array($period)
						);
						//Сравниваем 2 массива дат и находи свободные дни
						$resultDate = array_diff($arrayOfDates, $arrayOfDates2);
						//Уничтожаем массив
						unset($array_terminal_date['id_terminal']);
						//Записываем новый массив
						$array_terminal_date[$value['id_terminal']] = $resultDate;
					}
				}
				//Если есть свободные даты то пишем терминал
				if ($array_terminal_date[$value['id_terminal']]) {
					$GReferensPlace = GReferens::findOne(['id_ref' => $value['category_place']]);
					$GReferensType = GReferens::findOne(['id_ref' => $value['type']]);
					
					$array_terminal[$key]['id_terminal'] = $value['id_terminal'];
					$array_terminal[$key]['place'] = $GReferensPlace->name;
					$array_terminal[$key]['name'] = $value['place'];
					$array_terminal[$key]['address'] = $value['address'];
					$array_terminal[$key]['date'] = count($array_terminal_date[$value['id_terminal']]);
					$array_terminal[$key]['platforma'] = $GReferensType->name;
					$array_terminal[$key]['price'] = '';
				}
			}
			print json_encode(array("result" => true, "array_terminal" => $array_terminal));
		} else {
			print json_encode(array("result" => false, "error" => "Районы пустой массив!"));
		}
	}
	
	public function actionGetdate()
	{
		if ($_POST) {
			$date = new \DateTime($_POST['date']);
			$date->modify($_POST['date_time']);
			print json_encode(array("result" => true, "date" => $date->format('d.m.Y')));
		} else {
			print json_encode(array("result" => false, "error" => "POST пустой!"));
		}
	}
	
	public function actionOpenedit()
	{
		return $this->renderAjax('_my_template');
	}
}
