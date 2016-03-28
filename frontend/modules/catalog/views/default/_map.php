<?php

use frontend\modules\catalog\assets\CatalogCardAsset;
use frontend\assets\GoogleMapsAsset;

Yii::$app->assetManager->forceCopy = true;
CatalogCardAsset::register($this);
GoogleMapsAsset::register($this);
?>
<div id="map">
	
</div>