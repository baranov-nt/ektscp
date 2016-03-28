<?php

namespace app\modules\bts\models;

use Yii;

/**
 * This is the model class for table "t_wf_menu".
 *
 * @property integer $id_wf
 * @property integer $id_mi
 *
 * @property TMenu $idMi
 * @property TWebFilter $idWf
 */
class TWfMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_wf_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_wf', 'id_mi'], 'required'],
            [['id_wf', 'id_mi'], 'integer'],
            [['id_wf'], 'exist', 'skipOnError' => true, 'targetClass' => TWebFilter::className(), 'targetAttribute' => ['id_wf' => 'id_wf']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_wf' => Yii::t('app', 'Id Wf'),
            'id_mi' => Yii::t('app', 'Id Mi'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMi()
    {
        return $this->hasOne(TMenu::className(), ['id_mi' => 'id_mi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWf()
    {
        return $this->hasOne(TWebFilter::className(), ['id_wf' => 'id_wf']);
    }
}
