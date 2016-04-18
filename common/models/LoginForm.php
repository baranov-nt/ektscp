<?php
/**
 * Created by PhpStorm.
 * Users: phpNT
 * Date: 02.05.2015
 * Time: 18:16
 */
namespace common\models;

use yii\base\Model;
use Yii;

class LoginForm extends Model
{
    public $username;
    public $phone;
    public $password;
    public $email;
    public $rememberMe = true;
    public $status;
    public $reCaptcha;

    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()):
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)):
                $this->addError($attribute, Yii::t('app', 'Wrong phone, email or password.'));
            endif;
        endif;
    }

    public function getUser()
    {
        if ($this->_user === false):
            $this->_user = Users::findByEmail($this->username);
            if($this->_user):
                return $this->_user;
            else:
                $this->_user = Users::findByphone($this->username);
            endif;
        endif;
        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Телефон или емайл'),
            'phone' => Yii::t('app', 'Phone number'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Пароль'),
            'rememberMe' => Yii::t('app', 'Запомнить меня'),
            'reCaptcha' => Yii::t('app', 'Captha')
        ];
    }

    public function login()
    {
        /* @var $user User */
        //dd($this);
//        d($this);
        if ($this->validate()):
            $this->status = ($user = $this->getUser()) ? $user->status_user : Users::STATUS_NOT_ACTIVE;

            if ($this->status === Users::STATUS_ACTIVE):
                return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
            else:
                return false;
            endif;
        else:
            //dd($this->errors);
            return false;
        endif;
    }
}