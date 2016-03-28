<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 02.05.2015
 * Time: 18:17
 */
namespace frontend\models;

use common\models\TPerson;
use Yii;
use yii\base\Model;
use yii\db\Exception;
use common\rbac\helpers\RbacHelper;
use common\models\Users;
use common\models\Profiles;

class RegForm extends Model
{
    public $phone;
    public $email;
    public $password;
    public $password_repeat;
    public $status;
    public $first_name;
    public $surname;
    public $city;
    public $success = 1;
    public $smsKey;
    public $companyName;
    public $address;
    public $error;
    public $updateSms;
    public $family;

    public function rules()
    {
        return [
            ['success', 'validateSuccess'],
            ['success', 'in', 'range' => [1], 'message' => 'Подтвердите пользовательское соглашение.'],
            [['phone', 'email', 'password', 'first_name', 'surname'],'filter', 'filter' => 'trim'],
            [['phone', 'first_name', 'city'],'required', 'on' => 'default'],
            [['phone', 'email', 'family'],'required'],
            [['phone'],'required', 'on' => 'phoneFinish'],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['smsKey', 'string', 'min' => 4, 'max' => 4, 'message' => 'Введите правильный смс ключ.', 'on' => 'sendSms'],
            ['smsKey', 'string'],
            ['companyName', 'string'],
            //['smsKey', 'required'],
            ['phone', 'unique',
                'targetClass' => Users::className(),
                'message' => 'Этот номер уже занят.'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => Users::className(),
                'message' => 'Эта почта уже занята.'],
            ['status', 'default', 'value' => Users::STATUS_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' =>[
                Users::STATUS_NOT_ACTIVE,
                Users::STATUS_ACTIVE
            ]],
            ['status', 'default', 'value' => Users::STATUS_NOT_ACTIVE, 'on' => 'emailActivation'],
            ['password_repeat', 'required', 'on' => 'default'],
            ['password', 'required', 'on' => 'validatePassword'],
            //['password', 'compare', 'compareAttribute'=>'password_repeat', 'message'=>"Пароли не совпадают.", 'on' => 'validatePassword'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают."],
            ['companyName', 'string'],
            ['password', 'validatePassword', 'on' => 'validatePassword'],
            ['password_repeat', 'validatePasswordRepeat', 'on' => 'validatePassword'],
            ['password', 'match', 'pattern' => '/^[a-zA-Z0-9]\w*$/i', 'on' => 'validatePassword', 'message' => 'Пароль может содержать только цифры и латинские буквы.'],
            ['password_repeat', 'match', 'pattern' => '/^[a-zA-Z0-9]\w*$/i', 'on' => 'validatePassword', 'message' => 'Пароль может содержать только цифры и латинские буквы.'],
            ['city', 'integer'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if ($this->$attribute != $this->password_repeat && $this->password_repeat != '') {
            $this->addError($this->password_repeat, 'Пароли не совпадают.');
        }
    }

    public function validatePasswordRepeat($attribute, $params)
    {
        if ($this->$attribute != $this->password && $this->password != '') {
            $this->addError($attribute, 'Пароли не совпадают.');
        }
    }

    public function validateSuccess($attribute, $params)
    {
        if (!in_array($this->$attribute, ['1'])) {
            $this->addError($attribute, 'Подтвердите пользовательское соглашение.');
        }
    }

    public function attributeLabels()
    {
        return [
            'subscription' => '',
            'city' => 'Город',
            'first_name' => 'Имя',
            'surname' => 'Фамилия',
            'phone' => 'Телефон',
            'email' => 'Эл. почта',
            'password' => 'Пароль',
            'password_repeat' => 'Подтвердить пароль',
            'success' => '',
            'smsKey' => 'Код подтверждения',
            'family' => 'Фамилия',
        ];
    }

    public function finishReg($id)
    {
        /* @var $modelUser \common\models\Users */
        
        $modelUser = Users::findOne($id);

        if($this->scenario === 'phoneFinish'):
            $phone = $this->phone;
            $phone = str_replace([" ", "(", ")", "-", "_"], "", $phone);
            $modelUser->username = $phone;
            $modelUser->phone = $phone;
            $modelUser->email = $this->email;
            $modelUser->status = Users::STATUS_ACTIVE;
            $modelUser->save();
            return RbacHelper::assignRole($modelUser->getId()) ? $modelUser : null;
        elseif($this->scenario === 'phoneAndEmailFinish'):
            $phone = $this->phone;
            $phone = str_replace([" ", "(", ")", "-", "_"], "", $phone);
            $modelUser->phone = $phone;
            $modelUser->email = $this->email;
            $modelUser->setPassword($this->password);
            $modelUser->generateAuthKey();
            $modelUser->generateSecretKey();
            $modelUser->save();
            return RbacHelper::assignRole($modelUser->getId()) ? $modelUser : null;
        endif;
        return false;
    }

    public function reg()
    {
        $modelUsers = new Users();
        $phone = $this->phone;
        $phone = str_replace([" ", "(", ")", "-", "_"], "", $phone);
        $modelUsers->phone = $phone;
        $modelUsers->username = $this->email;
        $modelUsers->email = $this->email;
        $modelUsers->old_user = 0;
        $modelUsers->status_user = Users::STATUS_ACTIVE;
        $modelUsers->setPassword($this->password);
        $modelUsers->generateAuthKey();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if($modelUsers->save()):
                $modelTPerson = new TPerson();
                $modelTPerson->user = $modelUsers->id;
                $modelTPerson->name = $this->first_name;
                $modelTPerson->family = $this->family;
                $modelTPerson->email = $this->email;
                $modelTPerson->phone = $phone;
                $modelTPerson->city = $this->city;
                $modelTPerson->is_main = 1;
                if($modelTPerson->save()):
                    $transaction->commit();
                    return RbacHelper::assignRole($modelUsers->getId()) ? $modelUsers : null;
                endif;
            else:
                return false;
            endif;
        } catch (Exception $e) {
            $transaction->rollBack();
        }
    }

    public function sendActivationEmail($user)
    {
        return Yii::$app->mailer->compose('activationEmail', ['user' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name.' (отправлено роботом).'])
            ->setTo($this->email)
            ->setSubject('Активация для '.Yii::$app->name)
            ->send();
    }

    public function changePassword()
    {
        /* @var $modelUsers \common\models\Users */
        $phone = $this->phone;
        $phone = str_replace([" ", "(", ")", "-", "_"], "", $phone);
        $modelUsers = Users::findOne(['phone' => $phone]);
        $modelUsers->setPassword($this->password);
        return $modelUsers = $modelUsers->save() ? $modelUsers : false;
    }

    public function getCityList()
    {
        $modelGRegion = GRegion::find()
            ->joinWith('gCities')
            ->where(['status' => 0])
            ->orderBy('name')
            ->all();

        $items = [];
        /* @var $region \frontend\models\GRegion */
        foreach($modelGRegion as $region) {
            /* @var $city \frontend\models\GCity */
            foreach($region->gCities as $city) {
                $items[$region->name.' '.$region->kodTSt->socrname][$city->id_city] = Yii::t('app', $city->name);
            }
        }

        return $items;
    }
}
