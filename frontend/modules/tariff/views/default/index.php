<?php

use frontend\modules\tariff\assets\TariffAsset;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\ChosenAsset;
use justinvoelker\awesomebootstrapcheckbox\ActiveField;

Yii::$app->assetManager->forceCopy = true;

$asset = TariffAsset::register($this);
$assetPath = $asset->baseUrl;

$this->title = '«CitySmartPhone»';
?>
<div class="info-default-index">
	<div class="site-index">
		<?php
			$form = ActiveForm::begin(['fieldClass' => ActiveField::className()]);
		?>	
		<div class="calculator">
			<div class="container" style="padding-top: 40px;">
				<div style="margin: 0 auto;max-width: 940px;">
					<div class="row">
						<div class="col-xs-6 col-sm-3 col-sm-offset-3">
							<a style="text-decoration:underline; text-align: right; display: block;" href="/info/citysmartscreen">CitySmartMedia</a>
						</div>
						<div class="col-xs-6 col-sm-3">
							<a style="text-decoration:underline;" href="/info/citysmartterminal">CitySmartTerminal</a>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 col-md-offset-3 page-header" style="text-align:center; line-height:40px;">Бизнес калькулятор</div>			
				</div>				
				
				<div class="row" style="margin-bottom:30px;">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<p class="main-text-dep" style="text-indent:20px; font-style:italic; text-align:center;">С помощью этого калькулятора, Вы можете прогнозировать самый минимальный доход вашего терминала.</p>				
					</div>		
					<div class="col-md-1"></div>				
				</div>			
				
				<div class="clearfix visible-xs"></div>			

				<div class="row" style="margin-top:10px; margin-bottom:20px;">
					<div class="col-md-6">
						<?if($type == 'csp'){?>
							<div class="table-responsive">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td style="padding:0; vertical-align: middle;">
												<img src="/images/terminal_first_block_1.png" alt="">
											</td>									
											<td style="padding:0;">
												<table class="table">
													<thead>
														<tr>
															<th>Количество показов <br> день/сутки</th>
															<th>Стоимость <br> размещения <br> в день</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>80 (каждые 9 мин.)</td>
															<td>62,40р.</td>
														</tr>												
														<tr>
															<td>90 (каждые 8 мин.)</td>
															<td>78,00р.</td>
														</tr>		
														<tr>
															<td>109 (каждые 7 мин.)</td>
															<td>93,60р.</td>
														</tr>												
														<tr>
															<td>120 (каждые 6 мин.)</td>
															<td>124,80р.</td>
														</tr>
														<tr>
															<td>144 (каждые 5 мин.)</td>
															<td>140,40р.</td>
														</tr>												
														<tr>
															<td>180 (каждые 4 мин.)</td>
															<td>187,20р.</td>
														</tr>			
														<tr>
															<td>240 (каждые 3 мин.)</td>
															<td>249,60р.</td>
														</tr>												
														<tr>
															<td>360 (каждые 2 мин.)</td>
															<td>327,60р.</td>
														</tr>	
														<tr>
															<td>720 (каждую 1 мин.)</td>
															<td>468,00р.</td>
														</tr>												
														<tr>
															<td>1000 (каждые 20-40 сек.)</td>
															<td>561,60р.</td>
														</tr>													
														<tr>
															<td>1500 (каждые 10-30 сек.)</td>
															<td>624,00р.</td>
														</tr>													
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td style="background:grey; border-color:grey"></td>
											<td style="background:grey; border-color:grey"></td>
										</tr>
										<tr>
											<td style="padding:0; vertical-align: middle;">
												<img src="/images/terminal_second_block_1.png" alt="">
											</td>									
											<td style="padding:0;">
												<table class="table">
													<tbody>
														<tr>
															<td>80 (каждые 9 мин.)</td>
															<td>62,40р.</td>
														</tr>												
														<tr>
															<td>90 (каждые 8 мин.)</td>
															<td>78,00р.</td>
														</tr>		
														<tr>
															<td>109 (каждые 7 мин.)</td>
															<td>93,60р.</td>
														</tr>												
														<tr>
															<td>120 (каждые 6 мин.)</td>
															<td>124,80р.</td>
														</tr>
														<tr>
															<td>144 (каждые 5 мин.)</td>
															<td>140,40р.</td>
														</tr>												
														<tr>
															<td>180 (каждые 4 мин.)</td>
															<td>187,20р.</td>
														</tr>			
														<tr>
															<td>240 (каждые 3 мин.)</td>
															<td>249,60р.</td>
														</tr>												
														<tr>
															<td>360 (каждые 2 мин.)</td>
															<td>327,60р.</td>
														</tr>	
														<tr>
															<td>720 (каждую 1 мин.)</td>
															<td>468,00р.</td>
														</tr>												
														<tr>
															<td>1000 (каждые 20-40 сек.)</td>
															<td>561,60р.</td>
														</tr>													
														<tr>
															<td>1500 (каждые 10-30 сек.)</td>
															<td>624,00р.</td>
														</tr>													
													</tbody>
												</table>
											</td>
										</tr>	
										<tr>
											<td style="background:grey; border-color:grey"></td>
											<td style="background:grey; border-color:grey"></td>
										</tr>	
										<tr>
											<td style="padding:0; vertical-align: middle;">
												<img src="/images/terminal_third_block_1.png" alt="">
											</td>									
											<td style="padding:0;">
												<table class="table">
													<tbody>
														<tr>
															<td>Таргетинговая реклама <br> во время поиска информации</td>
															<td>22,50р.</td>
														</tr>												
														<tr>
															<td>Таргетинговая реклама <br> во время телефонных разговоров</td>
															<td>45,00р.</td>
														</tr>														
													</tbody>
												</table>
											</td>
										</tr>											
									</tbody>
								</table>
							</div>
						<?}else if($type == 'cst'){?>
							<div class="table-responsive">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td style="padding:0; vertical-align: middle;">
												<img src="/images/terminal_first_block_2.png" alt="">
											</td>									
											<td style="padding:0;">
												<table class="table">
													<thead>
														<tr>
															<th>Количество показов в день</th>
															<th>Стоимость <br> размещения <br> в день</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>80 (каждые 9 мин.)</td>
															<td>62,40р.</td>
														</tr>												
														<tr>
															<td>90 (каждые 8 мин.)</td>
															<td>78,00р.</td>
														</tr>		
														<tr>
															<td>109 (каждые 7 мин.)</td>
															<td>93,60р.</td>
														</tr>												
														<tr>
															<td>120 (каждые 6 мин.)</td>
															<td>124,80р.</td>
														</tr>
														<tr>
															<td>144 (каждые 5 мин.)</td>
															<td>140,40р.</td>
														</tr>												
														<tr>
															<td>180 (каждые 4 мин.)</td>
															<td>187,20р.</td>
														</tr>			
														<tr>
															<td>240 (каждые 3 мин.)</td>
															<td>249,60р.</td>
														</tr>												
														<tr>
															<td>360 (каждые 2 мин.)</td>
															<td>327,60р.</td>
														</tr>	
														<tr>
															<td>720 (каждую 1 мин.)</td>
															<td>468,00р.</td>
														</tr>												
														<tr>
															<td>1000 (каждые 20-40 сек.)</td>
															<td>561,60р.</td>
														</tr>													
														<tr>
															<td>1500 (каждые 10-30 сек.)</td>
															<td>624,00р.</td>
														</tr>													
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td style="background:grey; border-color:grey"></td>
											<td style="background:grey; border-color:grey"></td>
										</tr>	
										<tr>
											<td style="padding:0; vertical-align: middle;">
												<img src="/images/terminal_second_block_2.png" alt="">
											</td>									
											<td style="padding:0;">
												<table class="table">
													<tbody>
														<tr>
															<td>Таргетинговая реклама <br> во время поиска информации</td>
															<td>22,50р.</td>
														</tr>																									
													</tbody>
												</table>
											</td>
										</tr>											
									</tbody>
								</table>
							</div>							
						<?}else{?>
							<div class="table-responsive">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td style="padding:0; vertical-align: middle;">
												<img src="/images/terminal_first_block_3.png" alt="">
											</td>									
											<td style="padding:0;">
												<table class="table">
													<thead>
														<tr>
															<th>Количество показов в день</th>
															<th>Стоимость <br> размещения <br> в день</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>80 (каждые 9 мин.)</td>
															<td>62,40р.</td>
														</tr>												
														<tr>
															<td>90 (каждые 8 мин.)</td>
															<td>78,00р.</td>
														</tr>		
														<tr>
															<td>109 (каждые 7 мин.)</td>
															<td>93,60р.</td>
														</tr>												
														<tr>
															<td>120 (каждые 6 мин.)</td>
															<td>124,80р.</td>
														</tr>
														<tr>
															<td>144 (каждые 5 мин.)</td>
															<td>140,40р.</td>
														</tr>												
														<tr>
															<td>180 (каждые 4 мин.)</td>
															<td>187,20р.</td>
														</tr>			
														<tr>
															<td>240 (каждые 3 мин.)</td>
															<td>249,60р.</td>
														</tr>												
														<tr>
															<td>360 (каждые 2 мин.)</td>
															<td>327,60р.</td>
														</tr>	
														<tr>
															<td>720 (каждую 1 мин.)</td>
															<td>468,00р.</td>
														</tr>												
														<tr>
															<td>1000 (каждые 20-40 сек.)</td>
															<td>561,60р.</td>
														</tr>													
														<tr>
															<td>1500 (каждые 10-30 сек.)</td>
															<td>624,00р.</td>
														</tr>													
													</tbody>
												</table>
											</td>
										</tr>											
									</tbody>
								</table>
							</div>								
						<?}?>
					</div>		
					<div class="col-md-6">
						<div class="row dropdown_calc" style="border-bottom:1px solid black; padding-bottom:5px;">
							<div class="col-xs-4 col-md-4">
								<div class="row">
									<p class="label main-text-2">Вид смартфона</p>
									<div class="form-group">
									<?if($type == 'csp'){?>
										<?= $form->field($modelTerminalForm, 'diag')->dropDownList([
											'0' => '42" (107 см)',
											'1' => '55" (140 см)',
										],[
											'class' => 'form-control selectdiagonal',
										])->label(false); ?>									
									<?}else if($type == 'cst'){?>
										<?= $form->field($modelTerminalForm, 'diag')->dropDownList([
											'0' => '42" (107 см)',
											'1' => '55" (140 см)',
										],[
											'class' => 'form-control selectdiagonal',
										])->label(false); ?>
									<?}else if($type == 'csm'){?>
										<?= $form->field($modelTerminalForm, 'diag')->dropDownList([
											'0' => '32" (81 см)',
											'1' => '42" (107 см)',
											'2' => '55" (140 см)',
											'3' => '60" (152 см)',
										],[
											'class' => 'form-control selectdiagonal',
										])->label(false); ?>									
									<?}?>
									</div>	
								</div>
							</div>								
							<div class="col-xs-4 col-md-4">
								<div class="row">
									<p class="label main-text-2">Проходимость (чел.)</p>
									<div class="form-group">
										<?= $form->field($modelTerminalForm, 'diag')->dropDownList([
											'0' => '0-1000(к+1)',
											'1' => '1000-5000(к+1.2)',
											'2' => '5000-10000(к+1.4)',
											'3' => '10000-15000(к+1.6)',
											'4' => '15000-20000(к+1.8)',
											'5' => '20000 +(к+2) ',
										],[
											'class' => 'form-control selectpassability',
										])->label(false); ?>
									</div>	
								</div>
							</div>								
							<div class="col-xs-4 col-md-4">
								<div class="row">
									<p class="label main-text-2">Время работы</p>
									<div class="form-group">
										<?= $form->field($modelTerminalForm, 'diag')->dropDownList([
											'0' => '12 часов',
											'1' => '24 часа',
										],[
											'class' => 'form-control selectworktime',
										])->label(false); ?>
									</div>	
								</div>
							</div>		
						</div>		
						<div class="row" style="margin-top:5px; border-bottom:1px solid black; padding-bottom:5px;">
							<div class="col-md-12">
								<div class="row">
									<p style="font-weight:bold;">Общий доход</p>
								</div>
								<div class="row income">
									<div class="col-xs-2 col-md-2">
										<div class="row">
											<p>В день</p>
											<p>5 929,20 р</p>
										</div>						
									</div>			
									<div class="col-xs-2 col-md-2">
										<div class="row">
											<p>В месяц</p>
											<p>133 407,00 р</p>
										</div>						
									</div>							
								</div>							
							</div>							
						</div>		
						<div class="row" style="margin-top:5px; border-bottom:1px solid black; padding-bottom:5px;">
							<div class="col-md-12">
								<div class="row">
									<p style="font-weight:bold;">Комиссии и скидки</p>
								</div>								
								<div class="row sales">
									<p style="display: inline-block; position: relative; min-height: 20px; padding-left: 25px; margin-bottom: 0; font-weight: normal; cursor: pointer;">5% Комиссия за модерацию размещаемой  информации</p>
									<?= $form->field($modelTerminalForm, 'diag')->checkboxList(
										[
											'0' => '10% Max скидка от количества выбранных для размещения экранов',
											'1' => '10% Скидка для рекламных агенств',
										],
										[
											'itemOptions' => [
												'disabled' => false,
												'divOptions' => [
													'class' => 'checkbox checkbox-info',
													'style' => 'margin-left: 10px; padding-left: 10px; padding-right: 5px;'
												],
												'class' => 'checkbox-elem'
											],
										])->label(false);
									?>               
								</div>
								<div class="row">
									<div class="col-xs-3 col-md-3">
										<div class="row">
											<div class="form-group">
												<?= $form->field($modelTerminalForm, 'diag')->dropDownList([
													'0' => '3 дней (5%)',
													'1' => '7 дней (10%)',
													'2' => '14 дней (15%)',
													'3' => '21 дней (20%)',
													'4' => '30 дней (25%)',
													'5' => '60 дней (30%)',
													'6' => '90 дней (35%)',
													'7' => '120 дней (40%)',
													'8' => '150 дней (45%)',
													'9' => '180 дней (50%)',
												],[
													'class' => 'form-control selectday',
												])->label(false); ?>
											</div>	
										</div>						
									</div>			
									<div class="col-xs-9 col-md-9">
										<div class="row">
											<p style="margin-left:20px;">Скидка для рекламодателей <br> за выбранный период размещения</p>
										</div>						
									</div>							
								</div>							
							</div>							
						</div>								
						<div class="row" style="margin-top:5px;">
							<div class="col-md-12">
								<div class="row">
									<p style="font-weight:bold;">Чистый доход</p>
								</div>
								<div class="row clearincome">
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-6 col-md-6">
												<div class="row">
													<p>В день</p>
													<p>5 929,20 р</p>
												</div>						
											</div>			
											<div class="col-xs-6 col-md-6">
												<div class="row">
													<p>В месяц</p>
													<p>133 407,00 р</p>
												</div>						
											</div>							
										</div>							
									</div>							
								</div>							
							</div>							
						</div>								
					</div>						
				</div>					
			</div>		
		</div>
		<?php ActiveForm::end(); ?>		
	</div>
</div>