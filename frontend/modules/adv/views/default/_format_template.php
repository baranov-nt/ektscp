<?
use yii\helpers\Html;
use frontend\modules\adv\assets\AdvAsset;
$asset = AdvAsset::register($this);
$assetPath = $asset->baseUrl;
?>
<div class="slider">
	<div><img src="<?=$assetPath.'/images/resize/1.jpg'?>" style="width: 300px;height: 170px;"/><span data-text="Cosmos"></span></div>
	<div><img src="<?=$assetPath.'/images/resize/2.jpg'?>" style="width: 300px;height: 170px;"/><span data-text="Cosmos2"></span></div>
	<div><img src="<?=$assetPath.'/images/resize/3.jpg'?>" style="width: 300px;height: 170px;"/><span data-text="Cosmos3"></span></div>
	<div><img src="<?=$assetPath.'/images/resize/4.jpg'?>" style="width: 300px;height: 170px;"/><span data-text="Cosmos4"></span></div>
	<div><img src="<?=$assetPath.'/images/resize/5.jpg'?>" style="width: 300px;height: 170px;"/><span data-text="Cosmos5"></span></div>
	<div>
		<div style="width: 300px;height: 170px;border: 1px solid #444;">
			<h3>Свой шаблон</h3>
			<button class="btn btn-primary btn-small" onclick="open_edit();return false;">Редактировать</button>
		</div>
		<span data-text="Свой шаблон"></span>
	</div>
</div>
<div style="margin: 0 auto;margin-bottom: 15px;width: 300px;">
	<?= Html::textArea('TAdv[templateHeader]', null, [
		'id' => 'templateHeader',
		'rows' => 6,
		'style' => 'display: none;width: 330px;margin-left: -15px;',
		'prompt' => Yii::t('app', 'Введите текст')
	]); ?>
</div>
<div style="margin-bottom: 15px;">
	<?= Html::dropDownList('TAdv[showTime]', null, $modelTAdv->showTimeList, [
		'class'  => 'form-control chosen-no-search',
		'style' => 'width: 330px;',
		'prompt' => Yii::t('app', 'Выберите период трансляции')
	]); ?>
</div>
<script>
$('.slider').slick({
	dots: true,
	slidesToShow: 3,
	slidesToScroll: 1,
	arrows: false,
});

$('.slider').on('afterChange', function(event, slick, currentSlide){
	currentSlide = $('.slider').slick('slickCurrentSlide');
	templateHeader = $('div[data-slick-index="' + (currentSlide + 1) + '"]>span').attr('data-text');
	console.log(templateHeader);
	if (templateHeader == "Свой шаблон") {
		console.log(1);
		$('#templateHeader').show();
	}
});

$(".chosen-no-search").chosen({disable_search_threshold: 200});
</script>