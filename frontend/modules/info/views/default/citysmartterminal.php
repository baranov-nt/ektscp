<?php
use frontend\modules\info\assets\CitySmartTerminal;

Yii::$app->assetManager->forceCopy = true;

$asset = CitySmartTerminal::register($this);
$assetPath = $asset->baseUrl;

$this->title = "CitySmartTerminal";
?>

<div class="container text-center">
	<div class="row">
		<div class="col-xs-6 col-sm-3 col-sm-offset-3">
			<a style="text-decoration:underline;" href="/info/citysmartscreen">Мультимедийные экраны</a>
		</div>
		<div class="col-xs-6 col-sm-3">
			<a style="text-decoration:underline; " href="/info/terminals">Городские смартфоны</a>
		</div>
	</div>
	<p class="page-subtitle" style="margin-top: 20px;margin-bottom: 30px;">Интерактивные терминалы CitySmartMedia (CSM)</p>
	<div class="row"> 
		<div class="col-xs-12 text-left main-text">
			<p style="text-indent: 20px;">
				Интерактивные терминалы CSM более популярны у пользователей, так как оказывают широкий спектр различных услуг.
			</p>
			<p style="text-indent: 20px;">
				На экране терминалов CSM каждый пользователь может найти полезные для себя сервисы и приложения, получить необходимую информацию, зайти в интернет. Функционал терминалов CSM аналогичен функционалу обычного планшета, он прост и интуитивно понятен каждому.
			</p>
			<p style="text-indent: 20px;">
				Все функции и сервисы терминалов CSM бесплатные для пользователей.
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-1" style="padding-left: 10px;">
			<img class="img-responsive center-block" src="<?= $assetPath.'/images/terminal-01.png'?>"/>
		</div>
		<div class="clearfix visible-xs"></div>
		<div class="col-xs-12 col-sm-5 text-left margin-left main-text" style="padding-top: 65px;">
			<p style="margin-top: 15px;">
				<span class="block-header">1) Модуль SMART MEDIA</span><br>
				Мультимедийный экран для трансляции объявлений,<br>
				открыток, баннеров и видеороликов, разместить<br>
				которые может любой желающий с любого<br>
				компьютера или смартфона абсолютно бесплатно. 
			</p>
			<p style="margin-top: 15px;">
				<span class="block-header">2) Главный экран</span><br>
				- Поисковые, навигационные и прочие полезные 
				сервисы и приложения.<br>
				- Локальные сервисы, которые позволят 
				пользователям получить подробную информацию о 
				месте, в котором установлен терминал, легко найти 
				все компании, службы, магазины и прочие 
				организации, расположенные на данном адресе и 
				получить необходимую информацию о них.<br>
				- Умный справочник с удобным поиском лиц и 
				компаний города.<br>
				<span style="font-style: italic;">Интерактивные визитки справочника позволяют 
				написать сообщение их владельцам, заказать 
				обратный звонок или получить более полную 
				информацию, например, перейти на сайт компании.</span>
			</p>
			<p style="margin-top: 15px;">
				<span class="block-header">3) Информационный модуль</span><br>
				Время, дата, погода, курсы валют.
			</p>
			<p style="margin-top: 15px;">
				<span class="block-header">4) Видеонаблюдение</span><br>
				Камера высокого разрешения с функцией распознавания лиц.
			</p>
		</div>
	</div>
</div>
<div class="service">
	<div class="container">		
		<div class="row">
			<div class="col-sm-12" style="margin-bottom: 30px;">		
				<div class="row">
					<div class="col-md-12 text-center subtitle page-subtitle">Основные сервисы и приложения</div>			
				</div>
				<div class="row main_services">
					<div class="col-sm-4 col-md-4">
						<div class="row">
							<div class="col-xs-2 col-md-2"><img src="/images/services-01.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Поисковые и навигационные сервисы</div>
						</div>					
						<div class="row">
							<div class="col-xs-2 col-md-2"><img src="/images/services-04.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Социальные сети</div>
						</div>					
						<div class="row">
							<div class="col-xs-2 col-md-2"><img src="/images/services-07.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">City-selfie</div>
						</div>					
						<div class="row">
							<div class="col-xs-2 col-md-2"><img src="/images/services-10.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Платежные системы и сервисы</div>
						</div>
						<div class="row">
							<div class="col-xs-2 col-md-2"><img src="/images/services-13.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Система оповещения при ЧП</div>
						</div>							
					</div>			
					<div class="col-sm-4 col-md-4">
						<div class="row">
							<div class="col-xs-2 col-md-2"><img src="/images/services-02.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Электронные сервисы гос.услуг</div>
						</div>					
						<div class="row">
							<div class="col-xs-2 col-md-2"><img src="/images/services-05.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Электронные приемные</div>
						</div>					
						<div class="row">
							<div class="col-xs-2 col-md-2"><img src="/images/services-08.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Электронные офисы банков</div>
						</div>					
						<div class="row">
							<div class="col-xs-2 col-md-2"><img src="/images/services-11.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Электронные каталоги товаров и услуг</div>
						</div>							
						<div class="row">
							<div class="col-xs-2 col-md-2"><img src="/images/services-14.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Электронные сервисы продажи билетов</div>
						</div>
					</div>			
					<div class="col-sm-4 col-md-4">
						<div class="row">				
							<div class="col-xs-2 col-md-2"><img src="/images/services-03.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Расписание транспорта</div>
						</div>					
						<div class="row">				
							<div class="col-xs-2 col-md-2"><img src="/images/services-06.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Контрольно-пропускная система</div>
						</div>					
						<div class="row">				
							<div class="col-xs-2 col-md-2"><img src="/images/services-09.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Продажа/аренда недвижимости</div>
						</div>					
						<div class="row">				
							<div class="col-xs-2 col-md-2"><img src="/images/services-12.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Вакансии</div>
						</div>
						<div class="row">				
							<div class="col-xs-2 col-md-2"><img src="/images/services-15.png" alt=""></div>				
							<div class="col-xs-10 col-md-10 main-text">Любые сервисы по желанию заказчика</div>
						</div>							
					</div>		
				</div>						
			</div>
			<div class="col-md-2"></div>				
		</div>			
	</div>	
</div>
<div class="container text-center">
	<div class="row main-text" style="margin-top: 58px;font-size: 14px;">
		<!--Mobile-->
		<div class="col-xs-12 visible-xs">
			<img class="img-responsive center-block" src="<?= $assetPath.'/images/terminal-02.png'?>"/>
		</div>
		<!--Desctop-->
		<div class="col-sm-6 col-md-offset-1" style="padding-left: 40px;padding-top: 50px;">
			<p>
				В сервисе <a href="#">SMART SOFT</a> можно бесплатно скачать и установить на терминал CSM различные сервисы и приложения, а также заказать разработку любых других, необходимых именно вам. Так как операционная система CST открыта для разработчиков, обязательно найдется тот, кто выполнит нужное вам решение.
			</p>
		</div>
		<div class="col-sm-5 hidden-xs">
			<img class="img-responsive text-left" src="<?= $assetPath.'/images/terminal-02.png'?>"/>
		</div>
	</div>
	<div class="row page-dep" style="margin-top: 40px;">
			Операционную систему CSM можно установить на любой интерактивный терминал.
	</div>
	<div class="row main-text" style="margin-top: 40px;font-size: 14px;">
		<div class="col-xs-12 col-sm-5 col-sm-offset-1">
			<img class="img-responsive center-block" src="<?= $assetPath.'/images/terminal-03.png'?>"/>
			<p style="padding-top: 15px;">
				Если у вашего терминала не хватает производительности для работы с системой 
				CSM, в интернет-магазине <a href="#">SMART SHOP</a> вы можете подобрать необходимые 
				комплектующие и заказать услугу доработки вашего терминала.
			</p>
		</div>
		<div class="col-xs-12 col-sm-5">
			<img class="img-responsive center-block" src="<?= $assetPath.'/images/terminal-04.png'?>"/>
			<p style="padding-top: 15px;">
				Для терминалов CSM  можно заказать услугу «управление терминалом» операторами 
				CITYSMARTMEDIA и еженедельное сервисное обслуживание.
			</p>
		</div>
	</div>
	<div class="row main-text" style="margin-top: 40px;font-size: 14px;">
		<div class="col-xs-12">
			<img class="img-responsive center-block" src="<?= $assetPath.'/images/terminal-06.png'?>"/>
			<p style="padding-top: 15px;">
				Интерактивные терминалы CSM являются неотъемлемой частью интеллектуальной сети 
				CITYSMARTMEDIA и приносят собственникам терминалов <a class="main-text-dep" href="/info/business">стабильный пассивный доход.</a>
			</p>
		</div>
	</div>
</div>