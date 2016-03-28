<?php
use frontend\modules\info\assets\CitySmartScreenAsset;

Yii::$app->assetManager->forceCopy = true;

$asset = CitySmartScreenAsset::register($this);
$assetPath = $asset->baseUrl;

$this->title = "CitySmartMedia";
?>
<div class="container text-center">
	<div class="row">
		<div class="col-xs-6 col-sm-3 col-sm-offset-3">
			<a style="text-decoration:underline;" href="/info/citysmartterminal">Интерактивные терминалы</a>
		</div>
		<div class="col-xs-6 col-sm-3">
			<a style="text-decoration:underline;  padding-right: 30px;" href="/info/terminals">Городские смартфоны	</a>
		</div>
	</div>
	<p class="page-subtitle" style="margin-top: 20px;margin-bottom: 30px;">Мультимедийные экраны CitySmartMedia (CSM)</p>
	<div class="row main-text"> 
		<div class="col-xs-12 text-left">
			<p style="text-indent: 20px;">
				Основное отличие мультимедийных экранов CSM – канал вещания <a href="/adv/add">SMART MEDIA</a>, обеспечивающий трансляцию объявлений, открыток, баннеров и видеороликов, разместить которые может любой желающий с любого компьютера или смартфона абсолютно бесплатно. Вся размещаемая информация проходит строгую модерацию.
			</p>
			<p style="text-indent: 20px;">
				Также мультимедийные экраны CSM могут служить системами видеонаблюдения, оповещения при ЧП и раздавать Wi-Fi.
			</p>
		</div>
	</div>
	<div class="row" style="margin-top: 40px;font-size: 14px;">
		<div class="col-xs-12 col-sm-5 col-sm-offset-1">
			<img class="img-responsive center-block" src="<?= $assetPath.'/images/media-01.png'?>"/>
		</div>
		<div class="col-xs-12 col-sm-6 text-left main-text">
			<p style="margin-top: 50px;text-indent: 20px;">
				Одним из главных преимуществ мультимедийных экранов CSM является то, что функционал системы CITYSMARTMEDIA помогает решить проблему привлечения рекламодателей и обеспечить собственникам мультимедийных экранов стабильный пассивный доход.
			</p>
		</div>
	</div>
	<div class="row main-text" style="margin-top: 58px;font-size: 14px;">
		<div class="col-xs-12 col-sm-5 col-sm-offset-1">
			<img class="img-responsive center-block" src="<?= $assetPath.'/images/media-02.png'?>"/>
			<p style="padding-top: 15px;padding-bottom: 40px;border-bottom: 2px solid #ccc;">
				Управлять мультимедийными экранами CSM и отслеживать их статистику работы можно с любого компьютера или смартфона.
			</p>
		</div>
		<div class="col-xs-12 col-sm-5">
			<img class="img-responsive center-block" src="<?= $assetPath.'/images/media-03.png'?>"/>
			<p style="padding-top: 15px;padding-bottom: 40px;border-bottom: 2px solid #ccc;">
				В интернет-магазине  SMART SHOP представлены модели мультимедийных экранов CSM от различных производителей.
			</p>
		</div>
	</div>
	<div class="row main-text" style="margin-top: 40px;font-size: 14px;">
		<div class="col-xs-12 col-sm-5 col-sm-offset-1">
			<img class="img-responsive center-block" src="<?= $assetPath.'/images/media-04.png'?>"/>
			<p style="padding-top: 15px;padding-bottom: 20px;border-bottom: 2px solid #ccc;">
				Если у вас уже есть мультимедийные экраны, установленные в общественных местах, в сервисе <a href="#">SMART SOFT</a> вы можете бесплатно скачать программное обеспечение CSM и установить на устройство управления вашими экранами.
			</p>
		</div>
		<div class="col-xs-12 col-sm-5">
			<img class="img-responsive center-block" src="<?= $assetPath.'/images/media-05.png'?>"/>
			<p style="padding-top: 15px;padding-bottom: 40px;border-bottom: 2px solid #ccc;">
				Если установка программного обеспечения CSM на ваше оборудование невозможна, закажите в интернет-магазине SMART SHOP блок управления CSM, подходящий для ваших экранов.
			</p>
		</div>
	</div>
	<div class="row main-text" style="margin-top: 40px;font-size: 14px;">
		<div class="col-xs-12">
			<img class="img-responsive center-block" src="<?= $assetPath.'/images/media-06.png'?>"/>
			<p style="padding-top: 15px;">
				Мультимедийные экраны CSM это новая эра на рынке рекламно-информационных услуг и <a class="main-text-dep" href="/info/business">высокоприбыльный бизнес с пассивным доходом</a> для инвесторов и предпринимателей.
			</p>
		</div>
	</div>
</div>

