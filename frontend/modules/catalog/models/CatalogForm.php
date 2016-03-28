<?php

namespace frontend\modules\catalog\models;

use common\models\TCategories;
use common\models\TOffice;
use common\models\TOfficeCategory;
use common\models\TOfficeContact;
use common\models\TOfficeTw;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use frontend\models\GCity;

/**
 * ContactForm is the model behind the contact form.
 */
class CatalogForm extends Model
{
    /* все в t_office (sub_type = 1, is_moderate = 1, user = null) */
    public $companyName;            // title
    public $minutes;
    public $category;               // t_office_category (t_categories section = 54)
    public $city;                   // id_city
    public $street;                 // street
    public $house;                  // house
    public $housing;                // corp
    public $floor;                  // level
    public $office;                 // num
    public $website;                // web
    /* t_office_contact - type_contact (1 - phone, 2 - email, 3 - skype) */
    public $phone;                  // (t_office_contact)
    public $phone_2;                // (t_office_contact)
    public $email;                  // (t_office_contact)
    public $email_2;                // (t_office_contact)
    /* t_office_tw - type (1 - перерыв, 0 - часы работы), day_of_week (день от 1 - 7, 0 все дни) */
    public $workMode;               // (t_office_tw)
    public $timeout;                // (t_office_tw)
    public $daysOfWeek;             // (t_office_tw)
    public $hours_start_workday;
    public $minutes_start_workday;
    public $hours_end_workday;
    public $minutes_end_workday;
    public $hours_start_timeout;
    public $minutes_start_timeout;
    public $hours_end_timeout;
    public $minutes_end_timeout;
    /* t_office (sub_type = 2, parent_office - id офиса с sub_type = 1) */
    public $product;
    public $product_2;
    public $product_3;
    public $product_4;
    public $product_5;
    public $product_6;
    public $product_7;
    /* t_office (sub_type = 5, parent_office - id офиса с sub_type = 1) */
    public $service;
    public $service_2;
    public $service_3;
    public $service_4;
    public $service_5;
    public $service_6;
    public $service_7;
    /* t_office (sub_type = 3, parent_office - id офиса с sub_type = 1) */
    public $sale;
    public $sale_2;
    public $sale_3;
    public $sale_4;
    public $sale_5;
    public $sale_6;
    public $sale_7;
    public $startSale;
    public $endSale;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['companyName', 'hours', 'minutes', 'category', 'city', 'street', 'house', 'housing', 'floor', 'office', 'phone', 'workMode', 'daysOfWeek'], 'required'],
            [['house', 'housing', 'floor', 'office'], 'integer'],
            [['phone_2', 
                'product', 'product_2', 'product_3', 'product_4', 'product_5', 'product_6', 'product_7',
                'service', 'service_2', 'service_3', 'service_4', 'service_5', 'service_6', 'service_7',
                'sale', 'sale_2', 'sale_3', 'sale_4', 'sale_5', 'sale_6', 'sale_7',
                'startSale', 'endSale'
            ], 'string'],
            [['email', 'email_2'], 'email'],
            ['website', 'url', 'defaultScheme' => 'http'],
            [['timeout', 'daysOfWeek',
                'hours_start_workday', 'minutes_start_workday', 'hours_end_workday', 'minutes_end_workday',
                'hours_start_timeout', 'minutes_start_timeout', 'hours_end_timeout', 'minutes_end_timeout'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'companyName' => Yii::t('app', 'Название организации'),
            'hours' => Yii::t('app', 'Часы'),
            'minutes' => Yii::t('app', 'Минуты'),
            'category' => Yii::t('app', 'Категория'),
            'city' => Yii::t('app', 'Город'),
            'street' => Yii::t('app', 'Улица'),
            'house' => Yii::t('app', 'Дом'),
            'housing' => Yii::t('app', 'Корпус'),
            'floor' => Yii::t('app', 'Этаж'),
            'office' => Yii::t('app', 'Офис'),
            'phone' => Yii::t('app', 'Телефон'),
            'phone_2' => Yii::t('app', 'Второй телефон'),
            'email' => Yii::t('app', 'E-mail'),
            'email_2' => Yii::t('app', 'Второй E-mail'),
            'website' => Yii::t('app', 'Сайт'),
            'workMode' => Yii::t('app', 'Режим работы'),
            'timeout' => Yii::t('app', 'Перерыв'),
            'daysOfWeek' => Yii::t('app', 'Дни недели'),
            'product' => Yii::t('app', 'Товары'),
            'service' => Yii::t('app', 'Услуги'),
            'sale' => Yii::t('app', 'Акции'),
            'startSale' => Yii::t('app', 'Начало акции'),
            'endSale' => Yii::t('app', 'Конец акции'),
        ];
    }

    public function getCityList()
    {
        $appliances = ArrayHelper::map(GCity::find()
            ->where(['status' => 0])
            ->orderBy('name')
            ->all(), 'id_city', 'name');
        $items = [];
        foreach($appliances as $key => $value) {
            $items[$key] = Yii::t('app', $value);
        }
        return $items;
    }

    public function getCategoryList()
    {
        $categories = ArrayHelper::map(TCategories::find()
            ->where(['section' => 54])
            ->orderBy('turn')
            ->all(), 'id_category', 'name');
        $items = [];

        foreach($categories as $key => $value) {
            $items[$key] = Yii::t('app', $value);
        }
        return $items;
    }

    public function saveCard($modelCatalogForm) {
        /* @var $modelCatalogForm CatalogForm */
        /* @var $modelTOffice TOffice */
        $modelTOffice = new TOffice();
        $modelTOffice->title = $this->companyName;
        $modelTOffice->id_city = $this->city;
        $modelTOffice->street = $this->street;
        $modelTOffice->house = $this->house;
        $modelTOffice->corp = $this->housing;
        $modelTOffice->level = $this->floor;
        $modelTOffice->num = $this->office;
        $modelTOffice->web = $this->website;
        $modelTOffice->phone = $this->phone;
        $modelTOffice->subtype = 1;
        $modelTOffice->is_moderate = 1;
        $modelTOffice->user = null;
        $modelTOffice->is_spr = 1;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($modelTOffice->save()) {
                // all inputs are valid
                $ok = $this->setCategories($modelCatalogForm, $modelTOffice->id_office);
                if($ok)
                    $ok = $this->setWorkMode($modelCatalogForm, $modelTOffice->id_office);
                if($ok)
                    $ok = $this->setContacts($modelCatalogForm, $modelTOffice->id_office);
                if($ok)
                    $ok = $this->setProducts($modelCatalogForm, $modelTOffice->id_office);
                if($ok)
                    $ok = $this->setServices($modelCatalogForm, $modelTOffice->id_office);
                if($ok)
                    $ok = $this->setSales($modelCatalogForm, $modelTOffice->id_office);
                if($ok)
                    $transaction->commit();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        return $modelTOffice;
    }

    private function setCategories($modelCatalogForm, $idOffice) {
        /* @var $modelCatalogForm CatalogForm */
        /* @var $modelTOfficeCategory TOfficeCategory */
        TOfficeCategory::deleteAll(['id_office' => $idOffice]);
        foreach($modelCatalogForm->category as $one) {
            $modelTOfficeCategory = new TOfficeCategory();
            $modelTOfficeCategory->id_office = $idOffice;
            $modelTOfficeCategory->category = $one;
            $modelTOfficeCategory->is_main = 1;
            if(!$modelTOfficeCategory->save())
                return false;
            return true;
        }
    }

    private function setWorkMode($modelCatalogForm, $idOffice) {
        /* t_office_tw - type (1 - перерыв, 0 - часы работы), day_of_week (день от 1 - 7, 0 все дни) */
        /* @var $modelCatalogForm CatalogForm */
        /* @var $modelTOfficeTw TOfficeTw */
        if(count($modelCatalogForm->daysOfWeek) == 7) {
            $modelTOfficeTw = new TOfficeTw();
            $modelTOfficeTw->id_office = $idOffice;
            $modelTOfficeTw->day_of_week = 0;
            $modelTOfficeTw->type = 0;
            $modelTOfficeTw->start_time = str_pad($modelCatalogForm->hours_start_workday, 2, 0, STR_PAD_LEFT).':'.str_pad($modelCatalogForm->minutes_start_workday, 2, 0, STR_PAD_LEFT);
            $modelTOfficeTw->end_time = str_pad($modelCatalogForm->hours_end_workday, 2, 0, STR_PAD_LEFT).':'.str_pad($modelCatalogForm->minutes_end_workday, 2, 0, STR_PAD_LEFT);
            if(!$modelTOfficeTw->save())
                return false;
        } else {
            foreach($modelCatalogForm->daysOfWeek as $one) {
                $modelTOfficeTw = new TOfficeTw();
                $modelTOfficeTw->id_office = $idOffice;
                $modelTOfficeTw->day_of_week = $one;
                $modelTOfficeTw->type = 0;
                $modelTOfficeTw->start_time = str_pad($modelCatalogForm->hours_start_workday, 2, 0, STR_PAD_LEFT).':'.str_pad($modelCatalogForm->minutes_start_workday, 2, 0, STR_PAD_LEFT);
                $modelTOfficeTw->end_time = str_pad($modelCatalogForm->hours_end_workday, 2, 0, STR_PAD_LEFT).':'.str_pad($modelCatalogForm->minutes_end_workday, 2, 0, STR_PAD_LEFT);
                if(!$modelTOfficeTw->save())
                    return false;
            }
        }

        if($modelCatalogForm->timeout) {
            $modelTOfficeTw = new TOfficeTw();
            $modelTOfficeTw->id_office = $idOffice;
            $modelTOfficeTw->day_of_week = 0;
            $modelTOfficeTw->type = 1;
            $modelTOfficeTw->start_time = str_pad($modelCatalogForm->hours_start_timeout, 2, 0, STR_PAD_LEFT).':'.str_pad($modelCatalogForm->minutes_start_timeout, 2, 0, STR_PAD_LEFT);
            $modelTOfficeTw->end_time = str_pad($modelCatalogForm->hours_end_timeout, 2, 0, STR_PAD_LEFT).':'.str_pad($modelCatalogForm->minutes_end_timeout, 2, 0, STR_PAD_LEFT);
            if(!$modelTOfficeTw->save())
                return false;
        }
        return true;
    }

    private function setContacts($modelCatalogForm, $idOffice) {
        /* @var $modelCatalogForm CatalogForm */
        /* t_office_contact - type_contact (1 - phone, 2 - email, 3 - skype) */
        $ok = true;
        if($modelCatalogForm->phone)
            $ok = $this->saveContact($modelCatalogForm->phone, $idOffice, $typeContact = 1);
        if($modelCatalogForm->phone_2)
            $ok = $this->saveContact($modelCatalogForm->phone_2, $idOffice, $typeContact = 1);
        if($modelCatalogForm->email)
            $ok = $this->saveContact($modelCatalogForm->email, $idOffice, $typeContact = 2);
        if($modelCatalogForm->email_2)
            $ok = $this->saveContact($modelCatalogForm->email_2, $idOffice, $typeContact = 2);
        return $ok;
    }

    private function saveContact($contact, $idOffice, $typeContact = 1) {
        /* @var $modelTOfficeContact TOfficeContact */
        /* t_office_contact - type_contact (1 - phone, 2 - email, 3 - skype) */
        $modelTOfficeContact = new TOfficeContact();
        $modelTOfficeContact->contact = $contact;
        $modelTOfficeContact->type_contact = $typeContact;
        $modelTOfficeContact->id_office = $idOffice;
        if(!$modelTOfficeContact->save())
            return false;
        return true;
    }

    private function setProducts($modelCatalogForm, $idOffice) {
        /* @var $modelCatalogForm CatalogForm */
        $ok = true;
        if($modelCatalogForm->product)
            $ok = $this->saveSubType($modelCatalogForm->product, $idOffice, $subType = 2);
        if($modelCatalogForm->product_2)
            $ok = $this->saveSubType($modelCatalogForm->product_2, $idOffice, $subType = 2);
        if($modelCatalogForm->product_3)
            $ok = $this->saveSubType($modelCatalogForm->product_3, $idOffice, $subType = 2);
        if($modelCatalogForm->product_4)
            $ok = $this->saveSubType($modelCatalogForm->product_4, $idOffice, $subType = 2);
        if($modelCatalogForm->product_5)
            $ok = $this->saveSubType($modelCatalogForm->product_5, $idOffice, $subType = 2);
        if($modelCatalogForm->product_6)
            $ok = $this->saveSubType($modelCatalogForm->product_6, $idOffice, $subType = 2);
        if($modelCatalogForm->product_7)
            $ok = $this->saveSubType($modelCatalogForm->product_7, $idOffice, $subType = 2);
        return $ok;
    }


    private function setSales($modelCatalogForm, $idOffice) {
        /* t_office (sub_type = 5, parent_office - id офиса с sub_type = 1) */
        /* @var $modelCatalogForm CatalogForm */
        $ok = true;
        if($modelCatalogForm->sale)
            $ok = $this->saveSubType($modelCatalogForm->sale, $idOffice, $subType = 3);
        if($modelCatalogForm->sale_2)
            $ok = $this->saveSubType($modelCatalogForm->sale_2, $idOffice, $subType = 3);
        if($modelCatalogForm->sale_3)
            $ok = $this->saveSubType($modelCatalogForm->sale_3, $idOffice, $subType = 3);
        if($modelCatalogForm->sale_4)
            $ok = $this->saveSubType($modelCatalogForm->sale_4, $idOffice, $subType = 3);
        if($modelCatalogForm->sale_5)
            $ok = $this->saveSubType($modelCatalogForm->sale_5, $idOffice, $subType = 3);
        if($modelCatalogForm->sale_6)
            $ok = $this->saveSubType($modelCatalogForm->sale_6, $idOffice, $subType = 3);
        if($modelCatalogForm->sale_7)
            $ok = $this->saveSubType($modelCatalogForm->sale_7, $idOffice, $subType = 3);
        return $ok;
    }

    private function setServices($modelCatalogForm, $idOffice) {
        /* t_office (sub_type = 5, parent_office - id офиса с sub_type = 1) */
        /* @var $modelCatalogForm CatalogForm */
        $ok = true;
        if($modelCatalogForm->service)
            $ok = $this->saveSubType($modelCatalogForm->service, $idOffice, $subType = 5);
        if($modelCatalogForm->service_2)
            $ok = $this->saveSubType($modelCatalogForm->service_2, $idOffice, $subType = 5);
        if($modelCatalogForm->service_3)
            $ok = $this->saveSubType($modelCatalogForm->service_3, $idOffice, $subType = 5);
        if($modelCatalogForm->service_4)
            $ok = $this->saveSubType($modelCatalogForm->service_4, $idOffice, $subType = 5);
        if($modelCatalogForm->service_5)
            $ok = $this->saveSubType($modelCatalogForm->service_5, $idOffice, $subType = 5);
        if($modelCatalogForm->service_6)
            $ok = $this->saveSubType($modelCatalogForm->service_6, $idOffice, $subType = 5);
        if($modelCatalogForm->service_7)
            $ok = $this->saveSubType($modelCatalogForm->service_7, $idOffice, $subType = 5);
        return $ok;
    }

    private function saveSubType($productName, $idOffice, $subType) {
        /* @var $modelTOffice TOffice */
        /* t_office (sub_type = 2, parent_office - id офиса с sub_type = 1) */
        $modelTOffice = new TOffice();
        $modelTOffice->subtype = $subType;
        $modelTOffice->parent_office = $idOffice;
        $modelTOffice->title = $productName;
        if(!$modelTOffice->save())
            return false;
        return true;
    }


}
