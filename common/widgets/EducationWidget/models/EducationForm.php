<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.03.2016
 * Time: 13:20
 */
namespace common\widgets\EducationWidget\models;

use common\models\GEduOrg;
use common\models\GLang;
use common\models\GReferens;
use common\models\TPerson;
use common\models\TPersonContact;
use common\models\TPersonEdu;
use common\models\TPersonLang;
use frontend\models\GRegion;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * @property EducationForm[] $startDate
 * @property EducationForm[] $endDate
 * @property EducationForm[] $eduTypeList
 * @property EducationForm[] $eduCityList
 */

class EducationForm extends Model
{
    public $education;
    public $educationName;
    public $city;
    public $startDate;
    public $endDate;
    public $scenarioEdu;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_edu', 'city'], 'integer'],
            [['education', /*'city', 'educationName', 'startDate', 'endDate'*/], 'required', 'on' => 'default'],
            [['education', 'city', 'educationName', 'startDate', 'endDate', 'scenarioEdu'], 'required', 'on' => 'addSchool'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'education' => 'Добавить образование',
            'educationNumber' => 'Номер',
            'educationName' => 'Название уч. учреждения',
            'educationType' => 'Тип учебного учреждения',
            'startDate' => 'Дата поступления',
            'endDate' => 'Дата окончания',
        ];
    }

    public function getEduTypeList()
    {
        return ArrayHelper::map(GReferens::find()
            ->where([
                'base_ref' => 482,
            ])
            ->all(),'id_ref', 'name');
    }

    public function getEduCityList()
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

    public function createEducation() {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $modelGEduOrg = new GEduOrg();
        $modelGEduOrg->city = $this->city;
        $modelGEduOrg->type_edu = $this->education;
        $modelGEduOrg->name = $this->educationName;
        if($modelGEduOrg->save()) {
            $user = Yii::$app->user->identity;
            $modelTPersonEdu = new TPersonEdu();
            $modelTPersonEdu->id_person = $user->tPerson->id_person;
            $modelTPersonEdu->edu_org = $modelGEduOrg->id_edu_org;
            $modelTPersonEdu->start_year = $this->startDate;
            $modelTPersonEdu->end_year = $this->endDate;
            if($modelTPersonEdu->save()) {
                return true;
            }
            dd($modelTPersonEdu->errors);

        }



        dd($modelTPersonEdu);
    }
}
