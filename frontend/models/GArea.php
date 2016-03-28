<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "g_area".
 *
 * @property integer $id_area
 * @property string $name
 * @property string $aoid
 * @property integer $id_region
 * @property integer $kod_t_st
 *
 * @property GFiasSocrbase $kodTSt
 * @property GRegion $idRegion
 * @property GCity[] $gCities
 */
class GArea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'g_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_region', 'kod_t_st'], 'required'],
            [['name', 'aoid'], 'string'],
            [['id_region', 'kod_t_st'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_area' => 'Id Area',
            'name' => 'Name',
            'aoid' => 'Aoid',
            'id_region' => 'Id Region',
            'kod_t_st' => 'Kod T St',
        ];
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
    public function getIdRegion()
    {
        return $this->hasOne(GRegion::className(), ['id_region' => 'id_region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGCities()
    {
        return $this->hasMany(GCity::className(), ['id_area' => 'id_area']);
    }
}
