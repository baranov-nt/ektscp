<?php

namespace frontend\modules\api\controllers;

use yii;
use yii\web\Controller;
use yii\web\Response;
use frontend\models\TTerminal;
use frontend\models\TCommand;
use frontend\modules\adv\models\TAdv;
use frontend\modules\adv\models\TAdvShedule;

class DefaultController extends Controller
{
	public function actionIndex()
    {
        return $this->render('index');
    }
	
	public function actionGet_adv($api_key, $id)
	{
		if(TTerminal::find()->where(["guid" => $api_key])->count()) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			$adv = TAdv::find($id)->one();
		}
		return $adv;
	}
	
	public function actionGet_advshedule($api_key, $id)
	{
		if(TTerminal::find()->where(["guid" => $api_key])->count()) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			$advShedule = TAdvShedule::find($id)->one();
		}
		return $advShedule;
	}
	
	public function actionGet_currentadvs($api_key)
	{
		$terminal = TTerminal::find()->where(["guid" => $api_key])->one();
		$current_advs = TAdv::findBySql('SELECT * FROM t_adv ta INNER JOIN t_advShedule tas ON ta.id_adv = tas.adv ' .
		'WHERE (tas.terminal = ' . $terminal->id_terminal . ' OR tas.terminal_group = ' . (int)$terminal->tgroup . ') AND ' .
		"tas.startdate <= '" . date('Y-m-d') . "' AND tas.enddate >= '". date('Y-m-d') . "' AND tas.status > 0")
            ->all();
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $current_advs;
	}
	
	public function actionGet_currentass($api_key)
	{
		$terminal = TTerminal::find()->where(["guid" => $api_key])->one();
		$current_ass = TAdvShedule::findBySql('SELECT * FROM t_advShedule tas ' .
		'WHERE (tas.terminal = ' . $terminal->id_terminal . ' OR tas.terminal_group = ' . (int)$terminal->tgroup . ') AND ' .
		"tas.startdate <= '" . date('Y-m-d') . "' AND tas.enddate >= '". date('Y-m-d') . "' AND tas.status > 0")
            ->all();
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $current_ass;
	}
	
	public function actionGet_commands($api_key)
	{
		$terminal = TTerminal::find()->where(["guid" => $api_key])->one();
		$commands = TCommand::findBySql('SELECT * FROM t_command ' .
		'WHERE terminal = ' . $terminal->id_terminal . ' AND status = 0')
            ->all();
		Yii::$app->response->format = Response::FORMAT_JSON;
		return $commands;
	}
	
	public function actionGet_command($api_key, $id)
	{
		if(TTerminal::find()->where(["guid" => $api_key])->count()) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			$command = TCommand::find($id)->one();
		}
		return $command;
	}
	
	public function actionSet_command($api_key, $id)
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		
		if(TTerminal::find()->where(["guid" => $api_key])->count()) {
			$command = TCommand::find($id)->one();
			if($command) {
				$command->last_run = $_GET['time'];
				$command->status = $_GET['status'];
				return $command->save();
			}
		}
		return false;
	}
}
