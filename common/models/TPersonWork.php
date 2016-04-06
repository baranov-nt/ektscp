<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_person_work".
 *
 * @property integer $id_work
 * @property integer $city
 * @property string $org
 * @property integer $start_year
 * @property integer $end_year
 * @property string $post
 * @property integer $id_person
 * @property integer $id_office
 *
 * @property GCity $city0
 * @property TPerson $idPerson
 */
class TPersonWork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_person_work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'start_year', 'end_year', 'id_person', 'id_office'], 'integer'],
            [['org', 'id_person'], 'required'],
            [['org', 'post'], 'string'],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => GCity::className(), 'targetAttribute' => ['city' => 'id_city']],
            [['id_person'], 'exist', 'skipOnError' => true, 'targetClass' => TPerson::className(), 'targetAttribute' => ['id_person' => 'id_person']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_work' => Yii::t('app', 'Id Work'),
            'city' => Yii::t('app', 'City'),
            'org' => Yii::t('app', 'Org'),
            'start_year' => Yii::t('app', 'Start Year'),
            'end_year' => Yii::t('app', 'End Year'),
            'post' => Yii::t('app', 'Post'),
            'id_person' => Yii::t('app', 'Id Person'),
            'id_office' => Yii::t('app', 'Id Office'),
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
    public function getIdPerson()
    {
        return $this->hasOne(TPerson::className(), ['id_person' => 'id_person']);
    }
}
