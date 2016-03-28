<?php
use frontend\modules\info\assets\AssetBundleInfo;

Yii::$app->assetManager->forceCopy = true;

$asset = AssetBundleInfo::register($this);
$assetPath = $asset->baseUrl;

$this->title = 'CitySmartMedia';
?>
	<div class="state authorities">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 style="margin-bottom: 0px; margin-top: 50px; text-transform:uppercase;">Городской смартфон на службе у государства</h1>
				</div>
			</div>		
			<div class="row">
				<div class="col-md-12 text-center">
					<p style="font-weight:bold; margin-bottom:50px; margin-top:20px; font-size:14px;">Терминалы «Городской смартфон» упрощают решение ряда общественных проблем<br>
и является инструментом для воплощения многих социальных проектов.</p>
				</div>
			</div>				
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">		
					<div class="row">
					<div class="col-sm-6 col-md-6 visible-xs">
						<img src="/images/terminal-2.png" alt=""   class="img-responsive center-block" style="margin-top:-40px; margin-bottom:0px;">
					</div>
					<div class="col-sm-6 col-md-8">					
							<div class="row">
							</div>					
							<div class="row">
								<div class="col-xs-11 col-sm-12 col-md-10 col-md-offset-2 col-xs-offset-1">	
									<div class="row">
										<p style="font-weight:bolder; margin-top:20px;"> • «Информационное общество»<br> 
											• «Доступная среда»<br>
											• «Развитие культуры и туризма»<br>
											• «Безопасный город»<br>
											• «Народный налоговый контроль»<br>
											• «Система обеспечения вызова экстренных служб 112»<br>
											• «Программа подготовки ЧМ по футболу в 2018 году»<br>
											• «Интернетизация городов и населенных пунктов»
										</p>
									</div>													
								</div>					
							</div>		
							<div class="row">
								<div class="col-md-2"></div>
								<div class="col-md-10">										
									<div class="row" style=" border:1px solid #1976D2; padding: 10px 20px; padding-bottom:0px; margin-top:20px;">
										<p style="font-weight:bolder; margin-top:0px; text-indent:10px;">Использование терминалов «Городской смартфон»<br>не требует дополнительных расходов из бюджета,<br>а наоборот приносит доход в казну.</p>
									</div>					
								</div>							
							</div>								
						</div>
						<div class="col-sm-6 col-md-4 hidden-xs">
							<img src="/images/terminal-2.png" alt=""> 				
						</div>
					</div>
				</div>	
				<div class="col-md-2"></div>				
			</div>		
			<div class="row">
				<div class="col-md-12 text-center">
					<p style="font-weight:bold; margin-bottom:50px; margin-top:20px; font-size:14px;">Вы можете приобрести городские смартфоны и установить их<br> 
					на подконтрольных территориях или выделить места под их установку<br> 
					и объявить конкурс на аренду данных мест.
					</p>
				</div>
			</div>		
			<div class="row"  style="margin-bottom:80px;">
				<div class="col-md-12 text-center">
					<div class="col-md-2"></div>
					<div class="col-md-8">	
						<div class="row">
							<div class="col-sm-6 col-md-6">																	
								<div class="row">
									<div class="col-xs-2 col-md-2"></div>
									<div class="col-xs-8 col-md-8">	
										<a href="/info/smart-shop" class="btn btn-primary btn-primary-md a-btn-style-md" style="text-transform:uppercase; margin-top:5px; margin-bottom:30px; display:block;">КУПИТЬ</a>
									</div>		
									<div class="col-xs-2 col-md-2"></div>										
								</div>							
							</div>							
							<div class="col-sm-6 col-md-6">									
								<div class="row">
									<div class="col-xs-2 col-md-2"></div>
									<div class="col-xs-8 col-md-8">	
										<a class="btn btn-primary btn-primary-md a-btn-style-md" href="/terminals/feature" style="text-transform:uppercase; margin-top:5px; display:block;">Заявка на установку</a>
									</div>		
									<div class="col-xs-2 col-md-2"></div>										
								</div>								
							</div>
						</div>
					</div>
					<div class="col-md-2"></div>					
				</div>
			</div>				
		</div>		
	</div>		