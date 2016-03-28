<?php

namespace app\modules\bts\models;

use Yii;

/**
 * This is the model class for table "t_wf_person".
 *
 * @property integer $id_wf
 * @property integer $id_person
 *
 * @property TPerson $idPerson
 * @property TWebFilter $idWf
 */
class TWfPerson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_wf_person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_wf', 'id_person'], 'required'],
            [['id_wf', 'id_person'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_wf' => 'Id Wf',
            'id_person' => 'Id Person',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPerson()
    {
        return $this->hasOne(TPerson::className(), ['id_person' => 'id_person']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWf()
    {
        return $this->hasOne(TWebFilter::className(), ['id_wf' => 'id_wf']);
    }
}
