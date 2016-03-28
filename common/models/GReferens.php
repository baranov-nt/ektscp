<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "g_referens".
 *
 * @property integer $id_ref
 * @property integer $base_ref
 * @property string $name
 * @property integer $turn
 *
 * @property AdsAgencyMedia[] $adsAgencyMedia
 * @property AdsAgencyMedia[] $adsAgencyMedia0
 * @property AdsAgencyStands[] $adsAgencyStands
 * @property AdsAgencyTerminals[] $adsAgencyTerminals
 * @property AdsAgencyTransport[] $adsAgencyTransports
 * @property BPayments[] $bPayments
 * @property EsCommercial[] $esCommercials
 * @property EsEstate[] $esEstates
 * @property EsEstate[] $esEstates0
 * @property EsEstate[] $esEstates1
 * @property EsEstate[] $esEstates2
 * @property EsEstate[] $esEstates3
 * @property EsResidential[] $esResidentials
 * @property EsResidential[] $esResidentials0
 * @property EsResidential[] $esResidentials1
 * @property EsResidential[] $esResidentials2
 * @property EsResidential[] $esResidentials3
 * @property EsResidential[] $esResidentials4
 * @property GContact[] $gContacts
 * @property PhysDriverLevel[] $physDriverLevels
 * @property Users[] $users
 * @property PhysEdu[] $physEdus
 * @property TMapItem[] $tMapItems
 * @property TMenu[] $tMenus
 * @property TTerminal[] $tTerminals
 * @property TTerminal[] $tTerminals0
 * @property TTerminal[] $tTerminals1
 * @property TTerminalAdvBlock[] $tTerminalAdvBlocks
 * @property TTerminal[] $idTerminals
 * @property TTerminalServices[] $tTerminalServices
 * @property TTerminal[] $idTerminals0
 * @property WorkResume[] $workResumes
 * @property WorkVacancy[] $workVacancies
 * @property WorkVacancyDriverLevel[] $workVacancyDriverLevels
 */
class GReferens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'g_referens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['base_ref', 'turn'], 'integer'],
            [['name', 'turn'], 'required'],
            [['name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ref' => 'Id Ref',
            'base_ref' => 'Base Ref',
            'name' => 'Name',
            'turn' => 'Turn',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyMedia()
    {
        return $this->hasMany(AdsAgencyMedia::className(), ['time_period' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyMedia0()
    {
        return $this->hasMany(AdsAgencyMedia::className(), ['type_ads_video' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyStands()
    {
        return $this->hasMany(AdsAgencyStands::className(), ['format_ads' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyTerminals()
    {
        return $this->hasMany(AdsAgencyTerminals::className(), ['type_po' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsAgencyTransports()
    {
        return $this->hasMany(AdsAgencyTransport::className(), ['type_acc' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBPayments()
    {
        return $this->hasMany(BPayments::className(), ['type' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsCommercials()
    {
        return $this->hasMany(EsCommercial::className(), ['floor_type' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsEstates()
    {
        return $this->hasMany(EsEstate::className(), ['period_pay' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsEstates0()
    {
        return $this->hasMany(EsEstate::className(), ['parking' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsEstates1()
    {
        return $this->hasMany(EsEstate::className(), ['state' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsEstates2()
    {
        return $this->hasMany(EsEstate::className(), ['category' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsEstates3()
    {
        return $this->hasMany(EsEstate::className(), ['type' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsResidentials()
    {
        return $this->hasMany(EsResidential::className(), ['balcony' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsResidentials0()
    {
        return $this->hasMany(EsResidential::className(), ['loggia' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsResidentials1()
    {
        return $this->hasMany(EsResidential::className(), ['view_window' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsResidentials2()
    {
        return $this->hasMany(EsResidential::className(), ['house_type' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsResidentials3()
    {
        return $this->hasMany(EsResidential::className(), ['quart_delivery' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEsResidentials4()
    {
        return $this->hasMany(EsResidential::className(), ['advanced_pay' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGContacts()
    {
        return $this->hasMany(GContact::className(), ['type_contact' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhysDriverLevels()
    {
        return $this->hasMany(PhysDriverLevel::className(), ['level' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['id' => 'user'])->viaTable('phys_driver_level', ['level' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhysEdus()
    {
        return $this->hasMany(PhysEdu::className(), ['type_edu' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTMapItems()
    {
        return $this->hasMany(TMapItem::className(), ['category' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTMenus()
    {
        return $this->hasMany(TMenu::className(), ['workmode' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTerminals()
    {
        return $this->hasMany(TTerminal::className(), ['type_case' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTerminals0()
    {
        return $this->hasMany(TTerminal::className(), ['type' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTerminals1()
    {
        return $this->hasMany(TTerminal::className(), ['category_place' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTerminalAdvBlocks()
    {
        return $this->hasMany(TTerminalAdvBlock::className(), ['id_adv_category' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTerminals()
    {
        return $this->hasMany(TTerminal::className(), ['id_terminal' => 'id_terminal'])->viaTable('t_terminal_adv_block', ['id_adv_category' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTerminalServices()
    {
        return $this->hasMany(TTerminalServices::className(), ['id_service' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTerminals0()
    {
        return $this->hasMany(TTerminal::className(), ['id_terminal' => 'id_terminal'])->viaTable('t_terminal_services', ['id_service' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkResumes()
    {
        return $this->hasMany(WorkResume::className(), ['time_work' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkVacancies()
    {
        return $this->hasMany(WorkVacancy::className(), ['time_work' => 'id_ref']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkVacancyDriverLevels()
    {
        return $this->hasMany(WorkVacancyDriverLevel::className(), ['level' => 'id_ref']);
    }
}
