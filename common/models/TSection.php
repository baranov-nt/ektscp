<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_section".
 *
 * @property integer $id_section
 * @property string $name
 * @property integer $terminal
 *
 * @property TCategories[] $tCategories
 * @property TOfficeSection[] $tOfficeSections
 * @property TOffice[] $idOffices
 * @property TOfficeSectionV2[] $tOfficeSectionV2s
 * @property TPersonSection[] $tPersonSections
 * @property TTerminal $terminal0
 */
class TSection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['terminal'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_section' => Yii::t('app', 'Id Section'),
            'name' => Yii::t('app', 'Name'),
            'terminal' => Yii::t('app', 'Terminal'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTCategories()
    {
        return $this->hasMany(TCategories::className(), ['section' => 'id_section']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOfficeSections()
    {
        return $this->hasMany(TOfficeSection::className(), ['section' => 'id_section']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOffices()
    {
        return $this->hasMany(TOffice::className(), ['id_office' => 'id_office'])->viaTable('t_office_section', ['section' => 'id_section']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOfficeSectionV2s()
    {
        return $this->hasMany(TOfficeSectionV2::className(), ['section' => 'id_section']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPersonSections()
    {
        return $this->hasMany(TPersonSection::className(), ['section' => 'id_section']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerminal0()
    {
        return $this->hasOne(TTerminal::className(), ['id_terminal' => 'terminal']);
    }
}
