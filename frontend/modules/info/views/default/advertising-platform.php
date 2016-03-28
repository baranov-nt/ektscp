<?php
use frontend\modules\info\assets\AdvertisingPlatformAsset;

Yii::$app->assetManager->forceCopy = true;

$asset = AdvertisingPlatformAsset::register($this);
$assetPath = $asset->baseUrl;
?>

<div class="wrap">
	<!--<div class="wrap-navbar"></div>-->
	<div class="container text-center" style="padding-top: 32px;">
		<div class="row" style="max-width: 800px;margin: 0 auto;">
			<div class="col-xs-12 col-sm-12 col-md-4">
				<img class="img-responsive" style="margin: 0 auto;" src="<?= $assetPath.'/images/city-smart-1.png'?>"/>
			</div>
			<div class="clearfix visible-xs visible-sm"></div>
			<div class="col-xs-12 col-sm-10 col-sm-offset-2 col-md-8 col-sm-offset-0 text-left" style="padding-top: 22px;font-size: 14px;">
				Городской смартфон - высокоэфективная рекламная<br>
				платформа, доступная каждому.
				<br><br>
				Чтобы рассказать о своих таварах и услугах нет необходимости<br>
				обращаться в рекламное агенство, тратить деньги и время на<br>
				изготовленеие и размещение рекламы. Достаточно на сайте или<br>
				в мобильно приложении заполнить шаблон и выбрать интересующие<br>
				адреса установки терминалов &laquo;Городской смартфон&raquo;.
				<br><br>
				Кроме того, что реклама на терминалах &laquo;Городской смартфон&raquo;<br>
				является самой доступной по цене, также она совмещает в себе все<br>
				преимущества имеджевой оутдур, индор рекламы и интерактивной<br>
				рекламы в интернете, с четким определением целевой аудитории<br>
				и возможностью бесплатной связи клиента с рекламодателем<br>
				В один клик.
			</div>
		</div>
		<h4>В городе множество мест для размещения рекламы.<br>Выбери, где разместить свою.</h4>
		<div class="table-responsive platform">
			<table class="table">
				<thead>
					<tr>
						<th><div>Критерии размещения рекламы</div></th>
						<th><div>Outdoor<br>реклама</div></th>
						<th><div>Indoor<br>реклама</div></th>
						<th><div>Реклама<br>на ТВ</div></th>
						<th><div>Промоушен</div></th>
						<th><div>Реклама<br>в интернете</div></th>
						<th><div>Сеть терминалов<br>&laquo;Городской<br>смартфон&raquo;</div></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><div>Аудитория "на улице"</div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Аудитория "Интернет"</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Большой формат рекл. площадки</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div>	</td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Таргетинг на людей</div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Таргетинг локальный и отраслевой</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Удобство и простота размещения</div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Высокая скорость размещения</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Низкая стоимость размещения</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Новизна и оригинльность носителя</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Размещение на короткий срок (от 1 дня)</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Управление рекламой</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Интерактивная реклама</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Бесплатная связь с рекламодателем в один клик</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Широкий спектр рекламных услуг, который<br>включает как платные так и БЕСПЛАТНЫЕ</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Прямой контакт с аудиторией с применением<br>новых технологий</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Оценка целевой аудитории за счёт доступа<br>к подробной статистической информации</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Точный прогноз планируемой и оценка<br>эффективности проведенной рекламной кампании</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Отсутствие необходимости обращения<br>в рекламное агенство</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Отсутствие затрат на изготовление рекламы</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
					<tr>
						<td><div>Лояльность пользователей к рекламе</div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="not-check"></div></td>
						<td><div class="check"><i class="fa fa-check"></i></div></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>