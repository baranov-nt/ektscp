<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 14.03.2016
 * Time: 9:14
 */

namespace frontend\controllers;

use common\models\LoginForm;
use Yii;
use yii\web\Controller;
use common\models\Users;

class UserController extends Controller
{
    public function actionSetOldFlag()
    {
        Users::updateAll(['old_user' => 1]);
        $this->goBack();
    }

    public function actionLoginOldUser($username, $password)
    {
        $passwordMd5 = md5($password);
        $modelUser = Users::findOne([
            'username' => $username,
            'password' => $passwordMd5
        ]);

        /* @var $modelUser \common\models\Users */
        $modelUser->old_user = 0;
        $modelUser->password_hash = $modelUser->getPassword($password);
        $modelUser->generateAuthKey();
        if($modelUser->update()) {
            $modelLoginForm = new LoginForm();
            $modelLoginForm->username = $username;
            $modelLoginForm->password = $password;
            if($modelLoginForm->login()) {
                return $this->goHome();
            }
        };
        dd($modelUser->getErrors());
    }

    public function actionErrorLogin()
    {
        Yii::$app->session->setFlash('error', 'Неправильные имя пользователя или пароль.');
        return $this->redirect('/site/login');
    }
}