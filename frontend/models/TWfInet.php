<?php

namespace app\modules\bts\models;

use Yii;

/**
 * This is the model class for table "t_wf_office".
 *
 * @property integer $id_wf
 * @property integer $id_office
 *
 * @property TInternet $idInternet
 * @property TWebFilter $idWf
 * @property TOffice $idOffice
 */
class TWfInet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_wf_office';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_wf', 'id_office'], 'required'],
            [['id_wf', 'id_office'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_wf' => 'Id Wf',
            'id_office' => 'Id Office',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInternet()
    {
        return $this->hasOne(TInternet::className(), ['id_internet' => 'id_internet']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWf()
    {
        return $this->hasOne(TWebFilter::className(), ['id_wf' => 'id_wf']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOffice()
    {
        return $this->hasOne(TOffice::className(), ['id_office' => 'id_office']);
    }
}
