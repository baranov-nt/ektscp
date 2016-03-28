<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 30.06.2015
 * Time: 5:48
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class BehaviorsController extends Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                /*'denyCallback' => function ($rule, $action) {
                    throw new \Exception('Нет доступа.');
                },*/
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['signup', 'login', 'login', 'update-sms'],
                        'verbs' => ['GET', 'POST'],
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['user', 'logout', 'uploadfiles'],
                        'verbs' => ['GET', 'POST'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['users/profile'],
                        'actions' => ['index', 'update-image', 'call', 'message', 'favorite', 'show-contact-form', 'add-phone', 'delete-phone'],
                        'roles' => ['Пользователь']
                    ],
                ]
            ],
        ];
    }
}