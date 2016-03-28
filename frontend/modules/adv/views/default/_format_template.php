<?use yii\helpers\Html;?>
<div class="slider">
	<div><img src="<?=$assetPath.'/images/resize/1.jpg'?>" style="width: 300px;height: 170px;"/><span data-text="Cosmos"></span></div>
	<div><img src="<?=$assetPath.'/images/resize/2.jpg'?>" style="width: 300px;height: 170px;"/><span data-text="Cosmos2"></span></div>
	<div><img src="<?=$assetPath.'/images/resize/3.jpg'?>" style="width: 300px;height: 170px;"/><span data-text="Cosmos3"></span></div>
	<div><img src="<?=$assetPath.'/images/resize/4.jpg'?>" style="width: 300px;height: 170px;"/><span data-text="Cosmos4"></span></div>
	<div><img src="<?=$assetPath.'/images/resize/5.jpg'?>" style="width: 300px;height: 170px;"/><span data-text="Cosmos5"></span></div>
	<div><img id="selector_image" style="width: 300px;height: 170px;"/><button id="upload_image" style="vertical-align: -73px;" class="btn btn-default" onclick="return false;">Загрузить <i class="fa fa-download"></i></button><span data-text="Свой шаблон"></span></div>
</div>
<?/* = $form->field($modelTAdv, 'city')->textArea($modelTAdv->formatList, [
						'class'  => 'form-control',
						'rows' => 6,
						'style' => 'width: 330px;',
						'onchange' => 'city_change(this.value)',
						'prompt' => Yii::t('app', 'Введите текст')
					])->label(false)  */?>
<h3 class="page-subtitle">Период трансляции(кол-во показов)</h3>
<?= Html::dropDownList('TAdv[showTime]', null, $modelTAdv->showTimeList, [
	'class'  => 'form-control chosen-no-search',
	'style' => 'width: 330px;',
	'onchange' => 'selectTimeList(this.value)',
	'prompt' => Yii::t('app', 'Выберите период')
]); ?>