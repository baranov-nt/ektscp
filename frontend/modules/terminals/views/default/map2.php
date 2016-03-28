<?php
	namespace frontend\modules\terminals;
	use yii;
	use frontend\assets\GoogleMapsAsset;
	
	$this->registerJsFile('/js/jquery.nicescroll.min.js', ['depends' => ['yii\web\JqueryAsset']]);
	$this->registerJsFile(Module::getAssetsUrl() . '/js/map.js', ['depends' => ['yii\web\JqueryAsset']]);
	$this->registerJsFile('//vk.com/js/api/openapi.js?121', ['position' => \yii\web\View::POS_HEAD]);
	$this->registerJs('VK.init({apiId: 5242735, onlyWidgets: true});', \yii\web\View::POS_HEAD);
	GoogleMapsAsset::register($this);
?>
<div class="terminals-map2">
<form>
<div class="container container-view">
	<div class="col-md-4 bg-info col-md-push-4 text-center"><h1><?= Module::t("terminals.base", "Карта терминалов"); ?></h1></div>
	<div class="col-md-4 bg-success col-md-pull-4">
		<div class="row">
			<div class="col-sm-6">
				<div class="city">
					<div class="city-label"><?= Module::t("terminals.base", "Город"); ?></div>
					<select id="map-city" class="form-control">
						<?php foreach($cities as $city): ?>
						<option value="<?=$city->id_city?>"><?=$city->name?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="legend">
					<div class="active-terminals"><span></span> &nbsp;&ndash; <?= Module::t("terminals.base", "Установленнные CSP"); ?></div>
					<div class="feature-terminals"><span></span> &nbsp;&ndash; <?= Module::t("terminals.base", "В планах к установке CSP"); ?></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4 bg-danger text-right"><input type="submit" class="btn btn-warning" value="<?=Module::t("terminals.base", "Предложить место установки"); ?>" /></div>
</div>
</form>
<div id="map">
</div>
<div class="container no-padding-top">
	<div id="rating">
		<div class="r-title">Рейтинг планируемых CSP</div>
		<div class="r-items"></div>
	</div>
</div>
</div>
