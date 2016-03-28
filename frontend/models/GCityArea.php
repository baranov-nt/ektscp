<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "g_city_area".
 *
 * @property integer $id_ca
 * @property integer $city
 * @property string $name
 * @property integer $status
 * @property integer $to_moderate
 * @property integer $creator
 * @property integer $parent_id
 *
 * @property AdsAgencyOuter[] $adsAgencyOuters
 * @property AdsAgencyStands[] $adsAgencyStands
 * @property AdsAgencyTerminals[] $adsAgencyTerminals
 * @property AdsAgencyTerminals[] $adsAgencyTerminals0
 * @property EsEstate[] $esEstates
 * @property GCity $city0
 * @property GCityArea $parent
 * @property GCityArea[] $gCityAreas
 * @property Users $creator0
 * @property TTerminal[] $tTerminals
 */
class GCityArea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'g_city_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'name', 'status', 'to_moderate'], 'required'],
            [['city', 'status', 'to_moderate', 'creator', 'parent_id'], 'integer'],
            [['name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ca' => 'Id Ca',
            'city' => 'City',
            'name' => 'Name',
            'status' => 'Status',
            'to_moderate' => 'To Moderate',
            'creator' => 'Creator',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyOuters()
    {
        return $this->hasMany(AdsAgencyOuter::className(), ['city_area' => 'id_ca']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyStands()
    {
        return $this->hasMany(AdsAgencyStands::className(), ['city_area' => 'id_ca']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyTerminals()
    {
        return $this->hasMany(AdsAgencyTerminals::className(), ['city_area' => 'id_ca']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyTerminals0()
    {
        return $this->hasMany(AdsAgencyTerminals::className(), ['city_area' => 'id_ca']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsEstates()
    {
        return $this->hasMany(EsEstate::className(), ['city_area' => 'id_ca']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0()
    {
        return $this->hasOne(GCity::className(), ['id_city' => 'city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(GCityArea::className(), ['id_ca' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGCityAreas()
    {
        return $this->hasMany(GCityArea::className(), ['parent_id' => 'id_ca']);
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
    public function getTTerminals()
    {
        return $this->hasMany(TTerminal::className(), ['city_area' => 'id_ca']);
    }
}
