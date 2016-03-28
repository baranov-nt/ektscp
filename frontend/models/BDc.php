<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "b_dc".
 *
 * @property string $id_dc
 * @property integer $user_debet
 * @property integer $user_credit
 * @property string $create
 * @property string $sum
 * @property integer $id_payment
 * @property integer $id_advshedule
 * @property integer $id_os
 * @property string $notes
 */
class BDc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'b_dc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[/*'user_debet', 'user_credit', 'create', 'sum'*/], 'required'],
            [['user_debet', 'user_credit', 'id_payment', 'id_advshedule', 'id_os'], 'integer'],
            [['create'], 'safe'],
            [['sum'], 'number'],
            [['notes'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dc' => 'Id Dc',
            'user_debet' => 'User Debet',
            'user_credit' => 'User Credit',
            'create' => 'Create',
            'sum' => 'Sum',
            'id_payment' => 'Id Payment',
            'id_advshedule' => 'Id AdvShedule',
            'id_os' => 'Id Os',
            'notes' => 'Notes',
            'status' => 'Status',
        ];
    }
}
