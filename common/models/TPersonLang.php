<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_person_lang".
 *
 * @property integer $id_person
 * @property integer $id_lang
 *
 * @property GLang $idLang
 * @property TPerson $idPerson
 */
class TPersonLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_person_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_person', 'id_lang'], 'required'],
            [['id_person', 'id_lang'], 'integer'],
            [['id_lang'], 'exist', 'skipOnError' => true, 'targetClass' => GLang::className(), 'targetAttribute' => ['id_lang' => 'id_lang']],
            [['id_person'], 'exist', 'skipOnError' => true, 'targetClass' => TPerson::className(), 'targetAttribute' => ['id_person' => 'id_person']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_person' => Yii::t('app', 'Id Person'),
            'id_lang' => Yii::t('app', 'Id Lang'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLang()
    {
        return $this->hasOne(GLang::className(), ['id_lang' => 'id_lang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPerson()
    {
        return $this->hasOne(TPerson::className(), ['id_person' => 'id_person']);
    }
}
