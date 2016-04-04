<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_person_edu".
 *
 * @property integer $id_edu
 * @property integer $edu_org
 * @property integer $start_year
 * @property integer $end_year
 * @property string $faculty
 * @property string $cafedra
 * @property string $speciality
 * @property integer $status
 * @property integer $id_person
 *
 * @property GEduOrg $eduOrg
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
            [['edu_org', 'id_person'], 'required'],
            [['edu_org', 'start_year', 'end_year', 'status', 'id_person'], 'integer'],
            [['faculty', 'cafedra', 'speciality'], 'string'],
            [['edu_org'], 'exist', 'skipOnError' => true, 'targetClass' => GEduOrg::className(), 'targetAttribute' => ['edu_org' => 'id_edu_org']],
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
    public function getEduOrg()
    {
        return $this->hasOne(GEduOrg::className(), ['id_edu_org' => 'edu_org']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(GReferens::className(), ['id_ref' => 'status']);
    }
}
