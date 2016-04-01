<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "g_lang".
 *
 * @property integer $id_lang
 * @property string $lang
 *
 * @property TPersonLang[] $tPersonLangs
 * @property TPerson[] $idPeople
 */
class GLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'g_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lang'], 'required'],
            [['lang'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_lang' => Yii::t('app', 'Id Lang'),
            'lang' => Yii::t('app', 'Lang'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPersonLangs()
    {
        return $this->hasMany(TPersonLang::className(), ['id_lang' => 'id_lang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPeople()
    {
        return $this->hasMany(TPerson::className(), ['id_person' => 'id_person'])->viaTable('t_person_lang', ['id_lang' => 'id_lang']);
    }
}
