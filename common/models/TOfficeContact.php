<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_office_contact".
 *
 * @property integer $id_oc
 * @property integer $type_contact
 * @property string $contact
 * @property integer $id_office
 *
 * @property TOffice $idOffice
 */
class TOfficeContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_office_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_contact', 'contact', 'id_office'], 'required'],
            [['type_contact', 'id_office'], 'integer'],
            [['contact'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_oc' => Yii::t('app', 'Id Oc'),
            'type_contact' => Yii::t('app', 'Type Contact'),
            'contact' => Yii::t('app', 'Contact'),
            'id_office' => Yii::t('app', 'Id Office'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOffice()
    {
        return $this->hasOne(TOffice::className(), ['id_office' => 'id_office']);
    }
}
