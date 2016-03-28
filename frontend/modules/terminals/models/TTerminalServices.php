<?php

namespace frontend\modules\terminals\models;

use Yii;

/**
 * This is the model class for table "t_terminal_services".
 *
 * @property integer $id_terminal
 * @property integer $id_service
 *
 * @property GReferens $idService
 * @property TTerminal $idTerminal
 */
class TTerminalServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_terminal_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_terminal', 'id_service'], 'required'],
            [['id_terminal', 'id_service'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_terminal' => 'Id Terminal',
            'id_service' => 'Id Service',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdService()
    {
        return $this->hasOne(GReferens::className(), ['id_ref' => 'id_service']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTerminal()
    {
        return $this->hasOne(TTerminal::className(), ['id_terminal' => 'id_terminal']);
    }
}
