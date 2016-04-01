<?php

namespace common\models;

use frontend\models\GCity;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_adv".
 *
 * @property integer $id_adv
 * @property integer $type
 * @property integer $type_adv
 * @property integer $place_type
 * @property integer $priority_type
 * @property string $file
 * @property string $phone
 * @property string $web
 * @property string $title
 * @property string $subtitle
 * @property string $txt
 * @property string $name
 * @property integer $category
 * @property integer $user
 * @property integer $agent
 * @property integer $community
 * @property integer $status
 * @property integer $vip
 * @property string $id_file
 * @property integer $id_campany
 * @property string $created
 * @property integer $id_city
 * @property string $street
 * @property string $house
 * @property string $num
 * @property integer $prev_adv
 * @property integer $sex
 * @property integer $min_age_0
 * @property integer $max_age_0
 * @property integer $min_age_1
 * @property integer $max_age_1
 * @property integer $period
 * @property integer $id_office
 *
 * @property TCampany $idCampany
 * @property TAdvShedule[] $tAdvShedules
 * @property TAdvStat[] $tAdvStats
 * @property TCall[] $tCalls
 * @property TWfAdv[] $tWfAdvs
 * @property TWebFilter[] $idWfs
 */
class TAdv extends \yii\db\ActiveRecord
{
    public $city;
    public $showTime;
    public $format;
    public $term;
    public $places;
    public $officeChoose;
    public $modules;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_adv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'type_adv'], 'required'],
            [['type', 'type_adv', 'place_type', 'priority_type', 'category', 'user', 'agent', 'community', 'status', 'vip', 'id_file', 'id_campany', 'id_city',
                'prev_adv', 'sex', 'min_age_0', 'max_age_0', 'min_age_1', 'max_age_1', 'period', 'id_office', 'city', 'timeShow', 'officeChoose'], 'integer'],
            [['file', 'phone', 'web', 'title', 'subtitle', 'txt', 'name', 'street', 'house', 'num'], 'string'],
            [['created'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_adv' => Yii::t('app', 'Id Adv'),
            'type' => Yii::t('app', 'Type'),
            'type_adv' => Yii::t('app', 'Type Adv'),
            'place_type' => Yii::t('app', 'Place Type'),
            'priority_type' => Yii::t('app', 'Priority Type'),
            'file' => Yii::t('app', 'File'),
            'phone' => Yii::t('app', 'Phone'),
            'web' => Yii::t('app', 'Web'),
            'title' => Yii::t('app', 'Title'),
            'subtitle' => Yii::t('app', 'Subtitle'),
            'txt' => Yii::t('app', 'Txt'),
            'name' => Yii::t('app', 'Name'),
            'category' => Yii::t('app', 'Category'),
            'user' => Yii::t('app', 'User'),
            'agent' => Yii::t('app', 'Agent'),
            'community' => Yii::t('app', 'Community'),
            'status' => Yii::t('app', 'Status'),
            'vip' => Yii::t('app', 'Vip'),
            'id_file' => Yii::t('app', 'Id File'),
            'id_campany' => Yii::t('app', 'Id Campany'),
            'created' => Yii::t('app', 'Created'),
            'id_city' => Yii::t('app', 'Id City'),
            'street' => Yii::t('app', 'Street'),
            'house' => Yii::t('app', 'House'),
            'num' => Yii::t('app', 'Num'),
            'prev_adv' => Yii::t('app', 'Prev Adv'),
            'sex' => Yii::t('app', 'Sex'),
            'min_age_0' => Yii::t('app', 'Min Age 0'),
            'max_age_0' => Yii::t('app', 'Max Age 0'),
            'min_age_1' => Yii::t('app', 'Min Age 1'),
            'max_age_1' => Yii::t('app', 'Max Age 1'),
            'period' => Yii::t('app', 'Period'),
            'id_office' => Yii::t('app', 'Id Office'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCampany()
    {
        return $this->hasOne(TCampany::className(), ['id_campany' => 'id_campany']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAdvShedules()
    {
        return $this->hasMany(TAdvShedule::className(), ['adv' => 'id_adv']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAdvStats()
    {
        return $this->hasMany(TAdvStat::className(), ['adv' => 'id_adv']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTCalls()
    {
        return $this->hasMany(TCall::className(), ['adv' => 'id_adv']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTWfAdvs()
    {
        return $this->hasMany(TWfAdv::className(), ['id_adv' => 'id_adv']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWfs()
    {
        return $this->hasMany(TWebFilter::className(), ['id_wf' => 'id_wf'])->viaTable('t_wf_adv', ['id_adv' => 'id_adv']);
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
	
    public function getFormatList()
    {
        $items = [];
        $items['_format_template'] = 'Готовые шаблоны';
        $items['_format_video_banner'] = 'Баннер, видеоролик';
        $items['_format_ineractive_vizitka'] = 'Интерактивная визитка';
        $items['_format_ineractive_banner'] = 'Интерактивный банер';
        $items['_format_site_app'] = 'Сайт, приложение';
        return $items;
    }

    public function getShowTimeList()
    {
        $items = [];
        $items['600'] = 'Каждые 10 мин. - 72/144 - (бесплатно)';
        $items['540'] = 'Каждые 9 мин. - 80/160';
        $items['480'] = 'Каждые 8 мин. - 90/180';
        $items['420'] = 'Каждые 7 мин. - 109/218';
        $items['360'] = 'Каждые 6 мин. - 120/240';
        $items['300'] = 'Каждые 5 мин. - 144/288';
        $items['240'] = 'Каждые 4 мин. - 180/360';
        $items['180'] = 'Каждые 3 мин. - 240/480';
        $items['120'] = 'Каждые 2 мин. - 360/720';
        $items['60'] = 'Каждыю 1 мин. - 720/1440';
        $items['20'] = 'Каждые 20-40 сек. - 1000/2000';
        $items['10'] = 'Каждые 10-30 сек. - 1500/3000';
        $items['0'] = 'Свободное время';
        return $items;
    }
	
    public function getTermList()
    {
        $items = [];
        $items['+1 day'] = '1 день';
        $items['+3 day'] = '3 дня (скидка 5%)';
        $items['+1 week'] = '1 неделя (скидка 10%)';
        $items['+2 week'] = '2 недели (скидка 15%)';
        $items['+3 week'] = '3 недели (скидка 20%)';
        $items['+1 month'] = '1 месяц (скидка 25%)';
        $items['+2 month'] = '2 месяца (скидка 30%)';
        $items['+3 month'] = '3 месяца (скидка 35%)';
        $items['+4 month'] = '4 месяца (скидка 40%)';
        $items['+5 month'] = '5 месяцев (скидка 45%)';
        $items['+6 month'] = '6 месяцев (скидка 50%)';
        return $items;
    }
	
    public function getModulesList()
    {
        $items = [];
        $items[0] = 'Телефон';
        $items[1] = 'Навигация';
        $items[2] = 'Товары и услуги';
        $items[3] = 'Игры';
        $items[4] = 'Социальные сети';
        $items[5] = 'Все модули';
        return $items;
    }
	
    public function getPlacesList()
    {
        $appliances = ArrayHelper::map(GReferens::findAll(['base_ref' => 426]), 'id_ref', 'name');
        $items = [];
        foreach($appliances as $key => $value) {
            $items[$key] = Yii::t('app', $value);
        }
        return $items;
    }
}
