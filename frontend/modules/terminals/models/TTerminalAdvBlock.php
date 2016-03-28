<?php

namespace frontend\modules\terminals\models;

use Yii;

/**
 * This is the model class for table "t_terminal_adv_block".
 *
 * @property integer $id_terminal
 * @property integer $id_adv_category
 *
 * @property GReferens $idAdvCategory
 * @property TTerminal $idTerminal
 */
class TTerminalAdvBlock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_terminal_adv_block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_terminal', 'id_adv_category'], 'required'],
            [['id_terminal', 'id_adv_category'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_terminal' => 'Id Terminal',
            'id_adv_category' => 'Id Adv Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAdvCategory()
    {
        return $this->hasOne(GReferens::className(), ['id_ref' => 'id_adv_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTerminal()
    {
        return $this->hasOne(TTerminal::className(), ['id_terminal' => 'id_terminal']);
    }
}
