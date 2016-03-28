<?php
/* @var $model \frontend\modules\terminals\models\TTerminal */
use common\models\GReferens;
use frontend\models\GalAlbumImages;
use common\widgets\FancyBox\FancyBoxAsset;

FancyBoxAsset::register($this);
?>
<div class="terminal-card">
	<div class="title-wrapper clearfix">
		<div class="title">
			<div class="title-text page-dep"><?=$model->place?></div>
		</div>
	</div>
	<div class="top-info clearfix">
		<div class="left main-text-2"><?= Yii::t('app', 'Категория:') ?></div><div class="right"><a href="#"><?=$model->categoryPlace->name?></a></div>
		<div class="clearfix"></div>
		<div class="left main-text-2"><?= Yii::t('app', 'Адрес:') ?></div><div class="right address"><?=$model->address?></div>
	</div>
	<div class="info">
		<div class="info-item clearfix">
			<div class="left main-text-dep"><?= Yii::t('app', 'Подробно') ?></div>
			<div class="right"></div>
			<div class="line"></div>
		</div>
		<div class="info-content wrapper">
			<div class="info-content first clearfix">
				<div class="left main-text-2"><?= Yii::t('app', 'Проходимость') ?></div>
				<div class="right main-text-dep-2"><?=$model->passability?> <?= Yii::t('app', 'чел./день') ?></div>
				<div class="clearfix"></div>
				<div class="left main-text-2"><?= Yii::t('app', 'Режим работы') ?></div>
				<div class="right main-text-dep-2"><?=$model->worktime?> <?= Yii::t('app', 'часа') ?></div>
				<div class="clearfix"></div>
			</div>
			<div class="info-item clearfix">
				<div class="left main-text-dep"><?= Yii::t('app', 'Затраты') ?> <span class="normal">(<?=$model->arenda_price + $model->internet_price + $model->elec_price?> <?= Yii::t('app', 'руб./мес.') ?>)</span></div>
				<div class="right"></div>
				<div class="line"></div>
			</div>
			<div class="info-content clearfix">
				<?if($model->arenda_type == 1){?>
					<div class="left main-text-2"><?= Yii::t('app', 'Аренда места:') ?></div>
					<div class="right main-text-dep-2"><?= $model->arenda_price.' '.Yii::t('app', 'руб./мес.')?></div>
				<?}else if($model->arenda_type == 2){?>
					<div class="left main-text-2"><?= Yii::t('app', 'Аренда места:') ?></div>
					<div class="right main-text-dep-2"><?= Yii::t('app', 'Тендер') ?></div>
					<div class="clearfix"></div>
					<div class="left main-text-2"><?= Yii::t('app', 'Тип тендера:') ?></div>
					<?if($model->tender_type == '0'){
						$tender_type = 'Закрытый';
					}else{
						$tender_type = 'Открытый';
					}?>
					<div class="right main-text-dep-2"><?= $tender_type?></div>
					<div class="clearfix"></div>
					<div class="left main-text-2"><?= Yii::t('app', 'Ссылка на тендер:') ?></div>
					<div class="right main-text-dep-2"><?= $model->tender_url?></div>			
					<div class="clearfix"></div>	
					<div class="left main-text-2"><?= Yii::t('app', 'Стартовая цена:') ?></div>
					<div class="right main-text-dep-2"><?= $model->tender_start_price?></div>							
				<?}else{?>
					<div class="left main-text-2"><?= Yii::t('app', 'Аренда места:') ?></div>
					<div class="right main-text-dep-2"><?=  Yii::t("app", "бесплатно")?></div>
				<?}?>			
				<div class="clearfix"></div>
				<div class="left main-text-2"><?= Yii::t('app', 'Интернет:') ?></div>
				<?if($model->internet_type == true){
					$internetprice = $model->internet_price.' '.Yii::t('app', 'руб./мес.');
				}else{
					$internetprice = Yii::t("app", "бесплатно");
				}?>
				<div class="right main-text-dep-2"><?=$internetprice?></div>
				<div class="clearfix"></div><div class="left main-text-2"><?= Yii::t('app', 'Электроэнергия:') ?></div>
				<?if($model->elec_type){
					$electricityprice = $model->elec_price.' '.Yii::t('app', 'руб./мес.');
				}else{
					$electricityprice = Yii::t("app", "бесплатно");
				}?>				
				<div class="right main-text-dep-2"><?=$electricityprice?></div>
				<div class="clearfix"></div>
			</div>
			<?if(count($model->tTerminalServices) > 0){?>			
				<div class="info-item clearfix">
					<div class="left main-text-dep"><?= Yii::t('app', 'Необходимые сервисы') ?></div>
					<div class="right"></div>
					<div class="line"></div>
				</div>
				<div class="info-content clearfix">
					<?for($i=0;$i<count($model->tTerminalServices);$i++){
						$servicesname = GReferens::find()->where(["id_ref" => $model->tTerminalServices[$i]['id_service']])->one();?>
						<div class="left main-text-2"><?= Yii::t('app', $servicesname->name) ?></div>
						<div class="clearfix"></div>
					<?}?>
				</div>
			<?}?>			
			<?if(count($model->tTerminalAdvBlocks) > 0){?>					
				<div class="info-item clearfix">
					<div class="left main-text-dep"><?= Yii::t('app', 'Запреты на рекламу') ?></div>
					<div class="right"></div>
					<div class="line"></div>
				</div>
				<div class="info-content clearfix">
					<?for($i=0;$i<count($model->tTerminalAdvBlocks);$i++){
						$advblockname = GReferens::find()->where(["id_ref" => $model->tTerminalAdvBlocks[$i]['id_adv_category']])->one();	
					?>
						<div class="left main-text-2"><?= Yii::t('app', $advblockname->name) ?></div>
						<div class="clearfix"></div>
					<?}?>
				</div>
			<?}?>	
			<?if(count($model->galAlbums) > 0){?>
				<div class="info-item clearfix">
					<?for($i=0;$i<count($model->galAlbums);$i++){
						$gallery = GalAlbumImages::find()->where(["id_album" => $model->galAlbums[$i]->id_album])->all();
					}?>
					<div class="left main-text-dep"><?= Yii::t('app', 'Количество мест') ?> <span class="normal">(<?=count($gallery)?>)</span></div>
					<div class="right"></div>
					<div class="line"></div>
				</div>
				<div class="info-content photos">
					<?for($i=0;$i<count($model->galAlbums);$i++){
						$gallery = GalAlbumImages::find()->where(["id_album" => $model->galAlbums[$i]->id_album])->all();
						for($c=0;$c<count($gallery);$c++){?>	
							<?if($c == 0){?>
								<a href="<?=$gallery[$c]->idFile->path?>" class="btn btn-info gray fancybox"  rel="group"><?= Yii::t('app', 'Фотографии мест') ?> (<?=count($gallery)?>)</a>
							<?}else{?>
								<a class="fancybox" href="<?=$gallery[$c]->idFile->path?>" rel="group" style="display:none;">
									<img src="<?=$gallery[$c]->idFile->path?>" alt="" width="250">
								</a>								
							<?}?>		
						<?}?>
					<?}?>
				</div>
			<?}?>				
			<button class="btn btn-primary"><?= Yii::t('app', 'ЗАБРОНИРОВАТЬ АДРЕС') ?></button>
		</div>
	</div>
</div>