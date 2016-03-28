<?php
use frontend\modules\info\assets\AssetBundleInfo;

Yii::$app->assetManager->forceCopy = true;

$asset = AssetBundleInfo::register($this);
$assetPath = $asset->baseUrl;

$this->title = '«CitySmartPhone»';
?>
<div class="info-default-index">
<div class="site-index">
	<div class="operationsystem">
		<div class="container" style="padding-top: 40px;">
			<div style="margin: 0 auto;max-width: 940px;">
				<div class="row">
					<div class="col-xs-6 col-sm-3 col-sm-offset-3">
						<a style="text-decoration:underline;" href="/info/citysmartscreen">Мультимедийные экраны</a>
					</div>
					<div class="col-xs-6 col-sm-3">
						<a style="text-decoration:underline;" href="/info/citysmartterminal">Интерактивные терминалы</a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 col-md-offset-3 page-header" style="text-align:center; line-height:40px;">Городские смартфоны</div>			
			</div>	
			
			
			<div class="row" style="margin-top:10px; margin-bottom:20px;">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<p class="main-text-dep" style="text-indent:20px;">Функционал терминалов "Городской смартфон" повторяет функционал обычных смартфонов. Главное отличие – огромный размер и локальные сервисы, которые позволяют пользователям получить подробную информацию о месте, в котором установлен городской смартфон, помогают легко найти все компании, службы, магазины и прочие организации, расположенные на данном адресе и связаться с ними в один клик.</p>
					<p class="main-text-dep" style="text-indent:20px;">Все функции и сервисы городского смартфона, в том числе и телефонная связь, бесплатные для пользователей.</p>					
				</div>		
				<div class="col-md-1"></div>				
			</div>				
			<div class="clearfix visible-xs"></div>	
			<div class="row">
				<div class="col-md-6 col-md-offset-3 page-subtitle" style="text-align:center;">Основные функции</div>		
			</div>							
			<div class="clearfix visible-xs"></div>			
			<div class="row">
				<div class="col-sm-4 col-md-6">
					<img src="/images/terminalinfo.png" alt="" class="img-responsive center-block">
				</div>

				<div class="col-sm-4 col-md-3" style="margin-top: 50px;">
					<b class="main-text-dep">1) Модуль SMART MEDIA</b>
					<p class="main-text-2">Мультимедийные экраны для трансляции открыток, объявлений, баннеров и видеороликов, разместить которые может любой желающий с любого компьютера или смартфона абсолютно бесплатно.</p>
					<b class="main-text-dep">2) Видеокамера</b>
					<p class="main-text-2">Позволяет совершать видеозвонки.</p>
					<b class="main-text-dep">3) Главный экран (сенсорная рабочая область)</b>
					<p class="main-text-2">Бесплатные сервисы и приложения.</p>
					<b class="main-text-dep">4) Телефон</b>
					<p class="main-text-2">Бесплатные звонки на любой телефонный номер.</p>
					<b class="main-text-dep">5) Умный справочник</b>
					<p class="main-text-2">Справочник с удобным поиском лиц, компаний, городских смартфонов. Интерактивные визитки справочника позволяют связаться с их владельцами в один клик, написать им сообщение или получить расширенную информацию, например, перейти на сайт компании.</p>
					<b class="main-text-dep">6) Локальные сервисы</b>
					<p class="main-text-2">Сервисы, которые позволят пользователям получить подробную информацию о месте, в котором установлен городской смартфон.</p>

				</div>

				<div class="col-sm-4 col-md-3"  style="margin-top: 50px;">
					<b class="main-text-dep">7) Вызов экстренных служб</b>
					<p class="main-text-2">- Единая служба спасения 112<br>
					- Пожарная охрана<br>
					- Полиция<br>
					- Скорая помощь<br>
					- Прочие оперативные службы</p>

					<b class="main-text-dep">8) Выбор языка</b>
					   <p class="main-text-2">Каждый пользователь может выбрать интерфейс смартфона на своем родном языке, что особенно удобно для иностранных гостей.</p>

					<b class="main-text-dep">9) CitySmartNews</b>
					   <p class="main-text-2">Интерактивный сервис, популярных в социальных сетях, постов и новостей на главном экране.    Самые популярные новости и посты с хэштегом #CitySmartNews транслируются в мультимедийной зоне «Новость дня» </p>

					<b class="main-text-dep">10) Строка информации</b>
					   <p class="main-text-2">Время, дата, погода.</p>
					
					<b class="main-text-dep">11) Бесплатный Wi-Fi</b>
					   <p class="main-text-2">Гигабитный роутер на 100 подключений раздает Wi-Fi на 50 метров.</p>	
					   
					<b class="main-text-dep">12) Видеонаблюдение</b>
					   <p class="main-text-2">Камера высокого разрешения с функцией распознавания лиц.</p>			

					   <p style="border-top: 1px solid black; padding-top: 10px;"></p>						   
					   <p style="padding-left:10px; font-size:12px; font-weight:bold;">Городские смартфоны крепятся на стену или устанавливаются на пол.</p>						   
					   <p style="padding-left:10px; font-size:18px;">Высота терминала - 2,5 м.</p>						   
					   <p style="padding-left:10px; font-size:18px; margin-top:-10px; margin-bottom:20px;">Диагональ экрана — 55’’</p>						   
				</div>
			</div>
		</div>	
	</div>	
	<div class="place">
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-12 text-center subtitle page-subtitle" style="color:#004c7f;">Места установки</div>
					</div>
					<div class="row">			
						<div class="col-md-12" style="color:#004c7f;">
							<div class="col-sm-6 col-md-6 col-md-offset-1">
								<div class="row main-text">- Аэропорты и вокзалы</div>
								<div class="row main-text">- Метро и остановки общественного транспорта</div>
								<div class="row main-text">- Торговые и бизнес-центры</div>
								<div class="row main-text">- Жилые комплексы и улицы города</div>
							</div>
							<div class="col-sm-6 col-md-5">					
								<div class="row main-text">- Учебные и спортивные учреждения</div>
								<div class="row main-text">- Больницы и поликлинники</div>
								<div class="row main-text">- Государственные и муниципальные учрежденя</div>
								<div class="row main-text">- Гостиницы и общежития</div>
							</div>						
						</div>						
					</div>	
				</div>	
				<div class="col-md-2"></div>				
			</div>		
		</div>		
	</div>	
	<div class="row service">
		<div class="container">		
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8" style="margin-bottom: 30px;">		
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
	<div class="talking">
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-xs-12 visible-xs text-center subtitle page-subtitle" style="margin-top: 50px;">Общение без границ</div>	
						<div class="col-md-12 hidden-xs subtitle page-subtitle" style="margin-top: 80px;">Общение без границ</div>	
					</div>
					<div class="row">	
						<div class="col-sm-6 visible-xs col-md-6">
							<div class="row">
								<img src="/images/icon-21.png" alt=""  class="img-responsive center-block">
							</div>				
						</div>				
						<div class="col-sm-6 col-md-6">
							<div class="row">
								<div class="col-xs-12 visible-xs text-center main-text" style="margin-bottom: 150px; color: #004c7f;">Хочешь пообщаться с жителями других городов или стран, выбери в «Умном справочнике» городской смартфон в любом интересующем тебя месте и соверши видеовызов. Тебе обязательно кто-нибудь 
								ответит.</div>						
								<div class="col-md-12 hidden-xs main-text" style="color: #004c7f;">Хочешь пообщаться с жителями других городов или стран, выбери в «Умном справочнике» городской смартфон в любом интересующем тебя месте и соверши видеовызов. Тебе обязательно кто-нибудь 
								ответит.</div>
							</div>
						</div>		
						<div class="col-sm-6 hidden-xs col-md-6" style="margin-top: -85px; margin-bottom: 140px;">
							<div class="row">
								<img src="/images/icon-21.png" alt=""  class="img-responsive center-block">
							</div>				
						</div>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>	
		</div>	
	</div>	
	<div class="orangeline">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2" style="padding-top:30px; padding-bottom:30px; font-weight:bold;"><p class="main-text-dep">
					&laquo;Городской смартфон&raquo; — универсальная коммуникационная технология, создающая общее информационное поле, связывающая воедино все аспекты и всех участников городской жизни: жителей, власть, бизнес.</p>
					<p class="main-text-dep">
						Для предпринимателей терминалы «Городской смартфон» — <br>
						<a href="/info/business" style="text-decoration:underline;">высокоприбыльный бизнес с пассивным доходом.</a>
					</p>
				</div>					
			</div>
		</div>
	</div>		
</div>

</div>
