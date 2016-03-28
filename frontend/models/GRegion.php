<?php

namespace frontend\models;

use Yii;
use common\models\GFiasSocrbase;

/**
 * This is the model class for table "g_region".
 *
 * @property integer $id_region
 * @property string $name
 * @property integer $country
 * @property string $aoid
 * @property integer $kod_t_st
 *
 * @property AdsAgencyPlaceRegion[] $adsAgencyPlaceRegions
 * @property GArea[] $gAreas
 * @property GCity[] $gCities
 * @property GCountry $country0
 * @property GFiasSocrbase $kodTSt
 */
class GRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'g_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'country', 'kod_t_st'], 'required'],
            [['name', 'aoid'], 'string'],
            [['country', 'kod_t_st'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_region' => 'Id Region',
            'name' => 'Name',
            'country' => 'Country',
            'aoid' => 'Aoid',
            'kod_t_st' => 'Kod T St',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyPlaceRegions()
    {
        return $this->hasMany(AdsAgencyPlaceRegion::className(), ['id_region' => 'id_region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGAreas()
    {
        return $this->hasMany(GArea::className(), ['id_region' => 'id_region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGCities()
    {
        return $this->hasMany(GCity::className(), ['region' => 'id_region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(GCountry::className(), ['id_country' => 'country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodTSt()
    {
        return $this->hasOne(GFiasSocrbase::className(), ['kod_t_st' => 'kod_t_st']);
    }
}
