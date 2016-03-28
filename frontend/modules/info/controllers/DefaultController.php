<?php

namespace frontend\modules\info\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBusiness()
    {
        return $this->render('business');
    }

    public function actionCompany()
    {
        return $this->render('company');
    }
	
    public function actionMobile()
    {
        return $this->render('mobile');
    }

    public function actionContacts()
    {
        return $this->render('contacts');
    }
	
    public function actionAdvertisingPlatform()
    {
        return $this->render('advertising-platform');
    }    
	
	public function actionAuthorities()
    {
        return $this->render('authorities');
    }
	
	public function actionTerminals()
    {
        return $this->render('terminals');
    }

    public function actionCitysmartscreen()
    {
        return $this->render('citysmartscreen');
    }

    public function actionCitysmartterminal()
    {
        return $this->render('citysmartterminal');
    }

    public function actionSmartShop()
    {
        return $this->render('smart-shop');
    }

    public function actionSmartSoft()
    {
        return $this->render('smart-soft');
    }

    public function actionSmartDesign()
    {
        return $this->render('smart-design');
    }

    public function actionSmartMobile()
    {
        return $this->render('smart-mobile');
    }

    public function actionTerminalOwners()
    {
        return $this->render('terminal-owners');
    }

    public function actionAdvertisingAgencies()
    {
        return $this->render('advertising-agencies');
    }

    public function actionDealers()
    {
        return $this->render('dealers');
    }

    public function actionDevelopers()
    {
        return $this->render('developers');
    }

    public function actionTerminalMakers()
    {
        return $this->render('terminal-makers');
    }
}
