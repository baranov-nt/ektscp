<?php
namespace frontend\modules\terminals;
use yii;
use yii\widgets\ListView;
use dlds\infinitescroll\InfiniteScrollPager;
use yii\widgets\Pjax;
use frontend\modules\catalog\assets\CatalogAsset;

//CatalogAsset::register($this);

Yii::$app->assetManager->forceCopy = true;

?>
<div class="feature-terminals">
	<div class="container">
		<div class="header">
			<h1><?= Module::t("terminals.base", "Заявленные для установки места"); ?></h1>
			<a href="/terminals/map" class="sub-header"><?= Module::t("terminals.base", "Карта мест установки"); ?></a>
		</div>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10 smartguide text-center">
						<form class="form-inline" role="form">
							<div class="form-group">
								<select class="form-control">
									<option>Категория</option>
									<option>Транспорт</option>
									<option>Образование</option>
								</select>
							</div><!--
							--><div class="form-group">
								<select class="form-control">
									<option>Город</option>
								</select>
							</div><!--
							--><div class="form-group">
								<select class="form-control">
									<option>Район</option>
								</select>
							</div><!--
							--><div class="form-group">
								<select class="form-control">
									<option>Проходимость</option>
								</select>
							</div><!--
							--><div class="form-group">
								<select class="form-control">
									<option>Затраты</option>
								</select>
							</div><!--
							--><div class="form-group">
								<select class="form-control">
									<option>Режим</option>
								</select>
							</div><!--
							--><button type="submit" class="btn btn-primary right-block"><span class="glyphicon glyphicon-search"></span></button>
						</form>
						<div class="col-md-3 text-left" style="padding-right:0; padding-left:0; margin-top: 26px;">Результат поиска: 128</div>
						<div class="col-md-5"></div>
						<div class="col-md-4" style="padding-right:0; padding-left:0; margin-top: 20px;"><a href="/terminals/add" class="btn btn-primary">ДОБАВИТЬ МЕСТО УСТАНОВКИ</a></div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	<div class="cards-wrapper">
		<div class="cards-inner">
			<div class="cards clearfix">
				<div class="cards-col ccol-1"></div>
				<div class="cards-col ccol-2"></div>
				<div class="cards-col ccol-3"></div>
				<?php
				/* @var $dataProvider yii\data\ActiveDataProvider */
				echo ListView::widget([
					'id' => 'my-listview-id',
					'dataProvider' => $dataProvider,
					'layout' => "{summary}\n<div class=\"items\">{items}</div>\n<div class='col-md-12'>{pager}</div>",
					'itemView' => function ($model, $key, $index, $widget) {
						return $this->render('_card',[
							'model' => $model,
							'key' => $key,
							'index' => $index,
							'widget' => $widget
						]);
					},
					'itemOptions' => [                                                      // свойства для элементов контейнера
						'tag' => 'div',
						'class' => 'item',
					],
					'summary' => false,
					'pager' => [
						'class' => InfiniteScrollPager::className(),
						'widgetId' => 'my-listview-id',
						'itemsCssClass' => 'items',
						'contentLoadedCallback' => 'makeCardsColumns',
						'nextPageLabel' => 'Больше терминалов',
						'linkOptions' => [
							'class' => 'btn btn-primary',
							'style' => 'display: none;'
						],
						'pluginOptions' => [
							'loading' => [
								'msgText' => "<em>Загрузка следующих терминалов...</em>",
								'finishedMsg' => "<em>Нет больше терминалов</em>",
							],
							//'behavior' => InfiniteScrollPager::BEHAVIOR_MASONRY,
						],
					],
				]);
				?>
			</div>
		</div>
	</div>
</div>
