<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 24.03.2016
 * Time: 14:15
 */

namespace common\widgets\UserDataWidget\models;

use common\models\Users;
use frontend\models\GRegion;
use Yii;
use yii\base\Model;
use yii\validators\RequiredValidator;

class ContactsForm extends Model
{
    public $phone;
    public $email;
    public $skype;
    public $city;
    public $street;
    public $house;
    public $housing;
    public $office;
    public $offset;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['phone', 'validatePhone', 'on' => 'addPhone'],
            //['email', 'email', 'message' => 'Не является правильным email адресом.'],
            [['house', 'offset'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone' => 'Дополнительный номер',
            'email' => 'Дополнительный емайл',
            'city' => 'Город',
            'street' => 'Улица',
            'house' => 'Дом',
            'housing' => 'Корпус',
            'office' => 'Офис',
        ];
    }

    /*public function validatePhone($attribute)
    {
        $requiredValidator = new RequiredValidator();
        $requiredValidator->message = 'Необходимо заполнить поле.';

        foreach($this->$attribute as $index => $row) {
            $error = null;
            $requiredValidator->validate($row['label'], $error);
            if (!empty($error)) {
                $key = $attribute . '[' . $index . '][label]';
                $this->addError($key, $error);
            }
        }
    }*/

    public function validatePhone()
    {
        $phones = str_replace(['\\', '_', '-', '(', ')', ' '], '', $this->phone);

        foreach($this->phone as $key => $value) {
            if(substr($phones[$key], 0, 2) != '79' && substr($phones[$key], 0, 2) != '73') {
                //$this->addError('phone', Yii::t('app', 'Неправильный номер телефона.'));
                $this->addError('phone[' . $key . ']', 'Не верное значение');
            }
        }
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
