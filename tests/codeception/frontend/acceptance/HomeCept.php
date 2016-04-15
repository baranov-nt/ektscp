<?php
use tests\codeception\frontend\AcceptanceTester;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo(Yii::t('app', 'Убедиться, что главная страница работает.'));
$I->amOnPage(Yii::$app->homeUrl);
$I->seeInTitle('CitySmartMedia');
$I->seeLink(Yii::t('app', 'MCM'));
$I->click(Yii::t('app', 'MCM'));
$I->seeInTitle('CitySmartMedia');
