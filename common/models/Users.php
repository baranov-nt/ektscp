<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\rbac\models\Role;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $activkey
 * @property string $create_at
 * @property string $lastvisit_at
 * @property string $lastactive_at
 * @property integer $superuser
 * @property integer $status
 * @property integer $is_hidden
 * @property string $phone
 * @property string $balance
 * @property string $auth_key
 * @property integer $status_user
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $old_user
 * @property string $password_hash
 *
 * @property AdsAgencyPlace[] $adsAgencyPlaces
 * @property AdsAgencyShedule[] $adsAgencyShedules
 * @property AuthUserRoles[] $authUserRoles
 * @property BPayers[] $bPayers
 * @property BPayments[] $bPayments
 * @property CCommunity[] $cCommunities
 * @property CCommunityMember[] $cCommunityMembers
 * @property CCommunity[] $idCommunities
 * @property FileDoc[] $fileDocs
 * @property FileImage[] $fileImages
 * @property FileVideo[] $fileVideos
 * @property GCity[] $gCities
 * @property GCityArea[] $gCityAreas
 * @property GContact[] $gContacts
 * @property PProduct[] $pProducts
 * @property PhysDriverLevel[] $physDriverLevels
 * @property GReferens[] $levels
 * @property PhysEdu[] $physEdus
 * @property PhysWork[] $physWorks
 * @property Profiles $profiles
 * @property RAssignment[] $rAssignments
 * @property RBlacklist[] $rBlacklists
 * @property RBlacklist[] $rBlacklists0
 * @property RTrust[] $rTrusts
 * @property RTrust[] $rTrusts0
 * @property RUserRoles[] $rUserRoles
 * @property RecShedule[] $recShedules
 * @property StatViews[] $statViews
 * @property TCampany[] $tCampanies
 * @property TOffice[] $tOffices
 * @property TPerson $tPerson
 * @property TTrust[] $tTrusts
 * @property TTrust[] $tTrusts0
 * @property Users[] $idUserDests
 * @property Users[] $idUserSources
 * @property UCalls[] $uCalls
 * @property UCalls[] $uCalls0
 * @property UMessage[] $uMessages
 * @property UMessage[] $uMessages0
 * @property UNotify[] $uNotifies
 * @property UserLogins[] $userLogins
 * @property UsersFriends[] $usersFriends
 * @property UsersFriends[] $usersFriends0
 * @property Users[] $userDests
 * @property Users[] $userSources
 * @property Users[] $phonesList
 * @property UsersGroups[] $usersGroups
 * @property UsersGroupsMembers[] $usersGroupsMembers
 * @property UsersGroups[] $idUgs
 * @property WallRecord[] $wallRecords
 * @property WallRecord[] $wallRecords0
 * @property WorkResume[] $workResumes
 */

class Users  extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 10;
    const STATUS_OLD_USER = 15;

    //public $password;
    public $case_1;
    public $case_2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_user', 'auth_key'], 'required'],
            [['username', 'password', 'email', 'activkey', 'phone', 'auth_key', 'password_hash'], 'string'],
            [['create_at', 'lastvisit_at', 'lastactive_at'], 'safe'],
            [['superuser', 'status', 'is_hidden', 'status_user', 'created_at', 'updated_at', 'old_user'], 'integer'],
            [['balance'], 'number'],
            [['username', 'email', 'phone'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email'),
            'activkey' => Yii::t('app', 'Activkey'),
            'create_at' => Yii::t('app', 'Create At'),
            'lastvisit_at' => Yii::t('app', 'Lastvisit At'),
            'lastactive_at' => Yii::t('app', 'Lastactive At'),
            'superuser' => Yii::t('app', 'Superuser'),
            'status' => Yii::t('app', 'Status'),
            'is_hidden' => Yii::t('app', 'Is Hidden'),
            'phone' => Yii::t('app', 'Phone'),
            'balance' => Yii::t('app', 'Balance'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'status_user' => Yii::t('app', 'Status User'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /* Поведения */
    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyPlaces()
    {
        return $this->hasMany(AdsAgencyPlace::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyShedules()
    {
        return $this->hasMany(AdsAgencyShedule::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthUserRoles()
    {
        return $this->hasMany(AuthUserRoles::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBPayers()
    {
        return $this->hasMany(BPayers::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBPayments()
    {
        return $this->hasMany(BPayments::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCCommunities()
    {
        return $this->hasMany(CCommunity::className(), ['owner' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCCommunityMembers()
    {
        return $this->hasMany(CCommunityMember::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCommunities()
    {
        return $this->hasMany(CCommunity::className(), ['id_community' => 'id_community'])->viaTable('c_community_member', ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileDocs()
    {
        return $this->hasMany(FileDoc::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileImages()
    {
        return $this->hasMany(FileImage::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileVideos()
    {
        return $this->hasMany(FileVideo::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGCities()
    {
        return $this->hasMany(GCity::className(), ['creator' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGCityAreas()
    {
        return $this->hasMany(GCityArea::className(), ['creator' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGContacts()
    {
        return $this->hasMany(GContact::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPProducts()
    {
        return $this->hasMany(PProduct::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhysDriverLevels()
    {
        return $this->hasMany(PhysDriverLevel::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevels()
    {
        return $this->hasMany(GReferens::className(), ['id_ref' => 'level'])->viaTable('phys_driver_level', ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhysEdus()
    {
        return $this->hasMany(PhysEdu::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhysWorks()
    {
        return $this->hasMany(PhysWork::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasOne(Profiles::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRAssignments()
    {
        return $this->hasMany(RAssignment::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRBlacklists()
    {
        return $this->hasMany(RBlacklist::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRBlacklists0()
    {
        return $this->hasMany(RBlacklist::className(), ['id_context' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRTrusts()
    {
        return $this->hasMany(RTrust::className(), ['source' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRTrusts0()
    {
        return $this->hasMany(RTrust::className(), ['dest' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRUserRoles()
    {
        return $this->hasMany(RUserRoles::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecShedules()
    {
        return $this->hasMany(RecShedule::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatViews()
    {
        return $this->hasMany(StatViews::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTCampanies()
    {
        return $this->hasMany(TCampany::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOffices()
    {
        return $this->hasMany(TOffice::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPerson()
    {
        return $this->hasOne(TPerson::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTrusts()
    {
        return $this->hasMany(TTrust::className(), ['id_user_source' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTrusts0()
    {
        return $this->hasMany(TTrust::className(), ['id_user_dest' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUserDests()
    {
        return $this->hasMany(Users::className(), ['id' => 'id_user_dest'])->viaTable('t_trust', ['id_user_source' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUserSources()
    {
        return $this->hasMany(Users::className(), ['id' => 'id_user_source'])->viaTable('t_trust', ['id_user_dest' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUCalls()
    {
        return $this->hasMany(UCalls::className(), ['user_source' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUCalls0()
    {
        return $this->hasMany(UCalls::className(), ['user_dest' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUMessages()
    {
        return $this->hasMany(UMessage::className(), ['user_source' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUMessages0()
    {
        return $this->hasMany(UMessage::className(), ['user_dest' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUNotifies()
    {
        return $this->hasMany(UNotify::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLogins()
    {
        return $this->hasMany(UserLogins::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersFriends()
    {
        return $this->hasMany(UsersFriends::className(), ['user_source' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersFriends0()
    {
        return $this->hasMany(UsersFriends::className(), ['user_dest' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDests()
    {
        return $this->hasMany(Users::className(), ['id' => 'user_dest'])->viaTable('users_friends', ['user_source' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSources()
    {
        return $this->hasMany(Users::className(), ['id' => 'user_source'])->viaTable('users_friends', ['user_dest' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersGroups()
    {
        return $this->hasMany(UsersGroups::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersGroupsMembers()
    {
        return $this->hasMany(UsersGroupsMembers::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUgs()
    {
        return $this->hasMany(UsersGroups::className(), ['id_ug' => 'id_ug'])->viaTable('users_groups_members', ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWallRecords()
    {
        return $this->hasMany(WallRecord::className(), ['user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWallRecords0()
    {
        return $this->hasMany(WallRecord::className(), ['owner_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkResumes()
    {
        return $this->hasMany(WorkResume::className(), ['user' => 'id']);
    }

    /* ------------------------ */

    public static function findByphone($phone)
    {
        $phone = str_replace([' ', '-', '+'], '', $phone);
        if($phone[0] == 8)
            $phone[0] = 7;
        $user = static::findOne([
            'phone' => $phone
        ]);
        if($user) {
            return $user;
        }
        return false;
    }

    public static function findByEmail($email)
    {
        return static::findOne([
            'username' => $email
        ]);
    }

    public static function findBySecretKey($key)
    {
        if (!static::isSecretKeyExpire($key))
        {
            return null;
        }
        return static::findOne([
            'secret_key' => $key,
        ]);
    }


    public function generateSecretKey()
    {
        $this->secret_key = Yii::$app->security->generateRandomString().'_'.time();
    }

    public function removeSecretKey()
    {
        $this->secret_key = null;
    }

    public static function isSecretKeyExpire($key)
    {
        if (empty($key))
        {
            return false;
        }
        $expire = Yii::$app->params['secretKeyExpire'];
        $parts = explode('_', $key);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function getPassword($password)
    {
        return Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey(){
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id,
            'status_user' => self::STATUS_ACTIVE
        ]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function updateUser()
    {
        $user = Users::findOne(Yii::$app->user->id);
        $phone = $this->phone;
        $user->phone = $phone;
        if($user->save()):
            return $user;
        else:
            return false;
        endif;
    }

    public function getStatusName($status_user = null)
    {
        $status_user = (empty($status_user)) ? $this->status_user : $status_user ;
        if ($status_user === self::STATUS_DELETED)
        {
            return Yii::t('app', "Ban");
        }
        elseif ($status_user === self::STATUS_NOT_ACTIVE)
        {
            return Yii::t('app', "Not activated");
        }
        else
        {
            return Yii::t('app', "Activated");
        }
    }

    public function getStatusList()
    {
        $status_userArray = [
            self::STATUS_ACTIVE     => Yii::t('app', "Activated"),
            self::STATUS_NOT_ACTIVE => Yii::t('app', "Not activated"),
            self::STATUS_DELETED    => Yii::t('app', "Ban")
        ];
        return $status_userArray;
    }

    public function getRole()
    {
        // User has_one Role via Role.user_id -> id
        return $this->hasMany(Role::className(), ['user_id' => 'id']);
    }

    public function getRoleName()
    {
        return $this->role->item_name;
    }

    public function getPhonesList()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        return ArrayHelper::map(TPersonContact::find()
            ->where([
                'type_contact' => 1,
                'id_person' => $user->tPerson->id_person,
            ])
            ->all(), 'id_pc', 'contact');
    }

    public function getEmailsList()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        return ArrayHelper::map(TPersonContact::find()
            ->where([
                'type_contact' => 2,
                'id_person' => $user->tPerson->id_person,
            ])
            ->all(), 'id_pc', 'contact');
    }

    public function getSkypesList()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        return ArrayHelper::map(TPersonContact::find()
            ->where([
                'type_contact' => 3,
                'id_person' => $user->tPerson->id_person,
            ])
            ->all(), 'id_pc', 'contact');
    }

    public function getSitesList()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        return ArrayHelper::map(TPersonContact::find()
            ->where([
                'type_contact' => 5,
                'id_person' => $user->tPerson->id_person,
            ])
            ->all(), 'id_pc', 'contact');
    }

    public function getBirthdate()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        $array = ArrayHelper::map(TPerson::find()
            ->where([
                'id_person' => $user->tPerson->id_person,
                'is_main' => 1,
            ])
            ->all(), 'id_person', 'birthdate');

        foreach($array as $key => $value) {
            return $value ? $array : [];
        }
    }

    public function getGender()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        $array = ArrayHelper::map(TPerson::find()
            ->where([
                'id_person' => $user->tPerson->id_person,
                'is_main' => 1,
            ])
            ->all(), 'id_person', 'sex');

        foreach($array as $key => $value) {
            if($value === 0) {
                return $array;
            }
            if($value === 1) {
                return $array;
            }
        }
        return [];
    }

    public function getMarital()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        $array = ArrayHelper::map(TPerson::find()
            ->where([
                'id_person' => $user->tPerson->id_person,
                'is_main' => 1,
            ])
            ->all(), 'id_person', 'marital_status');

        foreach($array as $key => $value) {
            if($value !== null) {
                return $array;
            }
        }
        return [];
    }

    public function getChildren()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        $array = ArrayHelper::map(TPerson::find()
            ->where([
                'id_person' => $user->tPerson->id_person,
                'is_main' => 1,
            ])
            ->all(), 'id_person', 'children');

        foreach($array as $key => $value) {
            if($value === 0) {
                return $array;
            }
            if($value === 1) {
                return $array;
            }
        }
        return [];
    }

    public function getBirthcity()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;
        $array = ArrayHelper::map(TPerson::find()
            ->where([
                'id_person' => $user->tPerson->id_person,
                'is_main' => 1,
            ])
            ->all(), 'id_person', 'birthcity');
        foreach($array as $key => $value) {
            if($value !== null) {
                return $array;
            }
        }
        return [];
    }

    public function getLangs()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;
        $array = ArrayHelper::map(TPersonLang::find()
            ->where([
                'id_person' => $user->tPerson->id_person,
            ])
            ->all(), 'id_person', 'id_lang');
        foreach($array as $key => $value) {
            if($value !== null) {
                return $array;
            }
        }
        return [];
    }
}
