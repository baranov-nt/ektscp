<?php

namespace frontend\modules\adv\models;

use Yii;

/**
 * This is the model class for table "t_advShedule".
 *
 * @property integer $id_advshedule
 * @property string $startdate
 * @property string $enddate
 * @property integer $place
 * @property integer $status
 * @property integer $adv
 * @property integer $terminal
 * @property string $moderate_comment
 *
 * @property TAdv $adv0
 * @property TTerminal $terminal0
 */
class TAdvShedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_advShedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['startdate', 'enddate', 'place', 'status', 'adv', 'terminal'], 'required'],
            [['startdate', 'enddate'], 'safe'],
            [['place', 'status', 'adv', 'terminal'], 'integer'],
            [['moderate_comment'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_advshedule' => 'Id Advshedule',
            'startdate' => 'Startdate',
            'enddate' => 'Enddate',
            'place' => 'Place',
            'status' => 'Status',
            'adv' => 'Adv',
            'terminal' => 'Terminal',
            'moderate_comment' => 'Moderate Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdv0()
    {
        return $this->hasOne(TAdv::className(), ['id_adv' => 'adv']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerminal0()
    {
        return $this->hasOne(TTerminal::className(), ['id_terminal' => 'terminal']);
    }
	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;

		$criteria->compare('id_advshedule',$this->id_advshedule);
		$params = array();
		if($this->startdate && !$this->enddate) {
			$criteria->addCondition('(t.startdate >= :startdate1 OR t.enddate >= :startdate2)');
			$params[':startdate1'] = $this->startdate;
			$params[':startdate2'] = $this->startdate;
		}
		else if(!$this->startdate && $this->enddate) {
			$criteria->addCondition('(t.startdate <= :enddate1 OR t.enddate <= :enddate2)');
			$params[':enddate1'] = $this->enddate;
			$params[':enddate2'] = $this->enddate;
		}
		else if($this->startdate && $this->enddate) {
			$criteria->addCondition('((t.startdate >= :startdate1 AND t.startdate <= :enddate1) OR (t.enddate >= :startdate2 AND t.enddate <= :enddate2))');
			$params[':startdate1'] = $this->startdate;
			$params[':startdate2'] = $this->startdate;
			$params[':enddate1'] = $this->enddate;
			$params[':enddate2'] = $this->enddate;
		}
		$criteria->params = $params;
		$criteria->compare('place',$this->place);
		$criteria->compare('status',$this->status);
		$criteria->compare('adv',$this->adv);
		$criteria->compare('terminal', $this->terminal);
		
		if(!$this->adv) {
			$criteria->with = array('adv0'=>array('joinType'=>'inner join'), 'terminal0'=>array('joinType'=>'inner join'));
			
			$mc = Yii::$app->user->model()->getModerateCommunities();
			$condition =  '(adv0.[user] = '.Yii::$app->user->id.' AND community IS NULL';
			if($mc) $condition .=  ' OR adv0.community IN ('.implode(',', $mc).')';
			$condition .= ')';
			$criteria->addCondition($condition);
		
			$criteria->addSearchCondition('adv0.title', $_GET['title'], true);
			if($_GET['mm'] == 1) $criteria->compare('adv0.type','<4');
			else $criteria->compare('adv0.type',' = 4');
			$criteria->together = true;
		}
		
		$order = array();
		if(!$_GET['TAdvShedule_sort'])
			$order[] = 't.enddate DESC';
			
		$criteria->order = implode(',', $order);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'title'=>array(
						'asc'=>'adv0.title',
						'desc'=>'adv0.title DESC',
					),
					'*',
				),
			),
		));
	}
}
