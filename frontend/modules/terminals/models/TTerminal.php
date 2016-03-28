<?php

namespace frontend\modules\terminals\models;

use frontend\models\GalAlbum;
use Yii;
use frontend\models\GCity;
use common\models\GReferens;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "t_terminal".
 *
 * @property integer $id_terminal
 * @property integer $city
 * @property integer $city_area
 * @property string $address
 * @property string $place
 * @property integer $type
 * @property integer $type_case
 * @property integer $workmode
 * @property string $ip_address
 * @property string $last_active
 * @property string $help_phone
 * @property string $phone_01
 * @property string $phone_02
 * @property string $phone_03
 * @property string $phone_04
 * @property string $phone_sova
 * @property string $office_sections
 * @property string $person_sections
 * @property string $admin_name
 * @property string $admin_email
 * @property string $admin_phone
 * @property integer $status
 * @property integer $status_admin
 * @property integer $status_stat
 * @property integer $is_feature
 * @property string $coordinates
 * @property integer $cnt_users
 * @property string $version
 * @property integer $is_inet
 * @property string $install_date
 * @property string $gsm_operator
 * @property integer $gsm_signal
 * @property integer $sip_status
 * @property integer $gmt
 * @property integer $is_banner
 * @property integer $is_copy
 * @property string $guid
 * @property integer $worktime
 * @property integer $diag
 * @property integer $passability
 * @property integer $internet_type
 * @property string $internet_price
 * @property integer $arenda_type
 * @property string $arenda_price
 * @property integer $tender_type
 * @property integer $tender_start_price
 * @property string $tender_end_date
 * @property string $tender_url
 * @property integer $elec_type
 * @property string $elec_price
 * @property string $comments
 * @property integer $category_place
 * @property integer $is_need_moderate
 *
 * @property AuthUserRoles[] $authUserRoles
 * @property TAdvShedule[] $tAdvShedules
 * @property TAdvStat[] $tAdvStats
 * @property TCall[] $tCalls
 * @property TCommand[] $tCommands
 * @property TConLog[] $tConLogs
 * @property THdwLog[] $tHdwLogs
 * @property TInternet[] $tInternets
 * @property TMap[] $tMaps
 * @property TMenu[] $tMenus
 * @property TMenuTerminal[] $tMenuTerminals
 * @property TMenu[] $idMis
 * @property TOfficeSectionV2[] $tOfficeSectionV2s
 * @property TOfficeTerminal[] $tOfficeTerminals
 * @property TOffice[] $idOffices
 * @property TPersonSection[] $tPersonSections
 * @property TSection[] $tSections
 * @property TSreenshot[] $tSreenshots
 * @property TTariffs[] $tTariffs
 * @property TTariffs2[] $tTariffs2s
 * @property GCity $city0
 * @property GCityArea $cityArea
 * @property GReferens $typeCase
 * @property GReferens $type0
 * @property GReferens $categoryPlace
 * @property TTerminalAdvBlock[] $tTerminalAdvBlocks
 * @property GReferens[] $idAdvCategories
 * @property TTerminalControl[] $tTerminalControls
 * @property CCommunity[] $idCommunities
 * @property TTerminalServices[] $tTerminalServices
 * @property GReferens[] $idServices
 * @property TWfTerminal[] $tWfTerminals
 * @property TWebFilter[] $idWfs
 */
class TTerminal extends \yii\db\ActiveRecord
{

    public $street;
    public $house;
    public $housing;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_terminal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'passability', 'comments', 'admin_phone', 'admin_name', 'place', 'category_place'], 'required', 'on' => 'complite'],
            [['city', 'city_area', 'type', 'type_case', 'workmode', 'status', 'status_admin', 'status_stat', 'is_feature', 'cnt_users', 'is_inet', 'gsm_signal', 'sip_status', 'gmt', 'is_banner', 'is_copy',/* 'worktime',*/ 'diag', 'passability', 'internet_type', 'arenda_type', 'tender_type', 'tender_start_price', 'elec_type', 'category_place', 'is_need_moderate'], 'integer'],
            [['address', 'place', 'ip_address', 'help_phone', 'phone_01', 'phone_02', 'phone_03', 'phone_04', 'phone_sova', 'office_sections', 'person_sections', 'admin_name', 'admin_email', 'admin_phone', 'coordinates', 'version', 'gsm_operator', 'guid', 'tender_url', 'comments'], 'string'],
            [['last_active', 'install_date', 'tender_end_date'], 'safe'],
            [['internet_price', 'arenda_price', 'elec_price'], 'number'],
            [['admin_email'], 'email'],
            [['city', 'street'], 'safe'],
            [['street', 'house', 'housing'], 'required', 'on' => 'default']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_terminal' => 'Id Terminal',
            'city' => 'Город',
            'city_area' => 'City Area',
            'address' => 'Address',
            'place' => 'Название места',
            'type' => 'Type',
            'type_case' => 'Type Case',
            'workmode' => 'Workmode',
            'ip_address' => 'Ip Address',
            'last_active' => 'Last Active',
            'help_phone' => 'Help Phone',
            'phone_01' => 'Phone 01',
            'phone_02' => 'Phone 02',
            'phone_03' => 'Phone 03',
            'phone_04' => 'Phone 04',
            'phone_sova' => 'Phone Sova',
            'office_sections' => 'Office Sections',
            'person_sections' => 'Person Sections',
            'admin_name' => 'Контактное лицо',
            'admin_email' => 'E-mail',
            'admin_phone' => 'Телефон',
            'status' => 'Status',
            'status_admin' => 'Status Admin',
            'status_stat' => 'Status Stat',
            'is_feature' => 'Is Feature',
            'coordinates' => 'Coordinates',
            'cnt_users' => 'Cnt Users',
            'version' => 'Version',
            'is_inet' => 'Is Inet',
            'install_date' => 'Install Date',
            'gsm_operator' => 'Gsm Operator',
            'gsm_signal' => 'Gsm Signal',
            'sip_status' => 'Sip Status',
            'gmt' => 'Gmt',
            'is_banner' => 'Is Banner',
            'is_copy' => 'Is Copy',
            'guid' => 'Guid',
            'worktime' => 'Worktime',
            'diag' => 'Diag',
            'passability' => 'Проходимость',
            'internet_type' => 'Internet Type',
            'internet_price' => 'Internet Price',
            'arenda_type' => 'Arenda Type',
            'arenda_price' => 'Arenda Price',
            'tender_type' => 'Tender Type',
            'tender_start_price' => 'Tender Start Price',
            'tender_end_date' => 'Tender End Date',
            'tender_url' => 'Tender Url',
            'elec_type' => 'Elec Type',
            'elec_price' => 'Elec Price',
            'comments' => 'Комментарий',
            'category_place' => 'Категория',
            'is_need_moderate' => 'Is Need Moderate',
            'street' => 'Улица',
            'house' => 'Дом',
            'housing' => 'Корпус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalAlbums()
    {
        return $this->hasMany(GalAlbum::className(), ['id_terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthUserRoles()
    {
        return $this->hasMany(AuthUserRoles::className(), ['id_context' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAdvShedules()
    {
        return $this->hasMany(TAdvShedule::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAdvStats()
    {
        return $this->hasMany(TAdvStat::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTCalls()
    {
        return $this->hasMany(TCall::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTCommands()
    {
        return $this->hasMany(TCommand::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTConLogs()
    {
        return $this->hasMany(TConLog::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHdwLogs()
    {
        return $this->hasMany(THdwLog::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTInternets()
    {
        return $this->hasMany(TInternet::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTMaps()
    {
        return $this->hasMany(TMap::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTMenus()
    {
        return $this->hasMany(TMenu::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTMenuTerminals()
    {
        return $this->hasMany(TMenuTerminal::className(), ['id_terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMis()
    {
        return $this->hasMany(TMenu::className(), ['id_mi' => 'id_mi'])->viaTable('t_menu_terminal', ['id_terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOfficeSectionV2s()
    {
        return $this->hasMany(TOfficeSectionV2::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOfficeTerminals()
    {
        return $this->hasMany(TOfficeTerminal::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOffices()
    {
        return $this->hasMany(TOffice::className(), ['id_office' => 'id_office'])->viaTable('t_office_terminal', ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPersonSections()
    {
        return $this->hasMany(TPersonSection::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTSections()
    {
        return $this->hasMany(TSection::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTSreenshots()
    {
        return $this->hasMany(TSreenshot::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTariffs()
    {
        return $this->hasMany(TTariffs::className(), ['terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTariffs2s()
    {
        return $this->hasMany(TTariffs2::className(), ['terminal' => 'id_terminal']);
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
    public function getCityArea()
    {
        return $this->hasOne(GCityArea::className(), ['id_ca' => 'city_area']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeCase()
    {
        return $this->hasOne(GReferens::className(), ['id_ref' => 'type_case']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(GReferens::className(), ['id_ref' => 'type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPlace()
    {
        return $this->hasOne(GReferens::className(), ['id_ref' => 'category_place']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTerminalAdvBlocks()
    {
        return $this->hasMany(TTerminalAdvBlock::className(), ['id_terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAdvCategories()
    {
        return $this->hasMany(GReferens::className(), ['id_ref' => 'id_adv_category'])->viaTable('t_terminal_adv_block', ['id_terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTerminalControls()
    {
        return $this->hasMany(TTerminalControl::className(), ['id_teminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCommunities()
    {
        return $this->hasMany(CCommunity::className(), ['id_community' => 'id_community'])->viaTable('t_terminal_control', ['id_teminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTerminalServices()
    {
        return $this->hasMany(TTerminalServices::className(), ['id_terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdServices()
    {
        return $this->hasMany(GReferens::className(), ['id_ref' => 'id_service'])->viaTable('t_terminal_services', ['id_terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTWfTerminals()
    {
        return $this->hasMany(TWfTerminal::className(), ['id_terminal' => 'id_terminal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWfs()
    {
        return $this->hasMany(TWebFilter::className(), ['id_wf' => 'id_wf'])->viaTable('t_wf_terminal', ['id_terminal' => 'id_terminal']);
    }
	
    public function getCategoryPlacesList()
    {
        $appliances = ArrayHelper::map(GReferens::find()
			->where(["base_ref" => 426])
            ->orderBy('name')
            ->all(), 'id_ref', 'name');
        $items = [];
        foreach($appliances as $key => $value) {
            $items[$key] = Yii::t('app', $value);
        }
        return $items;
    }

	public function getCityList()
    {
        $appliances = ArrayHelper::map(GCity::find()
            ->where(['status' => 0])
            ->orderBy('name')
            ->all(), 'id_city', 'name');
        $items = [];
        foreach($appliances as $key => $value) {
            $items[$key] = Yii::t('app', $value);
        }
        return $items;
    }
}
