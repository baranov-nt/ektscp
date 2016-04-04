<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "g_edu_org".
 *
 * @property integer $id_edu_org
 * @property integer $city
 * @property integer $type_edu
 * @property string $name
 *
 * @property GCity $city0
 * @property GReferens $typeEdu
 * @property TPersonEdu[] $tPersonEdus
 */
class GEduOrg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'g_edu_org';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'type_edu'], 'integer'],
            [['type_edu'], 'required'],
            [['name'], 'string'],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => GCity::className(), 'targetAttribute' => ['city' => 'id_city']],
            [['type_edu'], 'exist', 'skipOnError' => true, 'targetClass' => GReferens::className(), 'targetAttribute' => ['type_edu' => 'id_ref']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_edu_org' => Yii::t('app', 'Id Edu Org'),
            'city' => Yii::t('app', 'City'),
            'type_edu' => Yii::t('app', 'Type Edu'),
            'name' => Yii::t('app', 'Name'),
        ];
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
    public function getTypeEdu()
    {
        return $this->hasOne(GReferens::className(), ['id_ref' => 'type_edu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPersonEdus()
    {
        return $this->hasMany(TPersonEdu::className(), ['edu_org' => 'id_edu_org']);
    }
}
