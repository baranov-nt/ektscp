<?php
/* @var $modelTAdv \common\models\TAdv */

use frontend\components\widgets\WidgetUpload;
use frontend\components\widgets\assets\WidgetUploadAsset;
use frontend\modules\adv\assets\AdvAsset;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;
use frontend\assets\ChosenAsset;
use yii\bootstrap\ActiveForm;


Yii::$app->assetManager->forceCopy = true;

WidgetUploadAsset::register($this);
ChosenAsset::register($this);

$asset = AdvAsset::register($this);
$assetPath = $asset->baseUrl;

$this->title = 'Smart Media';
?>

<div class="wrap">
	<?php
	$form = ActiveForm::begin();
	?>
	<div class="adv-default-index container text-center" style="padding-bottom: 0;">
		<h1 style="margin-top: 54px;margin-bottom: 0px;">Smart Media</h1>
		<p class="main-text">Сервис размещения информации</p>
		<div class="first-block">
			<div class="row">
				<div class="col-xs-12">
					<?= $form->field($modelTAdv, 'city')->dropDownList($modelTAdv->cityList, [
								'class'  => 'form-control chosen-select',
								'style' => 'width: 330px;',
								'onchange' => 'city_change(this.value)',
								'prompt' => Yii::t('app', 'Выберите город')
							])->label(false) ?>
				</div>
			</div>
		</div>
		<div class="two-block">
			<?= $form->field($modelTAdv, 'format')->dropDownList($modelTAdv->formatList, [
						'class'  => 'form-control chosen-no-search',
						'style' => 'width: 330px;',
						'onchange' => 'format_change(this.value)',
						'prompt' => Yii::t('app', 'Выберите формат')
					])->label(false) ?>
			
			<div class="format-update">

			</div>
		</div>
		
		<div class="conditions">
			<?= $form->field($modelTAdv, 'term')->dropDownList($modelTAdv->termList, [
				'class'  => 'form-control chosen-no-search',
				'style' => 'width: 330px;',
				'onchange' => '',
				'prompt' => Yii::t('app', 'Выберите срок')
			])->label(false) ?>
			<div id="period-date" class="row period-date" style="margin-top: 35px;">
				<div class="col-xs-12 col-sm-4 col-sm-offset-2 text-left">
					<label class="main-text2">Начало</label>
					<?=DatePicker::widget([
						'language' => Yii::$app->language,
						'name' => 'date',
						'type' => DatePicker::TYPE_COMPONENT_APPEND,
						'layout' => '{input}{picker}',
						'options' => [
							'class' => 'period-picker page-dep',
							'onchange' => 'select_date($(this))',
						],
						'pickerButton' => '<span class="input-group-addon kv-date-calendar" title="Выбрать дату"><i class="glyphicon period-calendar"></i></span>',
						'buttonOptions' => 'label',
						'pluginOptions' => [
							'todayHighlight' => true,
							'todayBtn' => true,
							'format' => 'dd.mm.yyyy',
							'autoclose' => true,
						]
					]);?>
				</div>
				<!--Desctop-->
				<div class="col-sm-4 col-md-4 text-left hidden-xs">
					<label class="main-text2">Окончание</label>
					<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0  col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
						<div class="row">
							<div class="col-xs-6 col-sm-3 period-calendar-right"></div>
							<div class="col-xs-6 col-sm-3 last-date page-dep"></div>
						</div>
					</div>
				</div>
				<!--Mobile-->
				<div class="col-xs-12 visible-xs text-left" style="margin-top: 5px;">
					<label class="main-text2">Окончание</label>
					<div class="row">
						<div class="col-xs-6 col-sm-3 period-calendar-right" style="margin-left: 15px!important;"></div>
						<div class="col-xs-6 col-sm-3 last-date page-dep"></div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="last-block">
			<?= $form->field($modelTAdv, 'places')->dropDownList($modelTAdv->placesList, [
				'class'  => 'form-control chosen-no-search',
				'multiple' => true,
				'style' => 'width: 330px;',
				'onchange' => '',
				'data-placeholder' => Yii::t('app', ' Выберите места установки')
			])->label(false) ?>
			<div class="checkbox checkbox-info checkbox-inline">
				<input type="checkbox" data-id="cst" id="input-cst" onchange="filter_platform()" disabled />
				<label for="input-cst" class="main-text">Терминалы</label>
			</div>
			<div class="checkbox checkbox-info checkbox-inline">
				<input type="checkbox" data-id="csp" id="input-csp" onchange="filter_platform()" checked disabled />
				<label for="input-csp" class="main-text">Городские смартфоны</label>
			</div>
		</div>
	</div>


	<?=$this->render('_add_table_seats');?>

	<div class="clearfix"></div>
	<div class="order">
		<h3 class="pull-left">Итого:</h3>
		<button type="submit" class="btn btn-success pull-right" onclick="formSubmit();return false;" style="width: 120px;margin-top: 20px;">Оплатить</button>
		<div class="clearfix"></div>
		<div style="padding-bottom: 17px;border-bottom: 1px dashed black;"></div>
		<div class="row">
			<div class="col-sm-6 padding-block">
				<div class="row" id="order-block-1">
					<div class="col-xs-5 padding-block main-text">Кол-во мест:</div>
					<div class="col-xs-7 padding-block text-bold text-right main-text2"></div>
					<div class="clearfix"></div>
					<div class="col-xs-5 padding-block main-text">Кол-во устройств:</div>
					<div class="col-xs-7 padding-block text-bold text-right main-text2"></div>
				</div>
			</div>
			<div class="clearfix visible-xs"></div>
			<div class="col-sm-6 padding-block">
				<div class="row" id="order-block-2">
					<div class="col-xs-8 padding-block main-text">Срок размещения:</div>
					<div class="col-xs-4 padding-block text-bold text-right main-text2"></div>
					<div class="col-xs-8 padding-block main-text">Скидка:</div>
					<div class="col-xs-4 padding-block text-bold text-right main-text2"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-input-hidden">
		<input type="text" style="display: none" name="atype" id="atype"/>
		<input type="text" style="display: none" name="atime" id="atime"/>
		<input type="text" style="display: none" name="adate" id="adate"/>
	</div>
	<?php ActiveForm::end(); ?>
</div>
<script>
$(".chosen-no-search").chosen({disable_search_threshold: 200});
</script>