<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "c_community".
 *
 * @property integer $id_community
 * @property string $name
 * @property string $logo
 * @property string $description
 * @property integer $type
 * @property string $created
 * @property integer $category
 * @property string $url
 * @property integer $private_status
 * @property integer $status
 * @property integer $owner
 * @property integer $city
 * @property string $time_of_work
 * @property string $phone
 * @property string $web
 * @property string $email
 *
 * @property AdsAgencyPlace[] $adsAgencyPlaces
 * @property AdsAgencyShedule[] $adsAgencyShedules
 * @property CAddressCommunity $cAddressCommunity
 * @property CCategories $category0
 * @property FileImage $logo0
 * @property Users $owner0
 * @property CCommunityMember[] $cCommunityMembers
 * @property Users[] $idUsers
 * @property GContact[] $gContacts
 * @property GalAlbum[] $galAlbums
 * @property PProduct[] $pProducts
 * @property RecShedule[] $recShedules
 * @property SeoUrl[] $seoUrls
 * @property TOffice[] $tOffices
 * @property TPerson[] $tPeople
 * @property TTerminalControl[] $tTerminalControls
 * @property TTerminal[] $idTeminals
 * @property UsersGroups[] $usersGroups
 * @property WallRecord[] $wallRecords
 * @property WallRecord[] $wallRecords0
 * @property WorkResumeWork[] $workResumeWorks
 * @property WorkVacancyDriverLevel[] $workVacancyDriverLevels
 */
class CCommunity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'c_community';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'type', 'url', 'private_status', 'status', 'owner'], 'required'],
            [['name', 'description', 'url', 'time_of_work', 'phone', 'web', 'email'], 'string'],
            [['logo', 'type', 'category', 'private_status', 'status', 'owner', 'city'], 'integer'],
            [['created'], 'safe'],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => CCategories::className(), 'targetAttribute' => ['category' => 'id_category']],
            [['logo'], 'exist', 'skipOnError' => true, 'targetClass' => FileImage::className(), 'targetAttribute' => ['logo' => 'id_file']],
            [['owner'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['owner' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_community' => Yii::t('app', 'Id Community'),
            'name' => Yii::t('app', 'Name'),
            'logo' => Yii::t('app', 'Logo'),
            'description' => Yii::t('app', 'Description'),
            'type' => Yii::t('app', 'Type'),
            'created' => Yii::t('app', 'Created'),
            'category' => Yii::t('app', 'Category'),
            'url' => Yii::t('app', 'Url'),
            'private_status' => Yii::t('app', 'Private Status'),
            'status' => Yii::t('app', 'Status'),
            'owner' => Yii::t('app', 'Owner'),
            'city' => Yii::t('app', 'City'),
            'time_of_work' => Yii::t('app', 'Time Of Work'),
            'phone' => Yii::t('app', 'Phone'),
            'web' => Yii::t('app', 'Web'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyPlaces()
    {
        return $this->hasMany(AdsAgencyPlace::className(), ['community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyShedules()
    {
        return $this->hasMany(AdsAgencyShedule::className(), ['community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCAddressCommunity()
    {
        return $this->hasOne(CAddressCommunity::className(), ['id_community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(CCategories::className(), ['id_category' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogo0()
    {
        return $this->hasOne(FileImage::className(), ['id_file' => 'logo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner0()
    {
        return $this->hasOne(Users::className(), ['id' => 'owner']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCCommunityMembers()
    {
        return $this->hasMany(CCommunityMember::className(), ['id_community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsers()
    {
        return $this->hasMany(Users::className(), ['id' => 'id_user'])->viaTable('c_community_member', ['id_community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGContacts()
    {
        return $this->hasMany(GContact::className(), ['community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalAlbums()
    {
        return $this->hasMany(GalAlbum::className(), ['community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPProducts()
    {
        return $this->hasMany(PProduct::className(), ['community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecShedules()
    {
        return $this->hasMany(RecShedule::className(), ['community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoUrls()
    {
        return $this->hasMany(SeoUrl::className(), ['community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOffices()
    {
        return $this->hasMany(TOffice::className(), ['community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPeople()
    {
        return $this->hasMany(TPerson::className(), ['community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTerminalControls()
    {
        return $this->hasMany(TTerminalControl::className(), ['id_community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTeminals()
    {
        return $this->hasMany(TTerminal::className(), ['id_terminal' => 'id_teminal'])->viaTable('t_terminal_control', ['id_community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersGroups()
    {
        return $this->hasMany(UsersGroups::className(), ['community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWallRecords()
    {
        return $this->hasMany(WallRecord::className(), ['community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWallRecords0()
    {
        return $this->hasMany(WallRecord::className(), ['owner_community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkResumeWorks()
    {
        return $this->hasMany(WorkResumeWork::className(), ['community' => 'id_community']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkVacancyDriverLevels()
    {
        return $this->hasMany(WorkVacancyDriverLevel::className(), ['community' => 'id_community']);
    }
}
