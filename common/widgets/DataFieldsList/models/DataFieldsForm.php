<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.03.2016
 * Time: 13:20
 *
 * @property DataFieldsForm $maritalStatus
 */
namespace common\widgets\DataFieldsList\models;

use common\models\GReferens;
use common\models\TPerson;
use common\models\TPersonContact;
use frontend\models\GRegion;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class DataFieldsForm extends Model
{
    public $id_pc;
    public $phone;
    public $email;
    public $skype;
    public $site;
    public $birthdate;
    public $gender;
    public $marital;
    public $children;
    public $birthcity;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id_pc', 'integer'],
            ['phone', 'validatePhone', 'on' => 'phoneScenario'],
            ['email', 'email', 'on' => 'emailScenario'],
            ['email', 'required', 'on' => 'emailScenario'],
            ['email', 'validateEmail', 'on' => 'emailScenario'],
            ['skype', 'required', 'on' => 'skypeScenario'],
            ['skype', 'validateSkype', 'on' => 'skypeScenario'],
            ['site', 'url', 'defaultScheme' => 'http', 'on' => 'siteScenario'],
            ['site', 'required', 'on' => 'siteScenario'],
            ['site', 'validateSite', 'on' => 'siteScenario'],
            ['birthdate', 'validateBirthdate', 'on' => 'birthdateScenario'],
            ['gender', 'integer', 'on' => 'genderScenario'],
            ['marital', 'integer', 'on' => 'maritalScenario'],
            ['children', 'integer', 'on' => 'childrenScenario'],
            ['birthcity', 'integer', 'on' => 'birthcityScenario'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone' => 'Телефон',
            'email' => 'Эл. почта',
            'site' => 'Сайт',
            'birthdate' => 'День рождения',
            'gender' => 'Пол',
            'marital' => 'Семейное положение',
            'children' => 'Дети',
            'birthcity' => 'Родной город',
        ];
    }

    public function validatePhone()
    {
        $phones = str_replace(['\\', '_', '-', '(', ')', ' '], '', $this->phone);

        if(substr($phones, 0, 2) != '79' && substr($phones, 0, 2) != '73') {
            $this->addError('phone', Yii::t('app', 'Неправильный номер телефона.'));
        }

        if(strlen($phones) != 11) {
            $this->addError('phone', Yii::t('app', 'Неправильный номер телефона.'));
        }

        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        $modelTPersonContact = TPersonContact::find()
            ->where([
                'type_contact' => 1,
                'contact' => $this->phone,
                'id_person' => $user->tPerson->id_person,
            ])
            ->one();

        /* @var $modelTPersonContact \common\models\TPersonContact */
        if($modelTPersonContact && $modelTPersonContact->id_pc != $this->id_pc) {
            $this->addError('phone', Yii::t('app', 'Этот номер уже добавлен.'));
        }
    }

    public function validateEmail()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        $modelTPersonContact = TPersonContact::find()
            ->where([
                'type_contact' => 2,
                'contact' => $this->email,
                'id_person' => $user->tPerson->id_person,
            ])
            ->one();

        /* @var $modelTPersonContact \common\models\TPersonContact */
        if($modelTPersonContact && $modelTPersonContact->id_pc != $this->id_pc) {
            $this->addError('email', Yii::t('app', 'Эта эл. почта уже добавлена.'));
        }
    }

    public function validateSkype()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        $modelTPersonContact = TPersonContact::find()
            ->where([
                'type_contact' => 3,
                'contact' => $this->skype,
                'id_person' => $user->tPerson->id_person,
            ])
            ->one();

        /* @var $modelTPersonContact \common\models\TPersonContact */
        if($modelTPersonContact && $modelTPersonContact->id_pc != $this->id_pc) {
            $this->addError('skype', Yii::t('app', 'Этот Skype уже добавлен.'));
        }
    }

    public function validateSite()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        $modelTPersonContact = TPersonContact::find()
            ->where([
                'type_contact' => 5,
                'contact' => $this->site,
                'id_person' => $user->tPerson->id_person,
            ])
            ->one();

        /* @var $modelTPersonContact \common\models\TPersonContact */
        if($modelTPersonContact && $modelTPersonContact->id_pc != $this->id_pc) {
            $this->addError('site', Yii::t('app', 'Этот сайт уже добавлен.'));
        }
    }

    public function validateBirthdate()
    {

        $date = strtotime("-18 year", time());
        $dateMin = Yii::$app->formatter->asDate($date, "php:d.m.Y");
        if(strtotime($dateMin) < strtotime($this->birthdate)) {
            $this->addError('birthdate', Yii::t('app', 'Вам должно быть больше 18 лет.'));
        }
    }

    public function getMaritalList()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);

        if($modelTPerson->sex === 0) {
            return ArrayHelper::map(GReferens::find()
                ->where([
                    'base_ref' => 477,
                ])
                ->all(),'id_ref', 'name');
        } elseif($modelTPerson->sex === 1) {
            return ArrayHelper::map(GReferens::find()
                ->where([
                    'base_ref' => 473,
                ])
                ->all(),'id_ref', 'name');
        } else {
            return [];
        }
    }

    public function getMaritalStatus()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);
        return $modelTPerson->maritalStatus->name;
    }

    public function getBirthcityList()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
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

    public function getCityName()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);
        return $modelTPerson->birthcity0->name;
    }

    public function savePhone()
    {
        /* @var $modelTPersonContact \common\models\TPersonContact */
        $modelTPersonContact = TPersonContact::findOne($this->id_pc);
        $modelTPersonContact->contact = $this->phone;
        return $modelTPersonContact->save() ? true : $modelTPersonContact;
    }

    public function createPhone()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;
        $modelTPersonContact = new TPersonContact();
        $modelTPersonContact->type_contact = 1;
        $modelTPersonContact->contact = $this->phone;
        $modelTPersonContact->id_person = $user->tPerson->id_person;
        return $modelTPersonContact->save() ? true : false;
    }

    public function saveEmail()
    {
        /* @var $modelTPersonContact \common\models\TPersonContact */
        $modelTPersonContact = TPersonContact::findOne($this->id_pc);
        $modelTPersonContact->contact = $this->email;
        return $modelTPersonContact->save() ? true : $modelTPersonContact;
    }

    public function createEmail()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;
        $modelTPersonContact = new TPersonContact();
        $modelTPersonContact->type_contact = 2;
        $modelTPersonContact->contact = $this->email;
        $modelTPersonContact->id_person = $user->tPerson->id_person;
        return $modelTPersonContact->save() ? true : $modelTPersonContact;
    }

    public function saveSkype()
    {
        /* @var $modelTPersonContact \common\models\TPersonContact */
        $modelTPersonContact = TPersonContact::findOne($this->id_pc);
        $modelTPersonContact->contact = $this->skype;
        return $modelTPersonContact->save() ? true : $modelTPersonContact;
    }

    public function createSkype()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;
        $modelTPersonContact = new TPersonContact();
        $modelTPersonContact->type_contact = 3;
        $modelTPersonContact->contact = $this->skype;
        $modelTPersonContact->id_person = $user->tPerson->id_person;
        return $modelTPersonContact->save() ? true : $modelTPersonContact;
    }

    public function saveSite()
    {
        /* @var $modelTPersonContact \common\models\TPersonContact */
        $modelTPersonContact = TPersonContact::findOne($this->id_pc);
        $modelTPersonContact->contact = $this->site;
        return $modelTPersonContact->save() ? true : $modelTPersonContact;
    }

    public function createSite()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;
        $modelTPersonContact = new TPersonContact();
        $modelTPersonContact->type_contact = 5;
        $modelTPersonContact->contact = $this->site;
        $modelTPersonContact->id_person = $user->tPerson->id_person;
        return $modelTPersonContact->save() ? true : $modelTPersonContact;
    }

    public function saveBirthdate()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);
        $modelTPerson->birthdate = $this->birthdate;
        return $modelTPerson->save() ? true : $modelTPerson;
    }

    public function createBirthdate()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);
        $modelTPerson->birthdate = $this->birthdate;
        return $modelTPerson->save() ? true : $modelTPerson;
    }

    public function saveGender()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);
        $modelTPerson->sex = $this->gender;
        $modelTPerson->marital_status = null;
        return $modelTPerson->save() ? true : $modelTPerson;
    }

    public function createGender()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);
        $modelTPerson->sex = $this->gender;
        $modelTPerson->marital_status = null;
        return $modelTPerson->save() ? true : $modelTPerson;
    }

    public function saveMarital()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);
        $modelTPerson->marital_status = $this->marital;
        return $modelTPerson->save() ? true : $modelTPerson;
    }

    public function createMarital()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);
        $modelTPerson->marital_status = $this->marital;
        return $modelTPerson->save() ? true : $modelTPerson;
    }

    public function saveChildren()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);
        $modelTPerson->children = $this->children;
        return $modelTPerson->save() ? true : $modelTPerson;
    }

    public function createChildren()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);
        $modelTPerson->children = $this->children;
        return $modelTPerson->save() ? true : $modelTPerson;
    }

    public function saveBirthcity()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);
        $modelTPerson->birthcity = $this->birthcity;
        return $modelTPerson->save() ? true : $modelTPerson;
    }

    public function createBirthcity()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        $modelTPerson = TPerson::findOne($user->tPerson->id_person);
        $modelTPerson->birthcity = $this->birthcity;
        return $modelTPerson->save() ? true : $modelTPerson;
    }
}
