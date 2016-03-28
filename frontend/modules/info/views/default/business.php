<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.01.2016
 * Time: 11:25
 */
use frontend\modules\info\assets\InfoAsset;
use yii\helpers\Html;

$asset = InfoAsset::register($this);
$assetPath = $asset->baseUrl;
?>
<div style="/*background-image: url(<?php //echo $assetPath ?>/images/brickwall_@2X.png)*/ background-color: #f2f2f2;">
    <div class="container" style="padding-bottom: 40px;">
        <div class="col-md-12 hidden-sm hidden-xs" style="height: 40px;"></div>
        <div class="row" style="width: 100%">
            <div class="col-md-12 text-center" style="padding-bottom: 20px;">
                <h1>БИЗНЕС БЕЗ ГРАНИЦ</h1>
            </div>
            <div class="col-md-8 col-md-offset-2" style=" padding-bottom: 20px;" >
                <p class="block-header" style="text-indent: 10px;">Мультимедийные экраны и интерактивные терминалы, установленные в публичных местах с высокой проходимостью и подключенные к
                    системе CITYSMARTMEDIA, приносят их собственникам стабильный пассивный доход.</p>
            </div>
            <div class="col-md-2 col-md-offset-3">
                <img src="<?= $assetPath.'/images/Терминал-02.png'?>" style="width: 100%;">
            </div>
            <div class="col-md-5">
                <p style=" padding-top: 30px; text-indent: 10px;">Наиболее высокую прибыль приносят терминалы «Городской смартфон», так как их интеллектуальный функционал и популярность у горожан, делают сеть
                    «Городской смартфон» самой эффективной рекламной платформой. Платное размещение рекламы и информации на городском смартфоне, установленном в
                    высокопроходимом публичном месте, позволяет  зарабатывать собственнику терминала до 200.000 руб. в месяц.</p>
            </div>
        </div>
    </div>
</div>
<div style="background-color: #ffffff;">
    <div class="container" style="padding-top: 30px;">
        <div class="col-md-6 col-md-offset-3 text-center" style="padding-bottom: 20px;">
            <p class="block-header">Для открытия собственного бизнеса с терминалами «Городской смартфон»
                достаточно выполнить три простых шага.</p>
        </div>
        <div class="col-sm-4 text-center" style="padding-bottom: 50px;">
            <div class="row">
                <div class="col-sm-offset-2 col-sm-8" style="padding-bottom: 10px;">
                    <img src="<?= $assetPath.'/images/Бизнес без границ-02.png'?>" style="width: 100px;">
                </div>
                <div class="col-sm-12">
                    <p class="page-dep">Выбор места установки</p>
                    <p class="text-center">На <a href="/terminals/map">Карте «ГОРОДСКИЕ СМАРТФОНЫ»</a>  представлены готовые к размещению
                        терминалов «Городской смартфон» места, с указанием всех условий установки, достаточно сделать выбор.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-center" style="padding-bottom: 50px;">
            <div class="row">
                <div class="col-sm-offset-2 col-sm-8" style="padding-bottom: 10px;">
                    <img src="<?= $assetPath.'/images/Бизнес без границ-03.png'?>" style="width: 100px;">
                </div>
                <div class="col-sm-12">
                    <p class="page-dep">Покупка</p>
                    <p class="text-center">В интернет-магазине <a href="/info/smart-shop">SMART SHOP</a> представлены модели терминалов «Городской смартфон» от различных производителей, выбери любую из них.
                        При покупке терминала можно сразу заказать услугу по его установке на выбранный адрес, управления
                        и сервисного обслуживания.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-center" style="padding-bottom: 50px;">
            <div class="row">
                <div class="col-sm-offset-2 col-sm-8" style="padding-bottom: 10px;">
                    <img src="<?= $assetPath.'/images/Бизнес без границ-04.png'?>" style="width: 100px;">
                </div>
                <div class="col-sm-12">
                    <p class="page-dep">Регистрация в системе</p>
                    <p class="text-center" style="font-size: 14px;">Зарегистрируй терминал «Городской смартфон» в <a href="/site/profile">личном</a> кабинете на сайте CITYSMARTMEDIA и отслеживай статистику его работы с
                        любого компьютера или мобильного устройства.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="background-color: #dae8ff;">
    <div class="container " style="padding-top: 30px; padding-bottom: 25px;">
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <img src="<?= $assetPath.'/images/Бизнес без границ-10.png'?>" style="width: 100%;">
            </div>
            <div class="col-md-4">
                <p style="text-indent: 10px;">Главным преимуществом продуктов CSM является отсутствие необходимости тратить время и деньги на поиски и привлечение рекламодателей, они сами ищут свободные
                    для размещения информации мультимедийные экраны и интерактивные терминалы, подключенные к системе CITYSMARTMEDIA .</p>
                <p style="text-indent: 10px;">Собственники мультимедийных экранов
                    и интерактивных терминалов  могут размещать любую информацию на своих устройствах бесплатно.</p>
            </div>
            <div class="col-md-6 col-md-offset-3 text-center" style="padding-bottom: 20px; padding-top: 30px;">
                <p class="block-header">Инвестируйте в собственную сеть мультимедийных экранов<br>
                    и интерактивных терминалов CITYSMARTMEDIA!<br>
                    Пока вы думаете, конкуренты занимают лучшие для установки места.
                </p>
            </div>
            <div class="col-md-12 text-center">
            <p style="text-indent: 10px;"><?= Html::button('Бизнес калькулятор', ['class' => 'btn btn-primary btn-primary-md', 'style' => 'outline: none;']) ?></p>
            </div>
        </div>
    </div>
</div>

