<?php
/* @var $modelTerminalForm \frontend\models\TTerminal */

use frontend\components\widgets\WidgetUpload;
use frontend\modules\tariff\components\Tariffing;
use frontend\modules\terminals\TerminalsAssets\TerminalsAsset;
use yii\bootstrap\Html;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use frontend\assets\ChosenAsset;

Yii::$app->assetManager->forceCopy = true;

ChosenAsset::register($this);
$asset = TerminalsAsset::register($this);
$assetPath = $asset->baseUrl;

$userAgentInfo = Yii::$app->userAgentParser->getUserAgentObject();
$this->title = 'Управление терминалами';

//print_r(Yii::$app->tariffing->calculationTariff(40, 415, 3, 540, 4, 55, 24, 1200)); //$id_terminal, $type, $day_count, $period, $place, $diag, $worktime, $passability;

?>
<div class="offerplaces">
	<div class="container">
		<?php
			$form = ActiveForm::begin();
		?>
		<div class="row">
			<div class="col-md-12 text-center">
				<h1>Заявка на установку  городского смартфона</h1>
			</div>
		</div>	
		
		<div class="row">
			<div class="col-md-12 text-center">
				<h2>Характеристики места установки</h2>
			</div>
		</div>		
		
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-xs-1 col-md-1"></div>
					<div class="col-xs-10 col-md-10">
						<div class="row" style="margin-top:30px;">
							<p style="font-weight:bold; text-align:center;">Категория</p>
							<?= $form->field($modelTerminalForm, 'category_place')->dropDownList($modelTerminalForm->CategoryPlacesList, [
								'class'  => 'form-control chosen-choices placecity',
								'prompt' => Yii::t('app', 'Выберете категорию')
							])->label(false) ?>
						</div>
					</div>	
					<div class="col-xs-1 col-md-1"></div>				
				</div>
				<div class="row">
					<div class="col-xs-1 col-md-1"></div>
					<div class="col-xs-10 col-md-10">
						<div class="row" style="margin-top:30px;">
							<p style="font-weight:bold; text-align:center;">Название места</p>
							<div class="form-group">
								<?= $form->field($modelTerminalForm, 'place')->textInput(['class'  => 'form-control placename', 'placeholder' => Yii::t('app', 'Введите название места')])->label(false) ?>
							</div>
						</div>
					</div>	
					<div class="col-xs-1 col-md-1"></div>				
				</div>					
			</div>	
			<div class="col-md-4"></div>				
		</div>	

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-xs-1 col-md-1"></div>
					<div class="col-xs-10 col-md-10">
						<div class="row city_places">
							<p class="title">Адрес</p>
							<p class="label main-text-2">Город</p>
							<?= $form->field($modelTerminalForm, 'city')->dropDownList($modelTerminalForm->cityList, [
								'class'  => 'form-control chosen-choices',
								'prompt' => Yii::t('app', 'Выберете город')
							])->label(false) ?>
						</div>
						<div class="row street">
							<p class="label main-text-2">Улица</p>
							<div class="form-group">				
								<?= $form->field($modelTerminalForm, 'street')->textInput(['class'  => 'form-control placestreet', 'placeholder' => Yii::t('app', 'Введите улицу')])->label(false) ?>
							</div>
						</div>						
					</div>	
					<div class="col-xs-1 col-md-1"></div>				
				</div>	
			</div>	
			<div class="col-md-4"></div>				
		</div>	

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-xs-1 col-md-1"></div>
					<div class="col-xs-5 col-md-5">
						<div class="row house">
							<p class="label main-text-2">Дом</p>
							<div class="form-group">
								<?= $form->field($modelTerminalForm, 'house')->textInput(['class'  => 'form-control placehouse', 'placeholder' => Yii::t('app', 'Введите дом')])->label(false) ?>
							</div>
						</div>						
					</div>
					<div class="col-xs-1 col-md-1"></div>
					<div class="col-xs-4 col-md-4">
						<div class="row">
							<p class="label main-text-2" style="font-weight:300; text-align:left; color:black; margin-left:-5px;">Корпус</p>
							<div class="form-group">
								<?= $form->field($modelTerminalForm, 'housing')->textInput(['class'  => 'form-control placehousing', 'placeholder' => Yii::t('app', 'Введите корпус')])->label(false) ?>
							</div>
						</div>						
					</div>								
				</div>	
			</div>	
			<div class="col-md-4"></div>				
		</div>	
		
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-xs-1 col-md-3"></div>
					<div class="col-xs-10 col-md-6">
						<div class="row" style="margin-top:30px;">
							<p style="font-weight:bold; text-align:center;">Проходимость</p>
							<p class="label main-text-2" style="font-weight:300; text-align:left; color:black; margin-left:-5px;">Человек в день</p>
							<div class="form-group">
								<?= $form->field($modelTerminalForm, 'passability')->textInput(['class'  => 'form-control passability'])->label(false) ?>
							</div>
						</div>
					</div>	
					<div class="col-xs-1 col-md-3"></div>				
				</div>					
			</div>	
			<div class="col-md-4"></div>				
		</div>

		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="row">
					<div class="col-xs-1 col-md-1"></div>
					<div class="col-xs-10 col-md-10">
						<div class="row" style="margin-top:30px; margin-bottom: 30px;">
							<p style="font-weight:bold; text-align:center;">Режим работы</p>
							<?php if($userAgentInfo->browser == 'Opera') {
								if($userAgentInfo->version < 13) {
									echo $form->field($modelTerminalForm, 'worktime')
										->inline(true)
										->radioList(['12' => '12 часов', '24' => '24 часа'],
											[
												'item' => function($index, $label, $name, $checked, $value) {
													if($checked)
													$checked = 'checked';
												
													$return = '<div style="float: left; padding: 0 10px 0 10px;" class="worktimeblock worktime_opera">';
													$return .= '<input id="radio-style-'.$value.'" type="radio" name="' . $name . '" value="'.$value.'" style="outline: none;" '.$checked.' onclick="radioWorkModeClick(this)">';
													$return .= '<label style="margin-left:5px;" for="radio-style-'.$value.'">'.$label.'</label>';
													$return .= '</div>';
													return $return;
												}

												//'separator'=>false,
											])->label(false);
								}
							} else {
								echo $form->field($modelTerminalForm, 'worktime')
									->inline(true)
									->radioList(['12' => '12 часов', '24' => '24 часа'],
										[
											'item' => function($index, $label, $name, $checked, $value) {
												if($checked) {
													$checked = 'checked';
												}
												$return = '<div class="radio radio-info worktimeblock" style="margin: 0 10px 0 0; float: left;">';
												$return .= '<input id="radio-style-'.$value.'" type="radio" name="' . $name . '" value="'.$value.'" style="outline: none;" '.$checked.' onclick="radioWorkModeClick(this)">';
												$return .= '<label for="radio-style-'.$value.'">'.$label.'</label>';
												$return .= '</div>';
												return $return;
											}
										])->label(false);
							}
							?>
						</div>
					</div>
					<div class="col-xs-1 col-md-1"></div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="row text-center">
					<div class="col-xs-1 col-md-1"></div>
						<div class="col-xs-10 col-md-10">
							<div class="row" style="margin-top:0px;">
								<p style="font-weight:bold; text-align:center;">Количество мест установки</p>
								<div class="form-group image-block">		
									<div class="some-image">
										<div>
											<span class="count-image">1)</span>
											<div class="attachfile">
												<input id="upload_image" class="btn btn-default" onclick="return false;">
												<div>Прикрепить фотографию</div>
											</div>	
											<span class="add_image" onclick="add_image_file($(this));">+</span>																		
										</div>
										<div>
											<div class="media">
												<div class="upload_image">
													<img id="selector_image">
												</div>
											</div>
											 
											<?=WidgetUpload::widget([
												"upload_button" => [
													"upload_image",
												],
												"input_name" => [
													"upload_image" => "id_file_image",
												],
												"selector_file" => [
													"upload_image" => "selector_image",
												],
												"image_terminal" => true,
												"extensions" => "gif|jpg|jpeg|png",
											]);?>
										</div>
									</div>								
								</div>	
								<div class="attached_file">
									<input name="TTerminal[attached]" value="">
								</div>	
							</div>	
						</div>	
					<div class="col-xs-1 col-md-1"></div>				
				</div>					
			</div>	
			<div class="col-md-4"></div>				
		</div>			

		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 text-center">
				<div class="line" style="background:black; height:1px; margin-top:30px;"></div>
			</div>
			<div class="col-md-3"></div>			
		</div>		

		<div class="row">
			<div class="col-md-12 text-center">
				<h2 style="margin-bottom: 0px; margin-top: 30px;">Условия установки</h2>
			</div>
		</div>				

		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-xs-1 col-md-3"></div>
					<div class="col-xs-10 col-md-6">
						<div class="row" style="margin-top:30px;">
							<p style="font-weight:bold; text-align:center;">Интернет</p>							
						</div>
					</div>	
					<div class="col-xs-1 col-md-3"></div>				
				</div>
									
			</div>	
			<div class="col-md-4"></div>				
		</div>	

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8 text-center">
				<div class="row">
					<div class="form-group giveinternet">					
						<?php if($userAgentInfo->browser == 'Opera') {
							if($userAgentInfo->version < 13) {
								echo $form->field($modelTerminalForm, 'internet_give')
									->inline(true)
									->radioList(['1' => 'Предоставляю', '0' => 'Самостоятельное подключение <br> собственником терминала'],
										[
											'item' => function($index, $label, $name, $checked, $value) {
												if($checked)
													$checked = 'checked';
												
												if($value == '1'){
													$class = 'left-side';
												}else{
													$class = '';
												}
												$return  = '<div class="col-xs-6 col-md-6 '.$class.'">';			
												$return .= '<div class="form-group field-tterminal-workmode">';
												$return .= '<div>';
												$return .= '<div style="float: left; padding: 0 10px 0 10px;">';
												$return .= '<input id="internet-give-'.$value.'" type="radio" name="' . $name . '" value="'.$value.'" style="outline: none;" '.$checked.' onclick="radioWorkModeClick(this)">';
												$return .= '<label for="internet-give-'.$value.'">'.$label.'</label>';
												$return .= '</div>';
												$return .= '</div>';
												$return .= '<p class="help-block help-block-error"></p>';
												$return .= '</div>';				
												$return .= '</div>';	
												
												return $return;
											}
										])->label(false);
							}
						} else {
							echo $form->field($modelTerminalForm, 'internet_give')
								->inline(true)
								->radioList(['1' => 'Предоставляю', '0' => 'Самостоятельное подключение <br> собственником терминала'],
									[
										'item' => function($index, $label, $name, $checked, $value) {
												if($checked) {
													$checked = 'checked';
												}
												
												if($value == '1'){
													$class = 'left-side';
												}else{
													$class = '';
												}
												
												$return  = '<div class="col-xs-6 col-md-6 '.$class.'">';				
												$return .= '<div class="form-group field-tterminal-workmode">';
												$return .= '<div >';
												$return .= '<div class="radio">';
												$return .= '<input id="internet-give-'.$value.'" type="radio" name="' . $name . '" value="'.$value.'" style="outline: none;" '.$checked.' onclick="radioWorkModeClick(this)">';
												$return .= '<label for="internet-give-'.$value.'">'.$label.'</label>';
												$return .= '</div>';
												$return .= '</div>';
												$return .= '<p class="help-block help-block-error"></p>';
												$return .= '</div>';				
												$return .= '</div>';
												
												return $return;
										}
									])->label(false);
							}
						?>						
					</div>								
				</div>									
			</div>	
			<div class="col-md-2"></div>				
		</div>	
		
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-xs-1 col-md-2"></div>
					<div class="col-xs-10 col-md-8">
						<div class="row">													
							<div class="form-group payinternet" style="margin-bottom:0px; margin-top:-10px; display:none;">				
								<div class="form-group internettype">									
									<?php if($userAgentInfo->browser == 'Opera') {
										if($userAgentInfo->version < 13) {
											echo $form->field($modelTerminalForm, 'internet_type')
												->inline(true)
												->radioList(['1' => 'Платно', '0' => 'Бесплатно'],
													[
														'item' => function($index, $label, $name, $checked, $value) {
															if($checked)
																$checked = 'checked';
															
															$return  = '<div style="float:left; padding: 0 10px 0 10px;">';			
															$return .= '<div class="form-group field-tterminal-workmode internet_opera">';
															$return .= '<div>';
															$return .= '<input id="internet-type-'.$value.'" type="radio" name="' . $name . '" value="'.$value.'" style="outline: none; display:inline-block;" '.$checked.' onclick="radioWorkModeClick(this)">';
															$return .= '<label style="display:inline-block; margin-left:5px;" for="internet-type-'.$value.'">'.$label.'</label>';
															$return .= '</div>';
															$return .= '<p class="help-block help-block-error"></p>';
															$return .= '</div>';				
															$return .= '</div>';	
															
															return $return;
														}
													])->label(false);
										}
									} else {
										echo $form->field($modelTerminalForm, 'internet_type')
											->inline(true)
											->radioList(['1' => 'Платно', '0' => 'Бесплатно'],
												[
													'item' => function($index, $label, $name, $checked, $value) {
															if($checked) {
																$checked = 'checked';
															}
															
															$return  = '<div class="col-xs-6 col-md-6">';				
															$return .= '<div class="form-group field-tterminal-workmode">';
															$return .= '<div >';
															$return .= '<div class="radio">';
															$return .= '<input id="internet-type-'.$value.'" type="radio" name="' . $name . '" value="'.$value.'" style="outline: none;" '.$checked.' onclick="radioWorkModeClick(this)">';
															$return .= '<label for="internet-type-'.$value.'">'.$label.'</label>';
															$return .= '</div>';
															$return .= '</div>';
															$return .= '<p class="help-block help-block-error"></p>';
															$return .= '</div>';				
															$return .= '</div>';
															
															return $return;
													}
												])->label(false);
										}
									?>															
							</div>		
							</div>		
							<div class="paysumminternet" style="display:none;">
								<p class="label" style="font-weight:300; text-align:left; color:black; margin-left:-5px;">Плата в месяц (руб.)</p>
								<div class="form-group">
									<?= $form->field($modelTerminalForm, 'internet_price')->textInput(['class'  => 'form-control'])->label(false) ?>									
								</div>
							</div>
						</div>
					</div>	
					<div class="col-xs-1 col-md-2"></div>				
				</div>								
			</div>	
			<div class="col-md-4"></div>				
		</div>			
		
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-xs-1 col-md-1"></div>
					<div class="col-xs-10 col-md-10">
						<div class="row" style="margin-top:30px;">
							<p style="font-weight:bold; text-align:center;">Аренда места под терминал</p>
							<div class="form-group rent">					
								<div>
									<?php if($userAgentInfo->browser == 'Opera') {
										if($userAgentInfo->version < 13) {
											echo $form->field($modelTerminalForm, 'arenda_type')
												->inline(true)
												->radioList(['1' => 'Платно', '0' => 'Бесплатно', '2' => 'Тендер'],
													[
														'item' => function($index, $label, $name, $checked, $value) {
															if($checked)
																$checked = 'checked';
															

															$return .= '<div class="rent_opera"  style="float: left; padding: 0 10px 0 10px;">';
															$return .= '<input id="arenda-type-'.$value.'" type="radio" name="' . $name . '" value="'.$value.'" style="outline: none;" '.$checked.' onclick="radioWorkModeClick(this)">';
															$return .= '<label for="arenda-type-'.$value.'">'.$label.'</label>';
															$return .= '<p class="help-block help-block-error"></p>';
															$return .= '</div>';				

															
															return $return;
														}
													])->label(false);
										}
									} else {
										echo $form->field($modelTerminalForm, 'arenda_type')
											->inline(true)
											->radioList(['1' => 'Платно', '0' => 'Бесплатно', '2' => 'Тендер'],
												[
													'item' => function($index, $label, $name, $checked, $value) {
															if($checked) {
																$checked = 'checked';
															}
															
															$return  = '<div class="col-xs-4 col-md-4">';				
															$return .= '<div class="form-group field-tterminal-workmode">';
															$return .= '<div >';
															$return .= '<div class="radio">';
															$return .= '<input id="arenda-type-'.$value.'" type="radio" name="' . $name . '" value="'.$value.'" style="outline: none;" '.$checked.' onclick="radioWorkModeClick(this)">';
															$return .= '<label for=arenda-type-'.$value.'">'.$label.'</label>';
															$return .= '</div>';
															$return .= '</div>';
															$return .= '<p class="help-block help-block-error"></p>';
															$return .= '</div>';				
															$return .= '</div>';
															
															return $return;
													}
												])->label(false);
										}
									?>										
								</div>						
							</div>								
							<div class="rentsumm" style="display:none;">								
								<p class="label" style="font-weight:300; text-align:left; color:black; margin-left:-5px;">Плата в месяц (руб.)</p>
								<div class="form-group rentsumm">
									<?= $form->field($modelTerminalForm, 'arenda_price')->textInput(['class'  => 'form-control'])->label(false) ?>											
								</div>
							</div>
							<div class="renttender" style="display:none;">								
								<div class="form-group" style="margin-top:20px;">
									<?= $form->field($modelTerminalForm, 'tender_type')->dropDownList([
										'0' => 'Открытый',
										'1' => 'Закрытый',
									],[
										'class' => 'form-control selecttender',
									])->label(false) ?>
								</div>		
								<div class="form-group url">
									<p class="label" style="font-weight:300; text-align:left; color:black; margin-left:-5px;">Внешняя ссылка</p>
									<?= $form->field($modelTerminalForm, 'tender_url')->textInput(['class'  => 'form-control'])->label(false) ?>		
								</div>									
								<div class="form-group cost">
									<p class="label" style="font-weight:300; text-align:left; color:black; margin-left:-5px;">Стартовая цена</p>
									<?= $form->field($modelTerminalForm, 'tender_start_price')->textInput(['class'  => 'form-control'])->label(false) ?>		
								</div>									
								<div class="form-group tender" style="margin-top:20px;">
										<label style="font-weight:normal;">Срок тендера до</label>
										<?=DatePicker::widget([
											'language' => 'ru',
											'name' => 'TTerminal[tender_end_date]',
											'type' => DatePicker::TYPE_COMPONENT_APPEND,
											'layout' => '{input}{picker}',
											'value' => Yii::$app->formatter->asDate(time(), "php:d.m.Y"),
											'options' => [
												'class' => 'period-picker',
											],
											'pickerButton' => '<span class="input-group-addon kv-field-separator calendar-button-style">
																				<svg width="18" height="18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink= "http://www.w3.org/1999/xlink">
																					<image xlink:href="/images/activeCAL.svg" x="0" y="0" height="18px" width="18px"/>
																				</svg>
																		   </span>',
											'buttonOptions' => 'label',
											'pluginOptions' => [
												'todayHighlight' => true,
												'todayBtn' => true,
												'format' => 'dd.mm.yyyy',
												'autoclose' => true,
											]
										]);?>
								</div>														
							</div>							
						</div>
					</div>	
					<div class="col-xs-1 col-md-1"></div>				
				</div>		

				<div class="row">
					<div class="col-xs-1 col-md-2"></div>
						<div class="col-xs-10 col-md-8">
							<div class="row" style="margin-top:30px;">
								<p style="font-weight:bold; text-align:center;">Электричество</p>						
								<div class="form-group electricity">					
									<?php if($userAgentInfo->browser == 'Opera') {
										if($userAgentInfo->version < 13) {
											echo $form->field($modelTerminalForm, 'elec_type')
												->inline(true)
												->radioList(['1' => 'Платно', '0' => 'Бесплатно'],
													[
														'item' => function($index, $label, $name, $checked, $value) {
															if($checked)
																$checked = 'checked';
															
															$return  = '<div style="float:left; padding: 0 10px 0 10px;">';			
															$return .= '<div class="form-group field-tterminal-workmode electricity_opera">';
															$return .= '<div>';
															$return .= '<input id="elec-type-'.$value.'" type="radio" name="' . $name . '" value="'.$value.'" style="outline: none; display:inline-block;" '.$checked.' onclick="radioWorkModeClick(this)">';
															$return .= '<label style="display:inline-block; margin-left:5px;" for="elec-type-'.$value.'">'.$label.'</label>';
															$return .= '</div>';
															$return .= '<p class="help-block help-block-error"></p>';
															$return .= '</div>';				
															$return .= '</div>';	
															
															return $return;
														}
													])->label(false);
										}
									} else {
										echo $form->field($modelTerminalForm, 'elec_type')
											->inline(true)
											->radioList(['1' => 'Платно', '0' => 'Бесплатно'],
												[
													'item' => function($index, $label, $name, $checked, $value) {
															if($checked) {
																$checked = 'checked';
															}
															
															$return  = '<div class="col-xs-6 col-md-6">';				
															$return .= '<div class="form-group field-tterminal-workmode">';
															$return .= '<div >';
															$return .= '<div class="radio">';
															$return .= '<input id="elec-type-'.$value.'" type="radio" name="' . $name . '" value="'.$value.'" style="outline: none;" '.$checked.' onclick="radioWorkModeClick(this)">';
															$return .= '<label for="elec-type-'.$value.'">'.$label.'</label>';
															$return .= '</div>';
															$return .= '</div>';
															$return .= '<p class="help-block help-block-error"></p>';
															$return .= '</div>';				
															$return .= '</div>';
															
															return $return;
													}
												])->label(false);
										}
									?>							
								</div>	
								<div class="electricitysumm" style="display:none;">								
									<p class="label" style="font-weight:300; text-align:left; color:black; margin-left:-5px;">Плата в месяц (руб.)</p>
									<div class="form-group">
										<?= $form->field($modelTerminalForm, 'elec_price')->textInput(['class'  => 'form-control'])->label(false) ?>		
									</div>
								</div>									
							</div>	
						</div>	
					<div class="col-xs-1 col-md-2"></div>				
				</div>												
					
			</div>	
			<div class="col-md-4"></div>				
		</div>			
		
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6 text-center">
				<div class="line" style="background:black; height:1px; margin-top:30px;"></div>
			</div>
			<div class="col-md-3"></div>			
		</div>	

		<div class="row" style="margin-top:30px;">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="row dropdownselect services">
					<div class="col-xs-1 col-md-1"></div>
					<div class="col-xs-10 col-md-10">
						<div class="row"  style="text-align:center;">
							<label class="main-text2">Необходимые сервисы терминала</label>
							<div class="btn-group text-center" style="width: 100%;">
								<div class="button-panel-blue dropdown-toggle" data-toggle="dropdown">Выбрать сервисы</div>
								<ul class="dropdown-menu main-text2" role="menu">
									<?for($i=0;$i<count($services);$i++){?>
										<li data-id="<?=$services[$i]->id_ref?>">
											<a href="#" onclick="addSelection($(this),  $(this).text(), <?=$services[$i]->id_ref?>); return false;"><?=$services[$i]->name?></a>
										</li>
									<?}?>
								</ul>
							</div>	
						</div>	
						<div class="row selectionblock">
							<div class="col-xs-12 text-left"></div>
						</div>		
						<div class="row selectioninput" style="display:none;">
							<?= Html::input('Выбранные сервисы', 'TTerminal[services]')?> 
						</div>							
					</div>	
					<div class="col-xs-1 col-md-1"></div>				
				</div>					
			</div>	
			<div class="col-md-4"></div>				
		</div>	

		<div class="row" style="margin-top:30px;">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="row dropdownselect blockadv">
					<div class="col-xs-1 col-md-1"></div>
					<div class="col-xs-10 col-md-10">
						<div class="row"  style="text-align:center;">
							<label class="main-text2">Запрет на виды рекламы</label>
							<div class="btn-group text-center" style="width: 100%;">
								<div class="button-panel-blue dropdown-toggle" data-toggle="dropdown">Выбрать виды</div>
								<ul class="dropdown-menu main-text2" role="menu">
									<?for($i=0;$i<count($category);$i++){?>
										<li data-id="<?=$category[$i]->id_ref?>"><a href="#" onclick="addSelection($(this),  $(this).text(), <?=$category[$i]->id_ref?>); return false;"><?=$category[$i]->name?></a></li>
									<?}?>									
								</ul>
							</div>	
						</div>	
						<div class="row selectionblock">
							<div class="col-xs-12 text-left"></div>
						</div>	
						<div class="row selectioninput" style="display:none;">
							<?= Html::input('Выбранные виды рекламы', 'TTerminal[blockadv]')?> 
						</div>							
					</div>	
					<div class="col-xs-1 col-md-1"></div>				
				</div>					
			</div>	
			<div class="col-md-4"></div>				
		</div>			
		
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-xs-1 col-md-1"></div>
					<div class="col-xs-10 col-md-10">
						<div class="row" style="margin-top:30px;">
							<p style="font-weight:bold; text-align:center;">Комментарий</p>
							<div class="form-group">
								<?= $form->field($modelTerminalForm, 'comments')->textInput(['class'  => 'form-control comment'])->label(false) ?>										
							</div>
						</div>
						<div class="row" style="margin-top:30px;">
							<p style="font-weight:bold; text-align:center;">Контакты</p>
							<p class="label main-text-2" style="font-weight:300; text-align:left; color:black; margin-left:-5px;">Телефон</p>
							<div class="form-group">
								<?= $form->field($modelTerminalForm, 'admin_phone')->textInput(['class'  => 'form-control phone'])->label(false) ?>			
							</div>
						</div>
						<div class="row">
							<p class="label main-text-2" style="font-weight:300; text-align:left; color:black; margin-left:-5px;">E-mail</p>
							<div class="form-group">
								<?= $form->field($modelTerminalForm, 'admin_email')->textInput(['class'  => 'form-control email'])->label(false) ?>	
							</div>
						</div>	
						<div class="row">
							<p class="label main-text-2" style="font-weight:300; text-align:left; color:black; margin-left:-5px;">Контактное лицо</p>
							<div class="form-group">
								<?= $form->field($modelTerminalForm, 'admin_name')->textInput(['class'  => 'form-control person'])->label(false) ?>	
							</div>
						</div>			
						<div class="row">	
							<?= Html::submitButton('Отправить заявку', ['class' => 'button']) ?>							
						</div>							
					</div>	
					<div class="col-xs-1 col-md-1"></div>				
				</div>					
			</div>	
			<div class="col-md-4"></div>				
		</div>			
		<?php ActiveForm::end(); ?>		
	</div>	
</div>	