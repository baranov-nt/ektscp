<?php
	namespace frontend\modules\terminals;
	use yii;
	use frontend\assets\GoogleMapsAsset;
	
	//$this->registerCssFile('/css/fonts/cheeseusaceu/cheeseusaceu.css');
	$this->registerJsFile('/js/jquery.nicescroll.min.js', ['depends' => ['yii\web\JqueryAsset']]);
	$this->registerJsFile(Module::getAssetsUrl() . '/js/map.js', ['depends' => ['yii\web\JqueryAsset']]);
	$this->registerJsFile('//vk.com/js/api/openapi.js?121', ['position' => \yii\web\View::POS_HEAD]);
	$this->registerJs('VK.init({apiId: 5242735, onlyWidgets: true});', \yii\web\View::POS_HEAD);
	GoogleMapsAsset::register($this);
?>
<div id="fb-root"></div>
<script>var FB = false; (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5&appId=1115947618432715";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
var map_type = <?=(int)$type?>;
</script>
<div class="terminals-map">
<form>
<div class="shadow-bottom">
<div class="container <?= $type == 0 ? 'csp' : ($type == 1 ? 'css' : 'cst')?>">
	<?php if($type == 0): ?>
	<div class="header csp">
		<h1><?= Module::t("terminals.base", "Городские смартфоны"); ?></h1>
		<a href="/terminals/feature" class="sub-header"><?= Module::t("terminals.base", "Список адресов, заявленных для установки"); ?></a>
	</div>
	<?php elseif($type == 1): ?>
	<div class="header css">
		<h1><?= Module::t("terminals.base", "Мультимедийные экраны"); ?></h1>
		<div class="clearfix"></div>
	</div>
	<?php elseif($type == 2): ?>
	<div class="header cst">
		<h1><?= Module::t("terminals.base", "Интерактивные терминалы"); ?></h1>
		<div class="clearfix"></div>
	</div>
	<?php endif; ?>
	<div class="l-block">
		<div class="city">
			<select id="map-city" class="form-control">
				<?php foreach($cities as $city): ?>
				<option value="<?=$city->id_city?>"><?=$city->name?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<?php if($type == 0): ?>
		<div class="legend">
			<div class="active-terminals"><span></span> &nbsp;&ndash; <?= Module::t("terminals.base", "Установленные"); ?></div>
			<div class="feature-terminals"><span></span> &nbsp;&ndash; <?= Module::t("terminals.base", "Заявленные к установке"); ?></div>
		</div>
		<?php endif; ?>
		<div class="clearfix"></div>
	</div>
	<?php if($type == 0): ?>
	<div class="r-block clearfix">
		<?= Module::t("terminals.base", "Будет и на вашей улице городской смартфон!"); ?>
	</div>
	<?php endif; ?>
</div></div>
</form>
<div id="map">
</div>
<div class="container no-padding-top">
	<div id="rating">
		<div class="r-title">
			<div><?=Module::t("terminals.base", "Голосуй")?></div>
			<div class="subtitle"><?=Module::t("terminals.base", "за места установки городских смартфонов")?></div>
		</div>
		<div class="r-items"></div>
	</div>
</div>
</div>
