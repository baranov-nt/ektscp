<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_person_contact".
 *
 * @property integer $id_pc
 * @property integer $type_contact
 * @property string $contact
 * @property integer $id_person
 *
 * @property TPerson $idPerson
 */
class TPersonContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_person_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_contact', 'contact', 'id_person'], 'required'],
            [['type_contact', 'id_person'], 'integer'],
            [['contact'], 'string'],
            [['id_person'], 'exist', 'skipOnError' => true, 'targetClass' => TPerson::className(), 'targetAttribute' => ['id_person' => 'id_person']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pc' => Yii::t('app', 'Id Pc'),
            'type_contact' => Yii::t('app', 'Type Contact'),
            'contact' => Yii::t('app', 'Contact'),
            'id_person' => Yii::t('app', 'Id Person'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPerson()
    {
        return $this->hasOne(TPerson::className(), ['id_person' => 'id_person']);
    }
}
