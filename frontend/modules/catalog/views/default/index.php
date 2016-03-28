<?php
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel common\models\TOfficeSearch */
use frontend\modules\catalog\assets\CatalogCardAsset;
use yii\widgets\ListView;
use dlds\infinitescroll\InfiniteScrollPager;
use frontend\modules\catalog\assets\CatalogAsset;
use common\widgets\Chosen\ChosenAsset;
use yii\widgets\Pjax;

Pjax::begin();
ChosenAsset::register($this);

CatalogAsset::register($this);
//CatalogCardAsset::register($this);

Yii::$app->assetManager->forceCopy = true;
?>
<div class="catalog-default-index">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1 style="margin-bottom: 30px; margin-top: 70px;">Умный справочник</h1>
				<a href="/catalog/add" class="btn btn-success btn-success-md a-btn-style-md">Добавить визитку</a>
			</div>
		</div>
		<div class="col-md-12 text-center" style="margin-top: 40px;">
			<?= $this->render('_search', ['model' => $searchModel]); ?>
		</div>
		<div class="col-md-12" style="margin-top: 40px; margin-bottom: 60px;">
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
					'class' => 'item col-md-4',
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
						'behavior' => InfiniteScrollPager::BEHAVIOR_MASONRY,
					],
				],
			]);
			?>
		</div>
	</div>
</div>
<?php
Pjax::end();