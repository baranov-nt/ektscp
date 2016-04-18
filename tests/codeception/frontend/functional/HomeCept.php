<?php
use tests\codeception\frontend\FunctionalTester;

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo(Yii::t('app', 'Убедиться, что главная страница работает.'));
$I->amOnPage(Yii::$app->homeUrl);
$I->seeInTitle('CitySmartMedia');

