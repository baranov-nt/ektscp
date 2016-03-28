<?php

namespace common\models;

use frontend\models\FileImage;
use Yii;

/**
 * This is the model class for table "t_person".
 *
 * @property integer $id_person
 * @property string $family
 * @property string $name
 * @property string $second_name
 * @property string $phone
 * @property string $web
 * @property string $dsc
 * @property string $time_of_work
 * @property integer $city
 * @property integer $address_community
 * @property string $address
 * @property string $corp
 * @property integer $level
 * @property string $num
 * @property integer $type_num
 * @property string $photo
 * @property string $id_photo
 * @property integer $id_office
 * @property integer $community
 * @property integer $user
 * @property integer $parent_person
 * @property string $lang
 * @property integer $is_ex
 * @property string $photo2
 * @property string $id_photo2
 * @property string $dsc_ex
 * @property string $dsc_ex_ex
 * @property string $prim_ex
 * @property string $email
 * @property integer $is_main
 *
 * @property CCommunity $community0
 * @property GCity $city0
 * @property Users $user0
 * @property TPersonSection[] $tPersonSections
 * @property TWfPerson[] $tWfPeople
 * @property TWebFilter[] $idWfs
 * @property TPersonContact $tPersonContact
 */
class TPerson extends \yii\db\ActiveRecord
{
    public $file;
    public $id_file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['family', 'name', 'second_name', 'phone', 'web', 'dsc', 'time_of_work', 'address', 'corp', 'num', 'photo', 'lang', 'photo2', 'dsc_ex', 'dsc_ex_ex', 'prim_ex', 'email'], 'string'],
            [['city', 'address_community', 'level', 'type_num', 'id_photo', 'id_office', 'community', 'user', 'parent_person', 'is_ex', 'id_photo2', 'is_main'], 'integer'],
            [['community'], 'exist', 'skipOnError' => true, 'targetClass' => CCommunity::className(), 'targetAttribute' => ['community' => 'id_community']],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => GCity::className(), 'targetAttribute' => ['city' => 'id_city']],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_person' => Yii::t('app', 'Id Person'),
            'family' => Yii::t('app', 'Family'),
            'name' => Yii::t('app', 'Name'),
            'second_name' => Yii::t('app', 'Second Name'),
            'phone' => Yii::t('app', 'Phone'),
            'web' => Yii::t('app', 'Web'),
            'dsc' => Yii::t('app', 'Dsc'),
            'time_of_work' => Yii::t('app', 'Time Of Work'),
            'city' => Yii::t('app', 'City'),
            'address_community' => Yii::t('app', 'Address Community'),
            'address' => Yii::t('app', 'Address'),
            'corp' => Yii::t('app', 'Corp'),
            'level' => Yii::t('app', 'Level'),
            'num' => Yii::t('app', 'Num'),
            'type_num' => Yii::t('app', 'Type Num'),
            'photo' => Yii::t('app', 'Photo'),
            'id_photo' => Yii::t('app', 'Id Photo'),
            'id_office' => Yii::t('app', 'Id Office'),
            'community' => Yii::t('app', 'Community'),
            'user' => Yii::t('app', 'User'),
            'parent_person' => Yii::t('app', 'Parent Person'),
            'lang' => Yii::t('app', 'Lang'),
            'is_ex' => Yii::t('app', 'Is Ex'),
            'photo2' => Yii::t('app', 'Photo2'),
            'id_photo2' => Yii::t('app', 'Id Photo2'),
            'dsc_ex' => Yii::t('app', 'Dsc Ex'),
            'dsc_ex_ex' => Yii::t('app', 'Dsc Ex Ex'),
            'prim_ex' => Yii::t('app', 'Prim Ex'),
            'email' => Yii::t('app', 'Email'),
            'is_main' => Yii::t('app', 'Is Main'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainImg()
    {
        return $this->hasOne(FileImage::className(), ['id_file' => 'id_photo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunity0()
    {
        return $this->hasOne(CCommunity::className(), ['id_community' => 'community']);
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
    public function getUser0()
    {
        return $this->hasOne(Users::className(), ['id' => 'user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPersonSections()
    {
        return $this->hasMany(TPersonSection::className(), ['id_person' => 'id_person']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPersonContact()
    {
        return $this->hasMany(TPersonContact::className(), ['id_person' => 'id_person']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTWfPeople()
    {
        return $this->hasMany(TWfPerson::className(), ['id_person' => 'id_person']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWfs()
    {
        return $this->hasMany(TWebFilter::className(), ['id_wf' => 'id_wf'])->viaTable('t_wf_person', ['id_person' => 'id_person']);
    }
}
