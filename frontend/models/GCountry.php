<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "g_country".
 *
 * @property integer $id_country
 * @property string $name
 * @property integer $to_moderate
 *
 * @property AdsAgencyPlaceCountry[] $adsAgencyPlaceCountries
 * @property GRegion[] $gRegions
 */
class GCountry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'g_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['to_moderate'], 'required'],
            [['to_moderate'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_country' => 'Id Country',
            'name' => 'Name',
            'to_moderate' => 'To Moderate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyPlaceCountries()
    {
        return $this->hasMany(AdsAgencyPlaceCountry::className(), ['id_country' => 'id_country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGRegions()
    {
        return $this->hasMany(GRegion::className(), ['country' => 'id_country']);
    }
}
