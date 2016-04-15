<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.04.2016
 * Time: 10:46
 */
/* @var $modelCompanyForm frontend\modules\bussness\models\CompanyForm */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel common\models\TOfficeSearch */
use yii\widgets\ListView;
use dlds\infinitescroll\InfiniteScrollPager;
use frontend\modules\bussness\assets\BussnessAsset;
use yii\helpers\Html;
use common\widgets\Chosen\ChosenAsset;

BussnessAsset::register($this);
ChosenAsset::register($this);
?>
<div class="container">
    <h1 class="text-center">Список моих компаний</h1>
    <div class="text-center">
        <?= Html::button('Добавить компанию',
            [
                'class' => 'btn btn-primary',
                'data-toggle' => 'modal',
                'data-target' => '#createCompanyModal'
            ]) ?>
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
<?= $this->render('_modal', ['modelCompanyForm' => $modelCompanyForm]) ?>