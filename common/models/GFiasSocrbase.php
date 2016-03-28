<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "g_fias_socrbase".
 *
 * @property integer $level
 * @property string $scname
 * @property string $socrname
 * @property integer $kod_t_st
 *
 * @property GArea[] $gAreas
 * @property GCity[] $gCities
 * @property GRegion[] $gRegions
 * @property GStreet[] $gStreets
 */
class GFiasSocrbase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'g_fias_socrbase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'scname', 'socrname', 'kod_t_st'], 'required'],
            [['level', 'kod_t_st'], 'integer'],
            [['scname', 'socrname'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'level' => Yii::t('app', 'Level'),
            'scname' => Yii::t('app', 'Scname'),
            'socrname' => Yii::t('app', 'Socrname'),
            'kod_t_st' => Yii::t('app', 'Kod T St'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGAreas()
    {
        return $this->hasMany(GArea::className(), ['kod_t_st' => 'kod_t_st']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGCities()
    {
        return $this->hasMany(GCity::className(), ['kod_t_st' => 'kod_t_st']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGRegions()
    {
        return $this->hasMany(GRegion::className(), ['kod_t_st' => 'kod_t_st']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGStreets()
    {
        return $this->hasMany(GStreet::className(), ['kod_t_st' => 'kod_t_st']);
    }
}
