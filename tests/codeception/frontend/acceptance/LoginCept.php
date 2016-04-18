<?php
use tests\codeception\frontend\AcceptanceTester;

$I = new AcceptanceTester($scenario);
$I = new AcceptanceTester\LoginSteps($scenario);
$I->comment('Проверка авторизации пользователей');

$I->amCheckValidationLoginForm($scenario);
$I->comment('Отправка верных данных');
$I->amCorrectLogin();
$I->comment('Переадресация в личный кабинет');
$I->amOnPage('users/profile/index');
$I->seeInTitle(Yii::t('app', 'Личный кабинет'));
$I->comment('Выход пользователя');
$I->amLogout();
$I->comment('Переадресация на главную страницу');
$I->amOnPage(Yii::$app->homeUrl);
$I->seeInTitle('CitySmartMedia');