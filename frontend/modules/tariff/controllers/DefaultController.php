<?php

namespace frontend\modules\tariff\controllers;

use yii\web\Controller;
use frontend\models\TTerminal;

class DefaultController extends Controller
{
    public function actionCalc($type)
    {
		$modelTerminalForm = new TTerminal();
        return $this->render('index', ['modelTerminalForm' => $modelTerminalForm, 'type' => $type]);
    }
}
