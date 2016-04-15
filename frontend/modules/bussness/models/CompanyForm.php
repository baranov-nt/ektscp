<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 02.05.2015
 * Time: 18:17
 */
namespace frontend\modules\bussness\models;

use common\models\TCategories;
use common\models\TOffice;
use common\models\TOfficeCategory;
use frontend\models\GRegion;
use yii\base\Model;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class CompanyForm extends Model
{
    public $name;
    public $desc;
    public $city;
    public $street;
    public $house;
    public $housing;
    public $office;
    public $phone;
    public $categories;

    public function rules()
    {
        return [
            [['city', 'house', 'office'], 'integer'],
            [['phone', 'name', 'street', 'housing', 'desc'], 'string'],
            [['phone', 'name', 'desc', 'city', 'street', 'house', 'categories'],'required'],
            [['phone', 'name', 'city', 'street', 'house', 'housing', 'office'],'filter', 'filter' => 'trim'],
            //['categories', 'each', 'rule' => ['integer']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'desc' => 'Описание',
            'city' => 'Город',
            'street' => 'Улица',
            'house' => 'Дом',
            'housing' => 'Корпус',
            'office' => 'Офис',
            'phone' => 'Телефон',
            'categories' => 'Категории'
        ];
    }

    public function getCategoryList()
    {
        $categories = ArrayHelper::map(TCategories::find()
            ->where(['section' => 54])
            ->orderBy('turn')
            ->all(), 'id_category', 'name');
        $items = [];

        foreach($categories as $key => $value) {
            $items[$key] = \Yii::t('app', $value);
        }
        return $items;
    }

    public function getCityList()
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
                $items[$region->name.' '.$region->kodTSt->socrname][$city->id_city] = \Yii::t('app', $city->name);
            }
        }

        return $items;
    }

    public function saveBussness() {
        /* @var $modelTOffice TOffice */
        if($this->validate()) {
            $modelTOffice = new TOffice();
            $modelTOffice->title = $this->name;
            $modelTOffice->id_city = $this->city;
            $modelTOffice->street = $this->street;
            $modelTOffice->house = $this->house;
            $modelTOffice->corp = $this->housing;
            $modelTOffice->num = $this->office;
            $modelTOffice->phone = $this->phone;
            $modelTOffice->subtype = 1;
            $modelTOffice->is_moderate = 1;
            $modelTOffice->user = \Yii::$app->user->id;
            $modelTOffice->is_spr = 1;
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if ($modelTOffice->save()) {
                    $ok = $this->setCategories($modelTOffice->id_office);
                    if($ok) {
                        $transaction->commit();
                        return $modelTOffice->id_office;
                    }
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
            return false;
        } else {
            return $this;
        }
    }

    private function setCategories($idOffice) {
        TOfficeCategory::deleteAll(['id_office' => $idOffice]);
        foreach($this->categories as $one) {
            $modelTOfficeCategory = new TOfficeCategory();
            $modelTOfficeCategory->id_office = $idOffice;
            $modelTOfficeCategory->category = $one;
            $modelTOfficeCategory->is_main = 1;
            if(!$modelTOfficeCategory->save())
                return false;
        }
        return true;
    }
}
