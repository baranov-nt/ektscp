<?
use yii\helpers\Html;
use frontend\components\widgets\WidgetUpload;
?>
<div class="media" style="margin: 0 auto;">
	<div class="upload_banner" style="margin: 0 auto;overflow: hidden;cursor: pointer;width: 330px;height: 200px;background: #ccc;margin-top: 20px;">
		<img id="selector_banner"/>
	</div>
	<button id="upload_banner" style="margin-top: 6px;" class="btn btn-default" onclick="return false;">Загрузить <i class="fa fa-download"></i></button>
	<br><br>
	<div class="checkbox checkbox-info checkbox-inline">
		<input type="checkbox" id="input-vizitki" onchange="show_input_info($(this))">
		<label for="input-vizitki" class="text-left main-text">Добавить визитку рекламодателя на главный экран<br><span style="font-size: 11px;">(Только для терминалов и городских смартфонов)</span></label>
	</div>
</div>
<div style="margin-bottom: 25px;">
	<?= Html::dropDownList('TAdv[vizitki]', null, [0 => 'Нет визиток.'], [
		'class'  => 'form-control chosen-no-search',
		'style' => 'width: 330px;',
		'id' => 'showVizitki',
		'disabled' => true,
		'prompt' => Yii::t('app', 'Выберите визитку')
	]); ?>
</div>
<div style="margin-bottom: 15px;">
	<?= Html::dropDownList('TAdv[showTime]', null, $modelTAdv->showTimeList, [
		'class'  => 'form-control chosen-no-search',
		'style' => 'width: 330px;',
		'id' => 'showTime',
		'onchange' => 'selectTimeList(this.value)',
		'prompt' => Yii::t('app', 'Выберите период')
	]); ?>
</div>
<?=WidgetUpload::widget([
	"upload_button" => [
		"upload_banner",
	],
	"input_name" => [
		"upload_banner" => "id_file_banner",
	],
	"selector_file" => [
		"upload_banner" => "selector_banner",
	],
	"jcrop" => [
		"width" => 1080,
		"height" => 607,
	],
	"extensions" => "gif|jpg|jpeg|png|mp4|wmv|mov|avi",
	"different_loading" => true,
]);?>
<script>
$(".chosen-no-search").chosen({disable_search_threshold: 200});
</script>