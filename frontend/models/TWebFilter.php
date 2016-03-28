<?php
namespace app\modules\bts\models;

use Yii;
use app\modules\bts\models\TWfOffice;
use app\modules\bts\models\TWfAdv;
use app\modules\bts\models\TWfInet;
use app\modules\bts\models\TWfPerson;
use app\modules\bts\models\TWfMenu;
/**
 * This is the model class for table "t_webFilter".
 *
 * @property integer $id_wf
 * @property string $domain_mask
 * @property integer $cnt_use
 *
 * @property TWfInet[] $tWfInets
 * @property TInternet[] $idInternets
 * @property TWfPerson[] $tWfPeople
 * @property TPerson[] $idPeople
 * @property TWfAdv[] $tWfAdvs
 * @property TAdv[] $idAdvs
 * @property TWfOffice[] $tWfOffices
 * @property TOffice[] $idOffices
 */
class TWebFilter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_webFilter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['domain_mask', 'cnt_use'], 'required'],
            [['domain_mask'], 'string'],
            [['cnt_use'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_wf' => 'Id Wf',
            'domain_mask' => 'Domain Mask',
            'cnt_use' => 'Cnt Use',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTWfInets()
    {
        return $this->hasMany(TWfInet::className(), ['id_wf' => 'id_wf']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInternets()
    {
        return $this->hasMany(TInternet::className(), ['id_internet' => 'id_internet'])->viaTable('t_wf_inet', ['id_wf' => 'id_wf']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTWfPeople()
    {
        return $this->hasMany(TWfPerson::className(), ['id_wf' => 'id_wf']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPeople()
    {
        return $this->hasMany(TPerson::className(), ['id_person' => 'id_person'])->viaTable('t_wf_person', ['id_wf' => 'id_wf']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTWfAdvs()
    {
        return $this->hasMany(TWfAdv::className(), ['id_wf' => 'id_wf']);
    }/**
     * @return \yii\db\ActiveQuery
     */
    public function getTWfMenus()
    {
        return $this->hasMany(TWfMenu::className(), ['id_wf' => 'id_wf']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAdvs()
    {
        return $this->hasMany(TAdv::className(), ['id_adv' => 'id_adv'])->viaTable('t_wf_adv', ['id_wf' => 'id_wf']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTWfOffices()
    {
        return $this->hasMany(TWfOffice::className(), ['id_wf' => 'id_wf']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOffices()
    {
        return $this->hasMany(TOffice::className(), ['id_office' => 'id_office'])->viaTable('t_wf_office', ['id_wf' => 'id_wf']);
    }
	
	public static function addWebFilter($url, $id_office = 0, $id_adv = 0, $id_internet = 0, $id_person = 0, $id_mi = 0)
	{
		$pu = parse_url($url);
		if(!$pu['host']) return false;
		require_once 'idna_convert.class.php';
		$idn = new \idna_convert();
		$pu['host'] = $idn->encode($pu['host']);
		$domain_mask = '%'.$pu['host'];
		if(!$domain_mask) return false;
		$wf = TWebFilter::find()->where("domain_mask = :domain_mask", ["domain_mask" => $domain_mask])->one();
		if(!$wf) {
			$wf = new TWebFilter;
			$wf->domain_mask = $domain_mask;
			$wf->cnt_use = 0;
		}
		$wf->cnt_use += 1;
		if($wf->save()) {
			if($id_office) {
				$wfo = new TWfOffice;
				$wfo->id_wf = $wf->id_wf;
				$wfo->id_office = $id_office;
				if(!$wfo->save()) return false;
			}
			if($id_adv) {
				$wfo = new TWfAdv;
				$wfo->id_wf = $wf->id_wf;
				$wfo->id_adv = $id_adv;
				if(!$wfo->save()) return false;
			}
			if($id_internet) {
				$wfi = new TWfInet;
				$wfi->id_wf = $wf->id_wf;
				$wfi->id_internet = $id_internet;
				if(!$wfi->save()) return false;
			}
			if($id_person) {
				$wfi = new TWfPerson;
				$wfi->id_wf = $wf->id_wf;
				$wfi->id_person = $id_person;
				if(!$wfi->save()) return false;
			}
			if($id_mi) {
				$wfm = new TWfMenu;
				$wfm->id_wf = $wf->id_wf;
				$wfm->id_mi = $id_mi;
				if(!$wfm->save()) return false;
			}
		} else return false;
		return $wf;
	}
	
	public function delete()
	{
		$this->cnt_use -= 1;
		if($this->cnt_use < 0) $this->cnt_use = 0;
		return $this->save();
	}
	
	public static function deleteWebFilter($id_office = 0, $id_adv = 0, $id_internet = 0, $id_person = 0, $id_mi = 0)
	{
		if($id_adv)
			$wfo = TWfAdv::find()->joinWith('idWf')->where(['id_adv' => $id_adv])->all();

		else if($id_office)
			$wfo = TWfOffice::find()->joinWith('idWf')->where(['id_office' => $id_office])->all();

		else if($id_internet)
			$wfo = TWfInet::find()->joinWith('idWf')->where(['id_internet' => $id_internet])->all();

		else if($id_person)
			$wfo = TWfPerson::find()->joinWith('idWf')->where(['id_person' => $id_person])->all();
		
		else if($id_mi)
			$wfo = TWfMenu::find()->joinWith('idWf')->where(['id_mi' => $id_mi])->all();
			
		
		if($wfo){
			foreach($wfo as $wfo_item) { if(!$wfo_item->idWf->delete() || !$wfo_item->delete()) return false; }
		}
		return true;
	
	}
}
