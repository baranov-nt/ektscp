<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "g_city".
 *
 * @property integer $id_city
 * @property string $name
 * @property integer $region
 * @property string $aoid
 * @property integer $id_area
 * @property integer $kod_t_st
 * @property integer $status
 * @property integer $to_moderate
 * @property integer $creator
 * @property integer $yw_id
 * @property string $phone_code
 *
 * @property AdsAgencyPlaceCities[] $adsAgencyPlaceCities
 * @property EsEstate[] $esEstates
 * @property GArea $idArea
 * @property GFiasSocrbase $kodTSt
 * @property GRegion $region0
 * @property Users $creator0
 * @property GCityArea[] $gCityAreas
 * @property GStreet[] $gStreets
 * @property GSubwayStation[] $gSubwayStations
 * @property PhysEdu[] $physEdus
 * @property PhysWork[] $physWorks
 * @property Profiles[] $profiles
 * @property TInternet[] $tInternets
 * @property TMenu[] $tMenus
 * @property TOffice[] $tOffices
 * @property TTerminal[] $tTerminals
 * @property WorkResume[] $workResumes
 * @property WorkResumeWork[] $workResumeWorks
 * @property WorkVacancy[] $workVacancies
 */
class GCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'g_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'aoid', 'phone_code'], 'string'],
            [['region', 'id_area', 'kod_t_st', 'status', 'to_moderate', 'creator', 'yw_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_city' => 'Id City',
            'name' => 'Name',
            'region' => 'Region',
            'aoid' => 'Aoid',
            'id_area' => 'Id Area',
            'kod_t_st' => 'Kod T St',
            'status' => 'Status',
            'to_moderate' => 'To Moderate',
            'creator' => 'Creator',
            'yw_id' => 'Yw ID',
            'phone_code' => 'Phone Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyPlaceCities()
    {
        return $this->hasMany(AdsAgencyPlaceCities::className(), ['id_city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsEstates()
    {
        return $this->hasMany(EsEstate::className(), ['city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdArea()
    {
        return $this->hasOne(GArea::className(), ['id_area' => 'id_area']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodTSt()
    {
        return $this->hasOne(GFiasSocrbase::className(), ['kod_t_st' => 'kod_t_st']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion0()
    {
        return $this->hasOne(GRegion::className(), ['id_region' => 'region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator0()
    {
        return $this->hasOne(Users::className(), ['id' => 'creator']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGCityAreas()
    {
        return $this->hasMany(GCityArea::className(), ['city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGStreets()
    {
        return $this->hasMany(GStreet::className(), ['city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGSubwayStations()
    {
        return $this->hasMany(GSubwayStation::className(), ['subway_city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhysEdus()
    {
        return $this->hasMany(PhysEdu::className(), ['city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhysWorks()
    {
        return $this->hasMany(PhysWork::className(), ['city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profiles::className(), ['city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTInternets()
    {
        return $this->hasMany(TInternet::className(), ['city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTMenus()
    {
        return $this->hasMany(TMenu::className(), ['city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOffices()
    {
        return $this->hasMany(TOffice::className(), ['id_city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTerminals()
    {
        return $this->hasMany(TTerminal::className(), ['city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkResumes()
    {
        return $this->hasMany(WorkResume::className(), ['city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkResumeWorks()
    {
        return $this->hasMany(WorkResumeWork::className(), ['city' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkVacancies()
    {
        return $this->hasMany(WorkVacancy::className(), ['city' => 'id_city']);
    }

    public function getCityList()
    {
        return 121212;
        /*$appliances = ArrayHelper::map(GCity::find()
            ->orderBy('name')
            ->all(), 'id_city', 'name');
        $items = [];
        foreach($appliances as $key => $value) {
            $items[$key] = Yii::t('app', $value);
        }
        return $items;*/
    }
}
