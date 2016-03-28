<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.02.2016
 * Time: 14:16
 */
use frontend\modules\info\assets\InfoAsset;
use yii\helpers\Html;

$asset = InfoAsset::register($this);
$assetPath = $asset->baseUrl;
?>
<div style="background-color: #f2f2f2; padding-bottom: 40px;">
    <!--<div class="wrap-navbar"></div>-->
    <div class="container">
        <div class="col-md-12 hidden-sm hidden-xs" style="height: 40px;"></div>
        <div class="row text-center" style="padding-bottom: 40px;">
            <div class="col-md-12 text-center">
                <h1>Городской смартфон — мастер на все руки</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-2">
                <img src="<?= $assetPath.'/images/Терминал-02.png'?>" style="width: 100%"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <p class="block-header">Для управляющих компаний  зданий и комплексов, терминалы "Городской смартфон" это:</p>
                    </div>
                    <div class="col-xs-6">
                        <ul>
                            <li>Консьерж</li>
                            <li>Путеводитель</li>
                            <li>Пресс-секретарь</li>
                            <li>Менеджер по рекламе</li>
                            <li>Регистратура</li>
                            <li>Продавец</li>
                        </ul></div>
                    <div class="col-xs-6">
                        <ul>
                            <li>Агент по недвижимости</li>
                            <li>Система коммуникаций</li>
                            <li>Служба охраны</li>
                            <li>Служба связи</li>
                            <li>Отдел кадров</li>
                            <li>Служба оповещения</li>
                        </ul>
                    </div>
                </div>


                <p style="padding: 10px 0 0 0; margin: 0; text-indent: 10px; text-align: justify;">
                    При этом он может работать круглые сутки, не болеет, не уходит в отпуск и ему не надо платить зарплату, наоборот он приносит хороший стабильный доход.
                </p>
                <p style="padding: 10px 0 0 0; margin: 0; text-indent: 10px; text-align: justify;">
                    Для размещения уличных интерактивных терминалов "Городской смартфон" на стенах вашего здания требуется минимальный пакет согласований с городской администрацией, а для установки внутри здания, не требуется вообще.
                </p>
                <p style="padding: 10px 0 30px 0; margin: 0; text-indent: 10px; text-align: justify;">
                    Вы можете приобрести терминал «Городской смартфон» или заказать бесплатную установку терминала на своей территории.
                </p>

<?/*                 <div class="col-xs-12" style="padding-bottom: 20px;">
                    <?= Html::a('КУПИТЬ', ['/info/default/smart-shop'], ['class' => 'btn btn-primary btn-primary-md a-btn-style-md', 'style' => 'outline: none;']) ?>
                </div>
                <div class="col-xs-12">
                    <?= Html::a('ЗАЯВКА НА УСТАНОВКУ', ['/terminals/feature'], ['class' => 'btn btn-primary btn-primary-md a-btn-style-md', 'style' => 'outline: none;']) ?>
                </div> */?>
			<div class="row"  style="margin-bottom:80px;">
				<div class="col-md-12 text-center">
					<div class="col-md-2"></div>
					<div class="col-md-8">	
						<div class="row">
							<div class="col-sm-6 col-md-6">																	
								<div class="row">
									<div class="col-xs-12 col-md-12">	
										<a href="/info/smart-shop" class="btn btn-primary btn-primary-md a-btn-style-md" style="text-transform:uppercase; margin-top:5px; margin-bottom:30px; display:block;">КУПИТЬ</a>
									</div>										
								</div>							
							</div>							
							<div class="col-sm-6 col-md-6">									
								<div class="row">
									<div class="col-xs-12 col-md-12">	
										<a class="btn btn-primary btn-primary-md a-btn-style-md" href="/terminals/feature" style="text-transform:uppercase; margin-top:5px; display:block;">Заявка на установку</a>
									</div>									
								</div>								
							</div>
						</div>
					</div>
					<div class="col-md-2"></div>					
				</div>
			</div>					
            </div>
            </div>
        </div>
        <div class="col-md-12 hidden-sm hidden-xs" style="/*background-image: url(<?php //echo $assetPath ?>/images/brickwall_@2X.png)*/ background-color: #f2f2f2;height: 40px;"></div>
    </div>
</div>
<style>
    body {
        background-color: #f2f2f2;
    }
</style>