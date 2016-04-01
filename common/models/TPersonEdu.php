<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_person_edu".
 *
 * @property integer $id_edu
 * @property integer $type_edu 9
 * @property integer $city
 * @property string $edu_org text
 * @property integer $start_year
 * @property integer $end_year
 * @property string $faculty text
 * @property string $cafedra text
 * @property string $speciality text
 * @property integer $status 481
 * @property integer $id_person
 *
 * @property GCity $city0
 * @property GReferens $status0
 */
class TPersonEdu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_person_edu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_edu', 'edu_org', 'id_person'], 'required'],
            [['type_edu', 'city', 'start_year', 'end_year', 'status', 'id_person'], 'integer'],
            [['edu_org', 'faculty', 'cafedra', 'speciality'], 'string'],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => GCity::className(), 'targetAttribute' => ['city' => 'id_city']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => GReferens::className(), 'targetAttribute' => ['status' => 'id_ref']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_edu' => Yii::t('app', 'Id Edu'),
            'type_edu' => Yii::t('app', 'Type Edu'),
            'city' => Yii::t('app', 'City'),
            'edu_org' => Yii::t('app', 'Edu Org'),
            'start_year' => Yii::t('app', 'Start Year'),
            'end_year' => Yii::t('app', 'End Year'),
            'faculty' => Yii::t('app', 'Faculty'),
            'cafedra' => Yii::t('app', 'Cafedra'),
            'speciality' => Yii::t('app', 'Speciality'),
            'status' => Yii::t('app', 'Status'),
            'id_person' => Yii::t('app', 'Id Person'),
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
    public function getStatus0()
    {
        return $this->hasOne(GReferens::className(), ['id_ref' => 'status']);
    }
}
