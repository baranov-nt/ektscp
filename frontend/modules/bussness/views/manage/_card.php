<?php
/* @var $model \common\models\TOffice */
use yii\helpers\Url;
?>
<div style="margin-bottom: 10px; border: 2px solid rgb(141, 180, 227)">
	<a href="<?= Url::to(['/bussness/manage/view', 'id' => $model->id_office]) ?>">
	<div class="row" style="padding: 5px 0 5px 5px; height: 140px;">
		<div class="col-xs-4">
			<div class="row">
				<div class="col-xs-12 text-center">
					<img style="width: 60%;" src="/images/rating.png">
				</div>
				<div class="col-xs-12">
					<?php
					if(!$model->mainImg->path == null):
						?>
						<div class="text-center"><img style="width: 80px; height: 80px;" src="<?= $model->mainImg->path ?>" /></div>
						<?php
					else:
						?>
						<div class="text-center"><img style="width: 80px; height: 80px;" src="/images/no-photo.png" /></div>
						<?php
					endif;
					?>
				</div>
				<div class="col-xs-12 text-center">
					<p style="padding-top: 5px;">500 м</p>
				</div>
			</div>
		</div>
		<div class="col-xs-8 text-right">
			<div class="row">
				<div class="col-xs-12">
					<p style="padding-right: 10px; margin: 0; color: rgb(101, 127, 167); font-weight: 700;"><?= $model->title ?></p>
				</div>
				<div class="col-xs-12" style="height: 45px;">
					<p style="padding-right: 10px; margin: 0; font-weight: 700;">
						<?php
						$numCategories = count($model->categories);
						$i = 0;
						foreach($model->categories as $one) {
							echo $one->name;
							$i++;
							if($i != $numCategories) {
								echo ', ';
							}
						}
						?>
					</p>
				</div>
				<div class="col-xs-12">
					<p style="padding-right: 10px; color: rgb(101, 127, 167); font-weight: 500; margin: 0;">
						<?php
						echo $model->idCity->name;
						?>
					</p>
					<p style="padding-right: 10px; color: rgb(101, 127, 167); font-weight: 500; margin: 0;">
						<?php
						if($model->street) {
							echo $model->street;
							echo ', '.$model->house;
						}
						?>
					</p>
					<p style="padding-right: 10px; color: rgb(101, 127, 167); font-weight: 500; margin: 0;">
						<?php
						if($model->phone) {
							echo $model->phone;
						}
						?>
					</p>
				</div>
			</div>
		</div>
	</div>
	</a>
</div>

