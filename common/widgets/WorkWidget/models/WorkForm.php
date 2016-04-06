<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.03.2016
 * Time: 13:20
 */
namespace common\widgets\WorkWidget\models;

use common\models\GReferens;
use common\models\TPersonWork;
use frontend\models\GRegion;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * @property WorkForm[] $startDate
 * @property WorkForm[] $endDate
 * @property WorkForm[] $eduTypeList
 * @property WorkForm[] $eduCityList
 * @property WorkForm[] $eduStatusList
 */

class WorkForm extends Model
{
    public $work;
    public $id_work;
    public $city;
    public $org;
    public $post;
    public $startDate;
    public $endDate;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'id_work'], 'integer'],
            [['org', 'post', 'startDate', 'endDate'], 'string'],
            [['city', 'org', 'post', 'startDate', 'startDate'. 'endDate'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'work' => 'Добавить работу',
            'city' => 'Город',
            'org' => 'Организация',
            'post' => 'Должность',
            'startDate' => 'Дата найма',
            'endDate' => 'Дата ухода',
        ];
    }

    public function getWorkCityList()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $modelGRegion = GRegion::find()
            ->joinWith('gCities')
            ->where(['status' => 0])
            ->orderBy('name')
            ->all();

        $items = [];
        /* @var $region \frontend\models\GRegion */
        foreach($modelGRegion as $region) {
            /* @var $city \frontend\models\GCity */
            foreach($region->gCities as $city) {
                $items[$region->name.' '.$region->kodTSt->socrname][$city->id_city] = Yii::t('app', $city->name);
            }
        }

        return $items;
    }

    public function getWorks()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        return TPersonWork::find()
            ->where(['id_person' => $user->tPerson->id_person])
            ->all();
    }

    public function createWork($id = false) {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;

        $modelTPersonWork = ($modelTPersonWork = TPersonWork::findOne($id)) ? $modelTPersonWork : new TPersonWork();
        $modelTPersonWork->org = $this->org;
        $modelTPersonWork->post = $this->post;
        $modelTPersonWork->city = $this->city;
        $modelTPersonWork->start_year = $this->startDate;
        $modelTPersonWork->end_year = $this->endDate;
        $modelTPersonWork->id_person = $user->tPerson->id_person;

        return $modelTPersonWork->save() ? true : false;
    }
}
