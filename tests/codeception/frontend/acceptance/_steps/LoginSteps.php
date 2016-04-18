<?php
namespace tests\codeception\frontend\AcceptanceTester;

use common\models\LoginForm;
use tests\codeception\frontend\_pages\LoginPage;
use tests\codeception\frontend\AcceptanceTester;

/* @property \tests\codeception\frontend\AcceptanceTester | \tests\codeception\frontend\FunctionalTester  $actor */

class LoginSteps extends \tests\codeception\frontend\AcceptanceTester
{
    public function amOpenLoginPage() {
        $I = $this;
        LoginPage::openBy($I);
        $I->seeInTitle(\Yii::t('app', 'Войти'));
    }

    public function amCheckValidationLoginForm($scenario)
    {
        $I = $this;
        $loginPage = LoginPage::openBy($I);
        $I->seeInTitle(\Yii::t('app', 'Войти'));
        $I = new AcceptanceTester\LoginSteps($scenario);
        $I->comment('Отправка пустой формы');
        $loginPage->login('', '');
        $I->wait(1);
        $I->see(\Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => $loginPage->getLoginFormAttribute('username')]), '.help-block');
        $I->see(\Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => $loginPage->getLoginFormAttribute('password')]), '.help-block');
        $I->comment('Отправка неверных данных');
        $loginPage->login('some', 'some');
        $I->wait(1);
        $I->see(\Yii::t('app', 'Wrong phone, email or password.'), '.help-block');
    }

    public function amCorrectLogin()
    {
        $I = $this;
        $loginPage = LoginPage::openBy($I);
        $loginPage->login('79221301879', '111111');
        $I->wait(1);
    }

    public function amLogout()
    {
        $I = $this;
        $I->click('#profileDropdown');
        $I->wait(1);
        $I->click(\Yii::t('app', 'Выйти'));
    }

    public function login($username, $password)
    {
        $this->actor->fillField('input[name="LoginForm[username]"]', $username);
        $this->actor->fillField('input[name="LoginForm[password]"]', $password);
        $this->actor->click('login-button');
    }

    public function logout()
    {
        $this->actor->click('#profileDropdown');
    }

    
}