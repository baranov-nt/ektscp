<?php

namespace common\models;

use Yii;

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
 * @property TPerson[] $tPeople
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
            [['name', 'aoid'], 'string'],
            [['region', 'id_area', 'kod_t_st', 'status', 'to_moderate', 'creator'], 'integer'],
            [['id_area'], 'exist', 'skipOnError' => true, 'targetClass' => GArea::className(), 'targetAttribute' => ['id_area' => 'id_area']],
            [['kod_t_st'], 'exist', 'skipOnError' => true, 'targetClass' => GFiasSocrbase::className(), 'targetAttribute' => ['kod_t_st' => 'kod_t_st']],
            [['region'], 'exist', 'skipOnError' => true, 'targetClass' => GRegion::className(), 'targetAttribute' => ['region' => 'id_region']],
            [['creator'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['creator' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_city' => Yii::t('app', 'Id City'),
            'name' => Yii::t('app', 'Name'),
            'region' => Yii::t('app', 'Region'),
            'aoid' => Yii::t('app', 'Aoid'),
            'id_area' => Yii::t('app', 'Id Area'),
            'kod_t_st' => Yii::t('app', 'Kod T St'),
            'status' => Yii::t('app', 'Status'),
            'to_moderate' => Yii::t('app', 'To Moderate'),
            'creator' => Yii::t('app', 'Creator'),
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
    public function getTPeople()
    {
        return $this->hasMany(TPerson::className(), ['city' => 'id_city']);
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
}
