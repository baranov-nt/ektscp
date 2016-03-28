<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_office_section".
 *
 * @property integer $id_office
 * @property integer $section
 *
 * @property TOffice $idOffice
 * @property TSection $section0
 */
class TOfficeSection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_office_section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_office', 'section'], 'required'],
            [['id_office', 'section'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_office' => Yii::t('app', 'Id Office'),
            'section' => Yii::t('app', 'Section'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOffice()
    {
        return $this->hasOne(TOffice::className(), ['id_office' => 'id_office']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection0()
    {
        return $this->hasOne(TSection::className(), ['id_section' => 'section']);
    }
}
