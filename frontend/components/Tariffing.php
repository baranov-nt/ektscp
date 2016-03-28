<?
namespace app\components;

use Yii;

class Tariffing extends yii\base\Component
{

	public function init() {

		parent::init();

	}
	
	public function calculationTariff($id_terminal, $type, $day_count, $period, $place, $diag, $worktime, $passability) {
		
		//Скидка от времени размещения	
		static $salecountofdate = array(1 => '0', 3 => '5', 7 => '10', 14 => '15', 21 => '20', 30 => '25', 60 => '30', 90 => '35', 120 => '40', 150 => '45', 180 => '50'); 
		
		$popularity_place_coefficient = $this->calculationPlacePopularityCoefficient($passability);	//Коэффициент популярности места
		
		$work_time_coefficient = $this->calculationWorkTimeCoefficient($worktime);	//Коэффициент режима работы
		
		$diagonal_screen_coefficient = $this->calculationDiagonalScreenCoefficient($type, $diag); //Коэффициент размера экрана	
		
		$total_profit = $this->calculationTotalProfit($place, $period, $diagonal_screen_coefficient, $work_time_coefficient, $popularity_place_coefficient); //Сумма за период
			
		$sale_of_count_day = $salecountofdate[$day_count]; //Скидка по дням		
		
		return array(['total' => $total_profit, 'sale' => $sale_of_count_day]); 
	  
	}   

	//Общий доход
	private function calculationTotalProfit($place, $period, $diagonal_screen_coefficient, $work_time_coefficient, $popularity_place_coefficient) {

		if($place == 4){ //Верхний экран

			$min_coefficient = $diagonal_screen_coefficient * $work_time_coefficient * $popularity_place_coefficient;
			
			$countview = array(540 => $min_coefficient, 480 => ($min_coefficient * 1.25), 420 => ($min_coefficient * 1.5), 360 => ($min_coefficient * 2), 300 => ($min_coefficient * 2.5), 240 => ($min_coefficient * 3), 180 => ($min_coefficient * 4), 120 => ($min_coefficient * 5.5), 60 => ($min_coefficient * 7), 30 => ($min_coefficient * 8.5), 15 => ($min_coefficient * 10));
			
			$sum = $countview[$period];	
			
		}else if($place == 3){ // Средний экран
		
			$min_coefficient = ($diagonal_screen_coefficient * $work_time_coefficient * $popularity_place_coefficient) / 1.5;
			
			$countview = array(540 => $min_coefficient, 480 => ($min_coefficient * 1.25), 420 => ($min_coefficient * 1.5), 360 => ($min_coefficient * 2), 300 => ($min_coefficient * 2.5), 240 => ($min_coefficient * 3), 180 => ($min_coefficient * 4), 120 => ($min_coefficient * 5.5), 60 => ($min_coefficient * 7), 30 => ($min_coefficient * 8.5), 15 => ($min_coefficient * 10));

			$sum = $countview[$period];	
			
		}else if($place == 9){ // Таргетинговая реклама во время поиска информации
		
			$min_coefficient = ($diagonal_screen_coefficient * $work_time_coefficient * $popularity_place_coefficient) / 2;		
			
			$countview = $min_coefficient;
			
			$sum = $countview;	
			
		}else if($place == 10){ // Таргетинговая реклама во время телефонных разговоров
		
			$min_coefficient = $diagonal_screen_coefficient * $work_time_coefficient * $popularity_place_coefficient;			
	
			$countview = $min_coefficient;
			
			$sum = $countview;	
		}

		return $sum;
	}
	
	//Коэффициент размера экрана
	private function calculationDiagonalScreenCoefficient($type, $diag) {

		if($type == 415){
			if($diag == 42){
				$price = 45;
			}else if($diag == 55){
				$price = 50;
			}
		}else if($type == 416){
			if($diag == 32){
				$price = 15;
			}else if($diag == 42){
				$price = 20;
			}else if($diag == 55){
				$price = 25;
			}else if($diag == 60){
				$price = 30;
			}
		}else if($type == 417){
			if($diag == 42){
				$price = 45;
			}else if($diag == 55){
				$price = 50;
			}
		}

		return $price;
	}	
	
	//Коэффициент популярности места
	private function calculationPlacePopularityCoefficient($passability) {

		if($passability <= 1000){
			$ppc = '1';
		}else if($passability > 1000 && $passability <= 5000){
			$ppc = '1.2';
		}else if($passability > 5000 && $passability <= 10000){
			$ppc = '1.4';
		}else if($passability > 10000 && $passability <= 15000){
			$ppc = '1.6';
		}else if($passability > 15000 && $passability <= 20000){
			$ppc = '1.8';
		}else if($passability > 20000){
			$ppc = '2.0';
		}

		return $ppc;
	}

	//Коэффициент режима работы
	private function calculationWorkTimeCoefficient($worktime) {

		if($worktime == 12){
			$wtc = '1';
		}else if($worktime == 24){
			$wtc = '1.2';
		}

		return $wtc;
	}
	
}
?>