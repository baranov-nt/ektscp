<?php

namespace app\modules\bts\models;

use Yii;

/**
 * This is the model class for table "t_wf_adv".
 *
 * @property integer $id_wf
 * @property integer $id_adv
 *
 * @property TAdv $idAdv
 * @property TWebFilter $idWf
 */
class TWfAdv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_wf_adv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_wf', 'id_adv'], 'required'],
            [['id_wf', 'id_adv'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_wf' => 'Id Wf',
            'id_adv' => 'Id Adv',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAdv()
    {
        return $this->hasOne(TAdv::className(), ['id_adv' => 'id_adv']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWf()
    {
        return $this->hasOne(TWebFilter::className(), ['id_wf' => 'id_wf']);
    }
}
