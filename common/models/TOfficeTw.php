<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_office_tw".
 *
 * @property string $id_tw
 * @property integer $id_office
 * @property integer $type
 * @property integer $day_of_week
 * @property string $start_time
 * @property string $end_time
 *
 * @property TOffice $idOffice
 */
class TOfficeTw extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_office_tw';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_office', 'type', 'day_of_week'], 'required'],
            [['id_office', 'type', 'day_of_week'], 'integer'],
            [['start_time', 'end_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tw' => Yii::t('app', 'Id Tw'),
            'id_office' => Yii::t('app', 'Id Office'),
            'type' => Yii::t('app', 'Type'),
            'day_of_week' => Yii::t('app', 'Day Of Week'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
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
