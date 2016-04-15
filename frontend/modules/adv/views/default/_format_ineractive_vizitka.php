<?use yii\helpers\Html;?>
<p class="main-text-dep" style="font-style: italic;color: #2791c6;">Визитка размещается на главном экране интерактивных<br>
терминалов и городских смартфонов.</p>
<div style="margin-bottom: 25px;">
	<?= Html::dropDownList('TAdv[vizitki]', null, [0 => 'Нет визиток.'], [
		'class'  => 'form-control chosen-no-search',
		'style' => 'width: 330px;',
		'prompt' => Yii::t('app', 'Выберите визитку')
	]); ?>
</div>
<div style="margin-bottom: 15px;">
	<?= Html::dropDownList('TAdv[modules]', null, $modelTAdv->modulesList, [
		'class'  => 'form-control chosen-no-search',
		'style' => 'width: 330px;',
		'id' => 'showModule',
		'onchange' => 'select_module(this.value)',
		'prompt' => Yii::t('app', 'Выбор модуля для размещения')
	]); ?>
</div>
<script>
$(".chosen-no-search").chosen({disable_search_threshold: 200});
</script>