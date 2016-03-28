<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profiles".
 *
 * @property integer $user_id
 * @property string $family
 * @property string $first_name
 * @property integer $city
 * @property string $birthday
 * @property integer $gender
 * @property integer $avatar
 * @property string $status_txt
 *
 * @property GCity $city0
 * @property Users $user
 */
class Profiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profiles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'city', 'gender', 'avatar'], 'integer'],
            [['family', 'first_name', 'status_txt'], 'string'],
            [['birthday'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'family' => Yii::t('app', 'Family'),
            'first_name' => Yii::t('app', 'First Name'),
            'city' => Yii::t('app', 'City'),
            'birthday' => Yii::t('app', 'Birthday'),
            'gender' => Yii::t('app', 'Gender'),
            'avatar' => Yii::t('app', 'Avatar'),
            'status_txt' => Yii::t('app', 'Status Txt'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0()
    {
        return $this->hasOne(GCity::className(), ['id_city' => 'city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
