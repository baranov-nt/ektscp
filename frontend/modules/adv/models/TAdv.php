<?php

namespace frontend\modules\adv\models;

use Yii;
use frontend\modules\files\models\FileImage;
use frontend\modules\files\models\FileDoc;
use frontend\models\TWebFilter;

/**
 * This is the model class for table "t_adv".
 *
 * @property integer $id_adv
 * @property integer $type
 * @property integer $type_adv
 * @property integer $place_type
 * @property integer $priority_type
 * @property string $file
 * @property string $phone
 * @property string $web
 * @property string $title
 * @property string $subtitle
 * @property string $txt
 * @property string $name
 * @property integer $category
 * @property integer $user
 * @property integer $agent
 * @property integer $community
 * @property integer $status
 * @property integer $vip
 * @property string $id_file
 * @property integer $id_campany
 * @property integer $created
 * @property integer $id_city
 * @property string $street
 * @property string $house
 * @property string $num
 *
 * @property TCampany $idCampany
 * @property TAdvShedule[] $tAdvShedules
 * @property TAdvStat[] $tAdvStats
 * @property TWfAdv[] $tWfAdvs
 * @property TWebFilter[] $idWfs
 */
class TAdv extends \yii\db\ActiveRecord
{
	public $prev_web;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_adv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type', 'type_adv', 'place_type', 'priority_type', 'category', 'user', 'agent', 'community', 'status', 'vip', 'id_file', 'id_campany', 'id_city', 'prev_adv'], 'integer'],
            [['file', 'phone', 'web', 'title', 'subtitle', 'txt', 'name', 'street', 'house', 'num'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_adv' => 'Id Adv',
            'type' => 'Type',
            'type_adv' => 'Type Adv',
            'place_type' => 'Place Type',
            'priority_type' => 'Priority Type',
            'file' => 'File',
            'phone' => 'Phone',
            'web' => 'Web',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'txt' => 'Txt',
            'name' => 'Name',
            'category' => 'Category',
            'user' => 'User',
            'agent' => 'Agent',
            'community' => 'Community',
            'status' => 'Status',
            'vip' => 'Vip',
            'id_file' => 'Id File',
            'id_campany' => 'Id Campany',
			'created' => 'Created',
			'prev_adv' => 'Prev adv',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCampany()
    {
        return $this->hasOne(TCampany::className(), ['id_campany' => 'id_campany']);
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCity()
    {
        return $this->hasOne(GCity::className(), ['id_city' => 'id_city']);
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAdvShedules()
    {
        return $this->hasMany(TAdvShedule::className(), ['adv' => 'id_adv']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAdvStats()
    {
        return $this->hasMany(TAdvStat::className(), ['adv' => 'id_adv']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTWfAdvs()
    {
        return $this->hasMany(TWfAdv::className(), ['id_adv' => 'id_adv']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWfs()
    {
        return $this->hasMany(TWebFilter::className(), ['id_wf' => 'id_wf'])->viaTable('t_wf_adv', ['id_adv' => 'id_adv']);
    }
	
    public function getLogo0()
    {
        return $this->hasOne(FileImage::className(), ['id_file' => 'id_file']);
    }
	
    public function getFile0()
    {
        return $this->hasOne(FileDoc::className(), ['id_file' => 'id_file']);
    }
	
	public function afterSave($insert) 
	{	
		if($this->web) {
			if($this->prev_web == $this->web) return true;
			
			if($this->prev_web != "" && $this->prev_web != $this->web) TWebFilter::deleteWebFilter(0, $this->id_adv);
			
			$TWebFilter = TWebFilter::addWebFilter($this->web, 0, $this->id_adv, 0, 0);
			if($TWebFilter){
				return true;
			} else {
				return false;
			}
		}
		else return true;
	}
	
	public function beforeSave($insert)
	{
		if(parent::beforeSave($insert)) {
			
			if($this->web) {
				$pattern = "/^.+?(\.[а-яa-z]{2,4})(.)*$/iu";

				if (preg_match($pattern, $this->web)){ 
					if($this->web && strpos($this->web, 'http') === FALSE) $this->web = 'http://'.$this->web;
				} 
				else { 
					$this->addError('web', Yii::t('errors', 'Укажите корректный URL.'));
					return false;
				}
			}
			
			return true;
		}
		else return false;
	}
	
	public function beforeDelete() 
	{
		if(parent::beforeDelete($insert)) {
			TWebFilter::deleteWebFilter(0, $this->id_adv);
			return true;
		}
		else return false;
	}
}
