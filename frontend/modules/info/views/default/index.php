<?php
use frontend\modules\info\assets\AssetBundleInfo;

Yii::$app->assetManager->forceCopy = true;

$asset = AssetBundleInfo::register($this);
$assetPath = $asset->baseUrl;
/* */
$this->title = 'CitySmartMedia';
?>
<div class="wrap">
	<div class="overlay"></div>
	<div class="banner-main">
		<div class="container" style="position: relative;">
			<div class="text-center" style="padding-top: 175px;">
				<img class="img-responsive center-block" src="<?= $assetPath.'/images/CSP-logo.png'?>"/>
				<p class="banner-desc">Разместить информацию на экранах города<br>ещё никогда небыло так просто</p>
				<button id="slider-open" class="btn btn-primary btn-primary-md">ПОДРОБНЕЕ</button>
			</div>
			<div class="banner-slider-container">
				<span class="fa fa-times-circle fa-lg text-default times"></span>
				<div class="banner-slider">
					<div class="text-center">
						<p class="banner-slider-title">Городская интелектуальная система</p>
						<div class="row" style="margin-top: 60px;">
							<div class="col-xs-12" style="padding: 0 32px 0 32px;">
								<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/banner-slider-05-05-01.png'?>"/>
							</div>
							<div class="clearfix visible-xs"></div>
							<div class="col-xs-12 text-center" style="padding: 36px 40px 0 30px;font-size: 14px;">
								<p>
									CITYSMARTMEDIA – коммуникационная система современных городов с единой интеллектуальной базой данных<br>и облачным сервисом управления.
								</p>
								<p style="margin-top: 15px;">
									CITYSMARTMEDIA объединяет между собой различные Smart-технологии, делая их более эффективными.
								</p>
							</div>
							<a class="next-slide hidden-xs hidden-sm" onclick="next_slide()">Современные технологии ></a>
						</div>
					</div>
					<div class="text-center">
						<p class="banner-slider-title">Современные технологии</p>
						<div class="row" style="margin-top: 45px;">
							<div class="col-xs-12 visible-xs" style="padding: 8px 32px 0 32px;">
								<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/banner-slider-05-05-02.png'?>"/>
							</div>
							<div class="clearfix visible-xs"></div>
							<div class="col-xs-12 text-left visible-xs" style="padding: 30px 30px 0 30px;font-size: 14px;">
								<p>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Разместить информацию на мультимедийных экранах города еще никогда не было так просто.
									Система CITYSMARTMEDIA позволяет сделать это за считанные минуты и абсолютно бесплатно.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Чтобы подать объявление, поздравить друзей и близких или разместить рекламу на городских
									мультимедийных экранах не нужно обращаться к специалистам, тратить время и деньги.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									В сервисе размещения информации <a href="/adv/add">SMART MEDIA</a> представлены различные шаблоны. Заполните понравившийся шаблон или загрузите свой материал, выберите интересующие адреса установки мультимедийных экранов, время трансляции и кликните на «отправить». После обязательной процедуры модерации, информация станет  транслироваться на экранах, соответствующих вашему выбору.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Интерфейс и порядок размещения информации в сервисе «SMART MEDIA» прост и интуитивно понятен каждому.
								</p>
							</div>
							<div class="col-sm-6 col-sm-offset-1 text-left hidden-xs" style="padding: 0 5px 0 0;font-size: 14px;">
								<p>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Разместить информацию на мультимедийных экранах города еще никогда не было так просто.
									Система CITYSMARTMEDIA позволяет сделать это за считанные минуты и абсолютно бесплатно.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Чтобы подать объявление, поздравить друзей и близких или разместить рекламу на городских
									мультимедийных экранах не нужно обращаться к специалистам, тратить время и деньги.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									В сервисе размещения информации <a href="/adv/add">SMART MEDIA</a> представлены различные шаблоны. Заполните понравившийся шаблон или загрузите свой материал, выберите интересующие адреса установки мультимедийных экранов, время трансляции и кликните на «отправить». После обязательной процедуры модерации, информация станет  транслироваться на экранах, соответствующих вашему выбору.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Интерфейс и порядок размещения информации в сервисе «SMART MEDIA» прост и интуитивно понятен каждому.
								</p>
							</div>
							<div class="col-sm-5 hidden-xs" style="padding: 8px 32px 0 32px;">
								<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/banner-slider-05-05-02.png'?>"/>
							</div>
							<a class="next-slide hidden-xs hidden-sm" onclick="next_slide()">Новые решения ></a>
						</div>
					</div>
					<div class="text-center">
						<p class="banner-slider-title">Новые решения</p>
						<div class="row" style="margin-top: 65px;">
							<div class="col-xs-12 col-sm-5" style="padding: 8px 32px 0 32px;">
								<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/banner-slider-05-05-03.png'?>"/>
							</div>
							<div class="clearfix visible-xs"></div>
							<div class="col-xs-12 text-left visible-xs" style="padding: 30px 30px 0 30px;font-size: 14px;">
								<p>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Городские смартфоны – новый вид интерактивных терминалов, разработанный компанией CITYSMARTMEDIA.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Функционал терминалов <a href="/info/terminals">ГОРОДСКОЙ СМАРТФОН</a> повторяет функционал обычных смартфонов. Главное отличие – огромный размер и  локальные сервисы, которые позволят пользователям получить подробную информацию о месте, в котором установлен городской смартфон, помогут легко найти все компании, службы, магазины и прочие организации, расположенные на данном адресе и связаться с ними в один клик.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Все функции и сервисы городского смартфона, в том числе и телефонная связь, бесплатные для пользователя.
								</p>
							</div>
							<div class="col-sm-7 text-left hidden-xs" style="padding: 0 50px 0 7px;font-size: 14px;">
								<p>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Городские смартфоны – новый вид интерактивных терминалов, разработанный компанией CITYSMARTMEDIA.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Функционал терминалов <a href="/info/terminals">ГОРОДСКОЙ СМАРТФОН</a> повторяет функционал обычных смартфонов. Главное отличие – огромный размер и  локальные сервисы, которые позволят пользователям получить подробную информацию о месте, в котором установлен городской смартфон, помогут легко найти все компании, службы, магазины и прочие организации, расположенные на данном адресе и связаться с ними в один клик.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Все функции и сервисы городского смартфона, в том числе и телефонная связь, бесплатные для пользователя.
								</p>
							</div>
							<a class="next-slide hidden-xs hidden-sm" onclick="next_slide()">Интеллектуальная база данных ></a>
						</div>
					</div>
					<div class="text-center">
						<p class="banner-slider-title">Интеллектуальная база данных</p>
						<div class="row" style="margin-top: 55px;">
							<div class="col-xs-12 visible-xs" style="10px 32px 0 32px">
								<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/banner-slider-05-05-04.png'?>"/>
							</div>
							<div class="clearfix visible-xs"></div>
							<div class="col-xs-12 text-left visible-xs" style="padding: 30px 30px 0 30px;font-size: 14px;">
								<p>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="/catalog">УМНЫЙ СПРАВОЧНИК</a> — это единый справочник контактов на всех городских смартфонах и интерактивных терминалах, подключенных к системе CITYSMARTMEDIA.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Интерактивные визитки справочника позволяют бесплатно связаться с их владельцами по голосовой или видео связи, написать им сообщение или получить более полную информацию о них, например, перейти на сайт компании.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Горожане могут размещать свои визитки в справочнике и управлять информацией в них с любого компьютера или смартфона.
								</p>
							</div>
							<div class="col-sm-6 col-sm-offset-1 text-left hidden-xs" style="padding: 0 5px 0 0;font-size: 14px;">
								<p>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="/catalog">УМНЫЙ СПРАВОЧНИК</a> — это единый справочник контактов на всех городских смартфонах и интерактивных терминалах, подключенных к системе CITYSMARTMEDIA.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Интерактивные визитки справочника позволяют бесплатно связаться с их владельцами по голосовой или видео связи, написать им сообщение или получить более полную информацию о них, например, перейти на сайт компании.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Горожане могут размещать свои визитки в справочнике и управлять информацией в них с любого компьютера или смартфона.
								</p>
							</div>
							<div class="col-sm-5 hidden-xs" style="10px 32px 0 32px">
								<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/banner-slider-05-05-04.png'?>"/>
							</div>
							<a class="next-slide hidden-xs hidden-sm" onclick="next_slide()">Высокоэффективная рекламная платформа ></a>
						</div>
					</div>
					<div class="text-center">
						<p class="banner-slider-title">Высокоэффективная рекламная платформа</p>
						<div class="row" style="margin-top: 15px;">
							<div class="col-xs-12 col-sm-5" style="padding: 45px 32px 0 32px;">
								<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/banner-slider-05-05-05.png'?>"/>
							</div>
							<div class="clearfix visible-xs"></div>
							<div class="col-xs-12 text-left visible-xs" style="padding: 30px 30px 0 30px;font-size: 14px;">
								<p>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Популярность у населения городских смартфонов и интерактивных терминалов, подключенных к системе CSM, а также удобство и низкая стоимость размещения информации в ней, делают CITYSMARTMEDIA одной из самых эффективных рекламных платформ.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Реклама на городских смартфонах и интерактивных терминалах совмещает в себе все преимущества «имиджевой» наружной рекламы и интерактивной рекламы в интернете.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Главное преимущество – возможность для потенциальных клиентов здесь и сейчас получить более полную информацию о рекламируемых товарах и услугах, оформить заказ, бесплатно связаться с рекламодателем, написать ему или заказать обратный звонок в удобное для клиента время.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Люди сами обращаются к городским смартфонам и интерактивным терминалам для получения бесплатных услуг и остаются лояльными к рекламе на них.
								</p>
							</div>
							<div class="col-sm-7 text-left hidden-xs" style="padding: 10px 60px  0 0;font-size: 14px;">
								<p>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Популярность у населения городских смартфонов и интерактивных терминалов, подключенных к системе CSM, а также удобство и низкая стоимость размещения информации в ней, делают CITYSMARTMEDIA одной из самых эффективных рекламных платформ.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Реклама на городских смартфонах и интерактивных терминалах совмещает в себе все преимущества «имиджевой» наружной рекламы и интерактивной рекламы в интернете.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Главное преимущество – возможность для потенциальных клиентов здесь и сейчас получить более полную информацию о рекламируемых товарах и услугах, оформить заказ, бесплатно связаться с рекламодателем, написать ему или заказать обратный звонок в удобное для клиента время.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Люди сами обращаются к городским смартфонам и интерактивным терминалам для получения бесплатных услуг и остаются лояльными к рекламе на них.
								</p>
							</div>
							<a class="next-slide hidden-xs hidden-sm" onclick="next_slide()">Бизнес-платформа ></a>
						</div>
					</div>
					<div class="text-center">
						<p class="banner-slider-title">Бизнес-платформа</p>
						<div class="row" style="margin-top: 15px;">
							<div class="col-xs-12 visible-xs" style="padding: 55px 32px 0 32px;">
								<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/banner-slider-05-05-06.png'?>"/>
							</div>
							<div class="clearfix visible-xs"></div>
							<div class="col-xs-12 text-left visible-xs" style="padding: 30px 30px 0 30px;font-size: 14px;">
								<p>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									К системе CITYSMARTMEDIA возможно подключить любые мультимедийные экраны и интерактивные терминалы.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="/info/smart-shop">SMART SHOP</a> — интернет-магазин мультимедийных экранов, интерактивных терминалов и комплектующих для них, в котором каждый производитель может выставлять свою продукцию.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="/info/smart-soft">SMART SOFT</a> — сервис, в котором собственники интерактивных терминалов и городских смартфонов могут скачивать различные приложения и сервисы для своих устройств, а разработчики предлагать свои решения.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="/info/smart-design">SMART DESIGN</a> — сервис, в котором можно заказать разработку индивидуального дизайна терминалов, информационных материалов или видеороликов. Достаточно разместить заявку с указанием суммы вознаграждения за выполненную работу и вам предложат свои решения дизайнеры, которых устроят ваши условия. Вам останется только выбрать лучшие из них.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Для инвесторов и предпринимателей продукты и решения CITYSMARTMEDIA – <a href="/info/business">высокоприбыльный бизнес с пассивным доходом.</a>
								</p>
							</div>
							<div class="col-sm-6 col-sm-offset-1 text-left hidden-xs" style="padding: 10px 5px 0 0;font-size: 14px;">
								<p>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									К системе CITYSMARTMEDIA возможно подключить любые мультимедийные экраны и интерактивные терминалы.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="/info/smart-shop">SMART SHOP</a> — интернет-магазин мультимедийных экранов, интерактивных терминалов и комплектующих для них, в котором каждый производитель может выставлять свою продукцию.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="/info/smart-soft">SMART SOFT</a> — сервис, в котором собственники интерактивных терминалов и городских смартфонов могут скачивать различные приложения и сервисы для своих устройств, а разработчики предлагать свои решения.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="/info/smart-design">SMART DESIGN</a> — сервис, в котором можно заказать разработку индивидуального дизайна терминалов, информационных материалов или видеороликов. Достаточно разместить заявку с указанием суммы вознаграждения за выполненную работу и вам предложат свои решения дизайнеры, которых устроят ваши условия. Вам останется только выбрать лучшие из них.
								</p>
								<p style="margin-top: 15px;">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Для инвесторов и предпринимателей продукты и решения CITYSMARTMEDIA – <a href="/info/business">высокоприбыльный бизнес с пассивным доходом.</a>
								</p>
							</div>
							<div class="col-sm-5 hidden-xs" style="padding: 55px 32px 0 32px;">
								<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/banner-slider-05-05-06.png'?>"/>
							</div>
							<a class="next-slide hidden-xs hidden-sm" onclick="next_slide()">Мобильные приложения ></a>
						</div>
					</div>
					<div class="text-center">
						<p class="banner-slider-title">Прогрессивное развитие</p>
						<div class="row" style="margin-top: 38px;">
							<div class="col-xs-12 col-md-12" style="padding: 0 32px 0 32px;">
								<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/banner-slider-05-05-08.png'?>"/>
							</div>
							<div class="clearfix visible-xs"></div>
							<div class="col-xs-12 col-md-12 text-center" style="padding: 7px 40px 0 30px;font-size: 14px;">
								<p>
									Мы знаем, чего не хватает жителям совремнных городов.<br>
									У нас в разработке много новых Smart продуктов и решений, которые мы скоро представим Вам.
								</p>
							</div>
						</div>
						<a class="next-slide hidden-xs" onclick="next_slide()">Городская интелектуальная система ></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="slider-main">
		<div class="container text-center">
			<h1 style="padding-bottom: 35px">Продукты и решения</h1>
			<div class="slider">
				<div>
					<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/0-01.png'?>"/>
					<p class="title page-subtitle">Интерактивные терминалы</p>
					<a class="btn btn-success" href="/info/citysmartterminal">ПОДРОБНЕЕ</a>
				</div>
				<div>
					<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/0-02.png'?>"/>
					<p class="title page-subtitle">Мультимедийные экраны</p>
					<a class="btn btn-success" href="/info/citysmartscreen">ПОДРОБНЕЕ</a>
				</div>
				<div>
					<img class="img-responsive center-block" src="<?= $assetPath.'/images/products/0-03.png'?>"/>
					<p class="title page-subtitle">Городские смартфоны</p>
					<a class="btn btn-success" href="/info/terminals">ПОДРОБНЕЕ</a>
				</div>
			</div>
		</div>
	</div>
</div>
