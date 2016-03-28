<?php
use frontend\modules\info\assets\MobileAsset;

Yii::$app->assetManager->forceCopy = true;

$asset = MobileAsset::register($this);
$assetPath = $asset->baseUrl;
?>

<div class="wrap">
	<div class="container text-center">
		<h1>МОБИЛЬНОЕ ПРИЛОЖЕНИЕ &laquo;ГОРОДСКОЙ СМАРТФОН&raquo;</h1>
		<div class="row block-one">
			<div class="col-xs-12 col-sm-11 col-sm-offset-1 col-md-6 col-md-offset-0 text-left">
				<h3>Размещение информации<br>на общественных городских смартфонах</h3>
				<div class="col-xs-11 col-xs-offset-1 block-one-desc">
					Установи приложение &laquo;Городской смартфон&raquo;:
					<div class="row">
						<div class="col-xs-12  col-sm-11 col-sm-offset-1  col-md-12 col-md-offset-0 block-one-item">
							<i class="fa fa-circle fa-3"></i><span>- поздравляем друзей и близких</span>
							<div class="clearfix" style="margin-top: 7px;"></div>
							<i class="fa fa-circle fa-3"></i><span>- делись новостями и эмоциями</span>
							<div class="clearfix" style="margin-top: 7px;"></div>
							<i class="fa fa-circle fa-3"></i><span>- размещай рекламу</span>
						</div>
					</div>
					на больших экранах городских смартфонов<br>
					в 3 клика и абсолютно бесплатно!
				</div>
			</div>
			<div class="clearfix visible-xs visible-sm"></div>
			<div class="col-xs-12 col-sm-10 col-sm-offset-2 col-md-6 col-md-offset-0">
				<img class="img-responsive" src="<?= $assetPath.'/images/mobile-1.png'?>"/>
			</div>
		</div>
		<div class="row block-two">
			<div class="col-xs-12 text-left">
				<span class="text-danger">Важно!</span>
				<div class="block-two-desc">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&laquo;Городской смартфон&raquo; поможет ив трудных ситуациях.
					Например, потерялся ребёнок или<br>
					убежала собака - менее минуты займёт заполнение шаблона в приложении, а ещё через пару<br>
					минут, на всех смартфонах расположеных в городе, будет транслироваться объявление<br>
					с просьбой о помощи в поиске и фотографией пропавшего.
					<br><br>
					*<i>Вся информаци, размещаемая на обшественных терминалах &laquo;Городской смартфон&raquo;,
					проходит строгую модерацию.</i>
				</div>
			</div>
		</div>
		<div class="row block-three">
			<div class="col-xs-12 col-sm-11 col-sm-offset-1 col-md-6 col-md-offset-0 text-left">
				<h3>Умный справочник</h3>
				<div class="block-three-item">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Находи нужные тебе контакты в любом городе любой страны мира, где<br>
					работает система &laquo;Городской смартфон&raquo;, и бесплатно связывайся с ними.
				</div>
				<div class="block-three-item">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Добавляй интерактивные визитки в &laquo;Умный справочник&raquo; и управляй,<br>
					информацией, размещенной в них.
				</div>
				<div class="block-three-item">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Интерфейс &laquo;Умного справочника&raquo; по аналогии со справочником<br>
					контактов в обычном смартфоне и интуитивно понятен каждому.
				</div>
			</div>
			<div class="clearfix visible-xs visible-sm"></div>
			<div class="col-xs-12 col-sm-10 col-md-6 col-md-offset-0">
				<img class="img-responsive" style="margin: 0 auto;" src="<?= $assetPath.'/images/mobile-2.png'?>"/>
			</div>
		</div>
		<div class="row block-four">
			<div class="visible-xs visible-sm">
				<div class="col-xs-12 col-sm-11 col-sm-offset-1 text-left">
					<h3 style="margin-top: 20px;">Общение</h3>
					<div class="block-four-item">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Получай вызовы и сообщения от лиц и компаний из &laquo;Умного справочника&raquo;, а<br>
						также с терминалов &laquo;Городской смартфон&raquo;, и сам звони на любые из них<br>
						в случае необходимости.
					</div>
					<div class="block-four-item">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Общайся в городских чатах.
					</div>
				</div>
				<div class="col-xs-12 col-sm-10">
					<img class="img-responsive" style="margin: 0 auto;margin-top: 20px;" src="<?= $assetPath.'/images/mobile-3.png'?>"/>
				</div>
			</div>
			<div class="hidden-xs hidden-sm">
				<div class="row">
					<div class="col-md-6 col-md-offset-0">
						<img class="img-responsive" src="<?= $assetPath.'/images/mobile-3.png'?>"/>
					</div>
					<div class="col-md-6 col-md-offset-0 text-left">
						<h3>Общение</h3>
						<div class="block-four-item">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Получай вызовы и сообщения от лиц и компаний из &laquo;Умного справочника&raquo;, а<br>
							также с терминалов &laquo;Городской смартфон&raquo;, и сам звони на любые из них<br>
							в случае необходимости.
						</div>
						<div class="block-four-item">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Общайся в городских чатах.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
