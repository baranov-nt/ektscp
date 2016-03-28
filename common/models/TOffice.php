<?php

namespace common\models;

use frontend\models\FileImage;
use frontend\models\GCity;
use frontend\models\GRegion;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "t_office".
 *
 * @property integer $id_office
 * @property integer $subtype
 * @property string $title
 * @property string $dsc
 * @property string $phone
 * @property string $web
 * @property integer $vip
 * @property integer $type
 * @property integer $category
 * @property string $department
 * @property integer $address_community
 * @property integer $id_city
 * @property string $street
 * @property string $house
 * @property string $corp
 * @property integer $level
 * @property string $num
 * @property string $pavilion
 * @property string $stand
 * @property integer $community
 * @property integer $user
 * @property string $logo
 * @property string $id_logo
 * @property string $price
 * @property string $period_from
 * @property string $period_to
 * @property integer $parent_office
 * @property integer $is_ex
 * @property string $phone2
 * @property string $dsc_ex
 * @property string $last_update
 * @property integer $id_campany
 * @property string $created
 * @property integer $prev_office
 * @property integer $parent_office_l
 * @property string $lang
 * @property integer $is_moderate
 * @property string $moderate_comment
 * @property integer $is_spr
 *
 * @property TAdvStat[] $tAdvStats
 * @property TCall[] $tCalls
 * @property TMenu[] $tMenus
 * @property CCommunity $community0
 * @property GCity $idCity
 * @property Users $user0
 * @property TOfficeCategory[] $tOfficeCategories
 * @property TCategories[] $categories
 * @property TOfficeContact[] $tOfficeContacts
 * @property TOfficeSection[] $tOfficeSections
 * @property TSection[] $sections
 * @property TOfficeSectionV2[] $tOfficeSectionV2s
 * @property TOfficeTerminal[] $tOfficeTerminals
 * @property TTerminal[] $terminals
 * @property TOfficeTw[] $tOfficeTws
 * @property TWfOffice[] $tWfOffices
 * @property TWebFilter[] $idWfs
 * @property FileImage $mainImg
 */
class TOffice extends \yii\db\ActiveRecord
{
    public $email;                  // (t_office_contact)
    public $email_2;                // (t_office_contact)
    public $workMode;
    public $timeout;
    public $daysOfWeek;
    public $hours_start_workday;
    public $minutes_start_workday;
    public $hours_end_workday;
    public $minutes_end_workday;
    public $hours_start_timeout;
    public $minutes_start_timeout;
    public $hours_end_timeout;
    public $minutes_end_timeout;
    public $category;

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
    public $startSale_2;
    public $endSale_2;
    public $startSale_3;
    public $endSale_3;
    public $startSale_4;
    public $endSale_4;
    public $startSale_5;
    public $endSale_5;
    public $startSale_6;
    public $endSale_6;
    public $startSale_7;
    public $endSale_7;

    public $file;
    public $id_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_office';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //['category', 'exist', 'allowArray' => true, 'when' => function ($model, $attribute) {return is_array($model->$attribute);}],
            //['category', 'in',  'allowArray' => true],
            //
            [['subtype', 'vip', 'type', 'address_community', 'id_city', 'level', 'community', 'user', 'id_logo', 'parent_office', 'is_ex', 'id_campany',
                'prev_office', 'parent_office_l', 'is_moderate', 'is_spr', 'id_office'], 'integer'],
            [['title', 'street', 'house', 'category', 'id_city', 'street', 'phone', 'daysOfWeek', 'workMode'], 'required', 'on' => 'default'],
            [['title', 'dsc', 'phone', 'web', 'department', 'street', 'house', 'corp', 'num', 'pavilion', 'stand', 'logo', 'phone2', 'dsc_ex', 'lang', 'moderate_comment'], 'string'],
            [['price'], 'number'],
            [['email', 'email_2'], 'email'],
            [['period_from', 'period_to', 'last_update', 'created', 'timeout'], 'safe'],
            [['title', 'street', 'house', 'id_city', 'street', 'phone'], 'required', 'on' => 'updateModel'],
            [['subtype', 'parent_office', 'title'], 'required', 'on' => 'productSave'],
            [['hours_start_workday', 'minutes_start_workday', 'hours_end_workday', 'minutes_end_workday',
                'hours_start_timeout', 'minutes_start_timeout', 'hours_end_timeout', 'minutes_end_timeout',
                'product', 'product_2', 'product_3', 'product_4', 'product_5', 'product_6', 'product_7',
                'service', 'service_2', 'service_3', 'service_4', 'service_5', 'service_6', 'service_7',
                'sale', 'sale_2', 'sale_3', 'sale_4', 'sale_5', 'sale_6', 'sale_7'], 'string'],
            [['startSale', 'startSale_2', 'startSale_3', 'startSale_4', 'startSale_5', 'startSale_6', 'startSale_7',
                'endSale', 'endSale_2', 'endSale_3', 'endSale_4', 'endSale_5', 'endSale_6', 'endSale_7'], 'date', 'format' => 'php:d.m.Y', 'on' => 'default'],
            [['startSale', 'startSale_2', 'startSale_3', 'startSale_4', 'startSale_5', 'startSale_6', 'startSale_7'], 'validateCurrentDate'],
            [['endSale', 'endSale_2', 'endSale_3', 'endSale_4', 'endSale_5', 'endSale_6', 'endSale_7'], 'validateEndDate'],
            //['file', 'file']
        ];
    }

    public function validateCurrentDate($attribute)
    {
        if($this->$attribute < Yii::$app->formatter->asDate(time(), "php:d.m.Y")) {
            $this->addError($attribute, 'Дата начала акции была введена неправильно.');
        }
    }

    public function validateEndDate($attribute)
    {
        $attribute_array = explode("_", $attribute);
        if($attribute_array[1]) {
            $startSale = 'startSale_'.$attribute_array[1];
        } else {
            $startSale = 'startSale';
        }

        //dd([$this->$attribute, $this->$startSale]);
        if(Yii::$app->formatter->asDate($this->$startSale, "php:d.m.Y") > Yii::$app->formatter->asDate($this->$attribute, "php:d.m.Y")) {
            $this->addError($attribute, 'Дата окончания акции должна быть больше даты начала акции.');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_office' => Yii::t('app', 'Id Office'),
            'subtype' => Yii::t('app', 'Subtype'),
            'title' => Yii::t('app', 'Название организации'),
            'dsc' => Yii::t('app', 'Dsc'),
            'phone' => Yii::t('app', 'Телефон'),
            'web' => Yii::t('app', 'Сайт'),
            'vip' => Yii::t('app', 'Vip'),
            'type' => Yii::t('app', 'Type'),
            'category' => Yii::t('app', 'Категория'),
            'department' => Yii::t('app', 'Department'),
            'address_community' => Yii::t('app', 'Address Community'),
            'id_city' => Yii::t('app', 'Город'),
            'street' => Yii::t('app', 'Улица'),
            'house' => Yii::t('app', 'Дом'),
            'corp' => Yii::t('app', 'Корпус'),
            'level' => Yii::t('app', 'Этаж'),
            'num' => Yii::t('app', 'Офис'),
            'pavilion' => Yii::t('app', 'Pavilion'),
            'stand' => Yii::t('app', 'Stand'),
            'community' => Yii::t('app', 'Community'),
            'user' => Yii::t('app', 'User'),
            'logo' => Yii::t('app', 'Logo'),
            'id_logo' => Yii::t('app', 'Id Logo'),
            'price' => Yii::t('app', 'Price'),
            'period_from' => Yii::t('app', 'Period From'),
            'period_to' => Yii::t('app', 'Period To'),
            'parent_office' => Yii::t('app', 'Parent Office'),
            'is_ex' => Yii::t('app', 'Is Ex'),
            'phone2' => Yii::t('app', 'Второй телефон'),
            'dsc_ex' => Yii::t('app', 'Dsc Ex'),
            'last_update' => Yii::t('app', 'Last Update'),
            'id_campany' => Yii::t('app', 'Id Campany'),
            'created' => Yii::t('app', 'Created'),
            'prev_office' => Yii::t('app', 'Prev Office'),
            'parent_office_l' => Yii::t('app', 'Parent Office L'),
            'lang' => Yii::t('app', 'Lang'),
            'is_moderate' => Yii::t('app', 'Is Moderate'),
            'moderate_comment' => Yii::t('app', 'Moderate Comment'),
            'is_spr' => Yii::t('app', 'Is Spr'),
            'email' => Yii::t('app', 'E-mail'),
            'email_2' => Yii::t('app', 'Второй E-mail'),
            'workMode' => Yii::t('app', 'Режим работы'),
            'timeout' => Yii::t('app', 'Перерыв'),
            'daysOfWeek' => Yii::t('app', 'Дни недели'),
            'product' => Yii::t('app', 'Товары'),
            'service' => Yii::t('app', 'Услуги'),
            'sale' => Yii::t('app', 'Акции'),
            'startSale' => Yii::t('app', 'Начало акции'),
            'endSale' => Yii::t('app', 'Конец акции'),
            'startSale_2' => Yii::t('app', 'Начало акции'),
            'endSale_2' => Yii::t('app', 'Конец акции'),
            'startSale_3' => Yii::t('app', 'Начало акции'),
            'endSale_3' => Yii::t('app', 'Конец акции'),
            'startSale_4' => Yii::t('app', 'Начало акции'),
            'endSale_4' => Yii::t('app', 'Конец акции'),
            'startSale_5' => Yii::t('app', 'Начало акции'),
            'endSale_5' => Yii::t('app', 'Конец акции'),
            'startSale_6' => Yii::t('app', 'Начало акции'),
            'endSale_6' => Yii::t('app', 'Конец акции'),
            'startSale_7' => Yii::t('app', 'Начало акции'),
            'endSale_7' => Yii::t('app', 'Конец акции'),
            'id_file' => Yii::t('app', 'Загрузить изображение'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainImg()
    {
        return $this->hasOne(FileImage::className(), ['id_file' => 'id_logo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAdvStats()
    {
        return $this->hasMany(TAdvStat::className(), ['office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTCalls()
    {
        return $this->hasMany(TCall::className(), ['office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTMenus()
    {
        return $this->hasMany(TMenu::className(), ['id_office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunity0()
    {
        return $this->hasOne(CCommunity::className(), ['id_community' => 'community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCity()
    {
        return $this->hasOne(GCity::className(), ['id_city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(Users::className(), ['id' => 'user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOfficeCategories()
    {
        return $this->hasMany(TOfficeCategory::className(), ['id_office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(TCategories::className(), ['id_category' => 'category'])->viaTable('t_office_category', ['id_office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOfficeContacts()
    {
        return $this->hasMany(TOfficeContact::className(), ['id_office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOfficeSections()
    {
        return $this->hasMany(TOfficeSection::className(), ['id_office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(TSection::className(), ['id_section' => 'section'])->viaTable('t_office_section', ['id_office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOfficeSectionV2s()
    {
        return $this->hasMany(TOfficeSectionV2::className(), ['id_office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOfficeTerminals()
    {
        return $this->hasMany(TOfficeTerminal::className(), ['id_office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerminals()
    {
        return $this->hasMany(TTerminal::className(), ['id_terminal' => 'terminal'])->viaTable('t_office_terminal', ['id_office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOfficeTws()
    {
        return $this->hasMany(TOfficeTw::className(), ['id_office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTWfOffices()
    {
        return $this->hasMany(TWfOffice::className(), ['id_office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWfs()
    {
        return $this->hasMany(TWebFilter::className(), ['id_wf' => 'id_wf'])->viaTable('t_wf_office', ['id_office' => 'id_office']);
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

    public function getCityList()
    {
        /*$modelGCities = GCity::find()
            ->joinWith('region0')
            ->where(['status' => 0])
            ->orderBy('name')
            ->all();*/
        //dd($modelGCity);



        /*$modelGCities = ArrayHelper::map(GCity::find()
            ->joinWith('region0')
            ->where(['status' => 0])
            ->orderBy('name')
            ->all(), 'id_city', 'name');*/
        //dd($appliances);
        /*$items = [];
        foreach($modelGCities as $key => $value) {
            $items[$key] = Yii::t('app', $value);
        }*/
        $items = [];
        /* @var $one \frontend\models\GCity */
        /*foreach($modelGCities as $one) {
            //echo "<option value='".$one->id_city."'>".$one->name."</option>";
            $items[$one->id_city] = Yii::t('app', $one->name.'<br>'.$one->region0->name.' '.$one->region0->kodTSt->socrname);
        }*/


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

    public function getCategoryValue($modelTOffice)
    {
        /* @var $modelTOffice TOffice */
        $items = [];
        foreach($modelTOffice->tOfficeCategories as $one) {
            $items[] = $one->category;
        }
        return $items;
    }

    public function getWorkMode($modelTOffice)
    {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeTw */
        foreach($modelTOffice->tOfficeTws as $one) {
            if($one->type == 0 && $one->start_time == 0 && $one->end_time == 0)
                return 2;
        }
        return 1;
    }

    public function getDaysOfWeekValue($modelTOffice)
    {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeTw */
        $items = [];
        foreach($modelTOffice->tOfficeTws as $one) {
            if($one->type == 0 && $one->day_of_week == 0)
                return [1,2,3,4,5,6,7];
            if($one->type == 0)
                $items[] = $one->day_of_week;
        }
        return $items;
    }
    
    /* ---------------------------- */

    public function getHourStartWorkWorkDay($modelTOffice) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeTw */
        $items = $this->getTimeArray($modelTOffice, $type = 0, $param = 'start_time');
        if($items && $items[0] != '00') {
            return $items[0];
        }
        return '10';
    }

    public function getMinutesStartWorkWorkDay($modelTOffice) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeTw */
        $items = $this->getTimeArray($modelTOffice, $type = 0, $param = 'start_time');
        if($items && $items[1] != '00') {
            return $items[1];
        }
        return '00';
    }

    public function getHourEndWorkWorkDay($modelTOffice) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeTw */
        $items = $this->getTimeArray($modelTOffice, $type = 0, $param = 'end_time');
        if($items && $items[0] != '00') {
            return $items[0];
        }
        return '18';
    }

    public function getMinutesEndWorkWorkDay($modelTOffice) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeTw */
        $items = $this->getTimeArray($modelTOffice, $type = 0, $param = 'end_time');
        if($items && $items[1] != '00') {
            return $items[1];
        }
        return '00';
    }
    
    /* ------------------------------- */
    public function getHourStartTimeout($modelTOffice) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeTw */
        $items = $this->getTimeArray($modelTOffice, $type = 1, $param = 'start_time');
        if($items && $items[0] != '00' && $items != 0) {
            return $items[0];
        }
        return '13';
    }

    public function getMinutesStartTimeout($modelTOffice) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeTw */
        $items = $this->getTimeArray($modelTOffice, $type = 1, $param = 'start_time');
        if($items && $items[1] != '00') {
            return $items[1];
        }
        return '00';
    }

    public function getHourEndTimeout($modelTOffice) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeTw */
        $items = $this->getTimeArray($modelTOffice, $type = 1, $param = 'end_time');
        if($items && $items[0] != '00') {
            return $items[0];
        }
        return '14';
    }

    public function getMinutesEndTimeout($modelTOffice) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeTw */
        $items = $this->getTimeArray($modelTOffice, $type = 1, $param = 'end_time');
        if($items && $items[1] != '00') {
            return $items[1];
        }
        return '00';
    }

    public function getTimeArray($modelTOffice, $type, $param) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeTw */
        $time = '';
        foreach($modelTOffice->tOfficeTws as $one) {
            if($one->type == $type) {
                $time = $one->$param;
            }
        }
        $items = explode(":", $time);
        return $items;
    }

    public function getTimeout($modelTOffice) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeTw */
        foreach($modelTOffice->tOfficeTws as $one) {
            if($one->type == 1)
                return 1;
        }
        return 0;
    }

    /* -------------------------------------- */

    public function getPnone($modelTOffice, $num) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeContact */
        $i = 1;
        foreach($modelTOffice->tOfficeContacts as $one) {
            if($one->type_contact == 1) {
                if($i == $num) {
                    //dd($one->contact);
                    return $one->contact;
                }
                $i++;
            }
        }
        return false;
    }

    public function getEmail($modelTOffice, $num) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOfficeContact */
        $i = 1;
        foreach($modelTOffice->tOfficeContacts as $one) {
            if($one->type_contact == 2) {
                if($i == $num) {
                    //dd($one->contact);
                    return $one->contact;
                }
                $i++;
            }
        }
        return false;
    }

    public function getProduct($TOfficeId, $num) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOffice */
        $modelTOffice = TOffice::findAll(['parent_office' => $TOfficeId]);
        $i = 1;
        foreach($modelTOffice as $one) {
            if($one->subtype == 2) {
                if($i == $num) {
                    //dd($one->contact);
                    return $one->title;
                }
                $i++;
            }
        }
        return false;
    }

    public function getService($TOfficeId, $num) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOffice */
        $modelTOffice = TOffice::findAll(['parent_office' => $TOfficeId]);
        $i = 1;
        foreach($modelTOffice as $one) {
            if($one->subtype == 5) {
                if($i == $num) {
                    //dd($one->contact);
                    return $one->title;
                }
                $i++;
            }
        }
        return false;
    }

    public function getSale($TOfficeId, $num) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOffice */
        $modelTOffice = TOffice::findAll(['parent_office' => $TOfficeId]);
        $i = 1;
        foreach($modelTOffice as $one) {
            if($one->subtype == 3) {
                if($i == $num) {
                    //dd($one->contact);
                    return $one->title;
                }
                $i++;
            }
        }
        return false;
    }

    public function getStartSale($TOfficeId, $num) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOffice */
        $modelTOffice = TOffice::findAll(['parent_office' => $TOfficeId]);
        $i = 1;
        foreach($modelTOffice as $one) {
            if($one->subtype == 3) {
                if($i == $num) {
                    //dd($one->contact);
                    return $one->period_from;
                }
                $i++;
            }
        }
        return time();
    }

    public function getEndSale($TOfficeId, $num) {
        /* @var $modelTOffice TOffice */
        /* @var $one TOffice */
        $modelTOffice = TOffice::findAll(['parent_office' => $TOfficeId]);
        $i = 1;
        foreach($modelTOffice as $one) {
            if($one->subtype == 3) {
                if($i == $num) {
                    //dd($one->contact);
                    return $one->period_to;
                }
                $i++;
            }
        }
        return time();
    }

    /* ----------------------------------- */

    public function getDaysList () {
        return ['1' => 'пн', '2' => 'вт', '3' => 'ср', '4' => 'чт', '5' => 'пт', '6' => 'сб', '7' => 'вс'];
    }

    public function saveCard() {
        if(!$this->validate()) {
            return $this;
        }
        /* @var $modelTOffice TOffice */
        /* все в t_office (sub_type = 1, is_moderate = 1, user = null) */
        $ext = explode(".", Yii::$app->request->post('old_file'));

        $modelTOffice = ($modelTOffice = TOffice::findOne($this->id_office)) ? $modelTOffice : new TOffice();
        $modelTOffice->setScenario('updateModel');
        $modelTOffice->title = $this->title;
        $modelTOffice->id_city = $this->id_city;
        $modelTOffice->street = $this->street;
        $modelTOffice->house = $this->house;
        $modelTOffice->corp = $this->corp;
        $modelTOffice->level = $this->level;
        $modelTOffice->num = $this->num;
        $modelTOffice->web = $this->web;
        $modelTOffice->phone = $this->phone;
        $modelTOffice->subtype = 1;
        $modelTOffice->is_moderate = 1;
        $modelTOffice->user = null;
        $modelTOffice->logo = $ext[1];
        $modelTOffice->id_logo = Yii::$app->request->post('id_file');
        $modelTOffice->is_spr = 1;

        /*d(Yii::$app->request->post('old_file'));

        $ext = explode(".", Yii::$app->request->post('old_file'));

        dd($ext[1]);*/

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($modelTOffice->save()) {
                $ok = $this->setCategories($modelTOffice->id_office);
                if($ok)
                    $ok = $this->setWorkMode($modelTOffice->id_office);
                if($ok)
                    $ok = $this->setContacts($modelTOffice->id_office);
                if($ok)
                    $ok = $this->setProducts($modelTOffice->id_office);
                if($ok)
                    $ok = $this->setServices($modelTOffice->id_office);
                if($ok)
                    $ok = $this->setSales($modelTOffice->id_office);
                if($ok)
                    $transaction->commit();
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        return $modelTOffice;
    }

    private function setCategories($idOffice) {
        /* @var $modelTOfficeCategory TOfficeCategory */
        TOfficeCategory::deleteAll(['id_office' => $idOffice]);
        foreach($this->category as $one) {
            $modelTOfficeCategory = new TOfficeCategory();
            $modelTOfficeCategory->id_office = $idOffice;
            $modelTOfficeCategory->category = $one;
            $modelTOfficeCategory->is_main = 1;
            if(!$modelTOfficeCategory->save()) {
                dd($modelTOfficeCategory->errors);
                return false;
            }
        }
        return true;
    }

    private function setWorkMode($idOffice) {
        /* t_office_tw - type (1 - перерыв, 0 - часы работы), day_of_week (день от 1 - 7, 0 все дни) */
        /* @var $modelTOfficeTw TOfficeTw */
        TOfficeTw::deleteAll([
            'id_office' => $idOffice,
        ]);
        if(count($this->daysOfWeek) == 7) {
            $modelTOfficeTw = new TOfficeTw();
            $modelTOfficeTw->id_office = $idOffice;
            $modelTOfficeTw->day_of_week = 0;
            $modelTOfficeTw->type = 0;
            if($this->workMode == 2) {
                $modelTOfficeTw->start_time = str_pad(0, 2, 0, STR_PAD_LEFT).':'.str_pad(0, 2, 0, STR_PAD_LEFT);
                $modelTOfficeTw->end_time = str_pad(0, 2, 0, STR_PAD_LEFT).':'.str_pad(0, 2, 0, STR_PAD_LEFT);
            } else {
                $modelTOfficeTw->start_time = str_pad($this->hours_start_workday, 2, 0, STR_PAD_LEFT).':'.str_pad($this->minutes_start_workday, 2, 0, STR_PAD_LEFT);
                $modelTOfficeTw->end_time = str_pad($this->hours_end_workday, 2, 0, STR_PAD_LEFT).':'.str_pad($this->minutes_end_workday, 2, 0, STR_PAD_LEFT);
            }
            if(!$modelTOfficeTw->save()) {
                dd(11);
                return false;
            }
        } else {
            foreach($this->daysOfWeek as $one) {
                $modelTOfficeTw = new TOfficeTw();
                $modelTOfficeTw->id_office = $idOffice;
                $modelTOfficeTw->day_of_week = $one;
                $modelTOfficeTw->type = 0;
                if($this->workMode == 2) {
                    $modelTOfficeTw->start_time = str_pad(0, 2, 0, STR_PAD_LEFT).':'.str_pad(0, 2, 0, STR_PAD_LEFT);
                    $modelTOfficeTw->end_time = str_pad(0, 2, 0, STR_PAD_LEFT).':'.str_pad(0, 2, 0, STR_PAD_LEFT);
                } else {
                    $modelTOfficeTw->start_time = str_pad($this->hours_start_workday, 2, 0, STR_PAD_LEFT).':'.str_pad($this->minutes_start_workday, 2, 0, STR_PAD_LEFT);
                    $modelTOfficeTw->end_time = str_pad($this->hours_end_workday, 2, 0, STR_PAD_LEFT).':'.str_pad($this->minutes_end_workday, 2, 0, STR_PAD_LEFT);
                }
                if(!$modelTOfficeTw->save()) {
                    dd(11);
                    return false;
                }
            }
        }

        if($this->timeout != '') {
            $modelTOfficeTw = new TOfficeTw();
            $modelTOfficeTw->id_office = $idOffice;
            $modelTOfficeTw->day_of_week = 0;
            $modelTOfficeTw->type = 1;
            $modelTOfficeTw->start_time = str_pad($this->hours_start_timeout, 2, 0, STR_PAD_LEFT).':'.str_pad($this->minutes_start_timeout, 2, 0, STR_PAD_LEFT);
            $modelTOfficeTw->end_time = str_pad($this->hours_end_timeout, 2, 0, STR_PAD_LEFT).':'.str_pad($this->minutes_end_timeout, 2, 0, STR_PAD_LEFT);
            if(!$modelTOfficeTw->save()) {
                dd(111);
                return false;
            }
        }

        return true;
    }

    private function setContacts($idOffice) {
        /* t_office_contact - type_contact (1 - phone, 2 - email, 3 - skype) */
        TOfficeContact::deleteAll([
            'id_office' => $idOffice,
        ]);
        $ok = true;
        if($this->phone)
            $ok = $this->saveContact($this->phone, $idOffice, $typeContact = 1);
        if($this->phone2)
            $ok = $this->saveContact($this->phone2, $idOffice, $typeContact = 1);
        if($this->email)
            $ok = $this->saveContact($this->email, $idOffice, $typeContact = 2);
        if($this->email_2)
            $ok = $this->saveContact($this->email_2, $idOffice, $typeContact = 2);
        return $ok;
    }

    private function saveContact($contact, $idOffice, $typeContact = 1) {
        /* @var $modelTOfficeContact TOfficeContact */
        /* t_office_contact - type_contact (1 - phone, 2 - email, 3 - skype) */
        $modelTOfficeContact = new TOfficeContact();
        $modelTOfficeContact->contact = $contact;
        $modelTOfficeContact->type_contact = $typeContact;
        $modelTOfficeContact->id_office = $idOffice;
        if(!$modelTOfficeContact->save()) {
            dd($modelTOfficeContact->errors);
            return false;
        }
        return true;
    }

    private function setProducts($idOffice) {
        $ok = true;
        TOffice::deleteAll(['parent_office' => $idOffice, 'subtype' => 2]);
        if($this->product)
            $ok = $this->saveSubType($this->product, $idOffice, $subType = 2);
        if($this->product_2) {
            $ok = $this->saveSubType($this->product_2, $idOffice, $subType = 2);
        }
        if($this->product_3)
            $ok = $this->saveSubType($this->product_3, $idOffice, $subType = 2);
        if($this->product_4)
            $ok = $this->saveSubType($this->product_4, $idOffice, $subType = 2);
        if($this->product_5)
            $ok = $this->saveSubType($this->product_5, $idOffice, $subType = 2);
        if($this->product_6)
            $ok = $this->saveSubType($this->product_6, $idOffice, $subType = 2);
        if($this->product_7)
            $ok = $this->saveSubType($this->product_7, $idOffice, $subType = 2);
        return $ok;
    }


    private function setSales($idOffice) {
        /* t_office (sub_type = 5, parent_office - id офиса с sub_type = 1) */
        $ok = true;
        TOffice::deleteAll(['parent_office' => $idOffice, 'subtype' => 3]);
        if($this->sale)
            $ok = $this->saveSubType($this->sale, $idOffice, $subType = 3, $startSale = $this->startSale, $startSale = $this->endSale);
        if($this->sale_2)
            $ok = $this->saveSubType($this->sale_2, $idOffice, $subType = 3, $startSale = $this->startSale_2, $startSale = $this->endSale_2);
        if($this->sale_3)
            $ok = $this->saveSubType($this->sale_3, $idOffice, $subType = 3, $startSale = $this->startSale_3, $startSale = $this->endSale_3);
        if($this->sale_4)
            $ok = $this->saveSubType($this->sale_4, $idOffice, $subType = 3, $startSale = $this->startSale_4, $startSale = $this->endSale_4);
        if($this->sale_5)
            $ok = $this->saveSubType($this->sale_5, $idOffice, $subType = 3, $startSale = $this->startSale_5, $startSale = $this->endSale_5);
        if($this->sale_6)
            $ok = $this->saveSubType($this->sale_6, $idOffice, $subType = 3, $startSale = $this->startSale_6, $startSale = $this->endSale_6);
        if($this->sale_7)
            $ok = $this->saveSubType($this->sale_7, $idOffice, $subType = 3, $startSale = $this->startSale_7, $startSale = $this->endSale_7);
        return $ok;
    }

    private function setServices($idOffice) {
        /* t_office (sub_type = 5, parent_office - id офиса с sub_type = 1) */
        $ok = true;
        TOffice::deleteAll(['parent_office' => $idOffice, 'subtype' => 5]);
        if($this->service)
            $ok = $this->saveSubType($this->service, $idOffice, $subType = 5);
        if($this->service_2)
            $ok = $this->saveSubType($this->service_2, $idOffice, $subType = 5);
        if($this->service_3)
            $ok = $this->saveSubType($this->service_3, $idOffice, $subType = 5);
        if($this->service_4)
            $ok = $this->saveSubType($this->service_4, $idOffice, $subType = 5);
        if($this->service_5)
            $ok = $this->saveSubType($this->service_5, $idOffice, $subType = 5);
        if($this->service_6)
            $ok = $this->saveSubType($this->service_6, $idOffice, $subType = 5);
        if($this->service_7)
            $ok = $this->saveSubType($this->service_7, $idOffice, $subType = 5);
        return $ok;
    }

    private function saveSubType($productName, $idOffice, $subType, $startSale = null, $endSale = null) {
        /* @var $modelTOffice TOffice */
        /* t_office (sub_type = 2, parent_office - id офиса с sub_type = 1) */
        $modelTOffice = new TOffice([]);
        $modelTOffice->setScenario('productSave');
        $modelTOffice->subtype = $subType;
        $modelTOffice->parent_office = $idOffice;
        $modelTOffice->title = $productName;
        $modelTOffice->period_from = $startSale;
        $modelTOffice->period_to = $endSale;
        if(!$modelTOffice->save()) {
            dd($modelTOffice->errors);
            return false;
        }
        return true;
    }
}
