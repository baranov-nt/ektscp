<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.03.2016
 * Time: 13:20
 */
namespace common\widgets\EducationWidget\models;

use common\models\GEduOrg;
use common\models\GReferens;
use common\models\TPersonEdu;
use frontend\models\GRegion;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * @property EducationForm[] $startDate
 * @property EducationForm[] $endDate
 * @property EducationForm[] $eduTypeList
 * @property EducationForm[] $eduCityList
 * @property EducationForm[] $eduStatusList
 */

class EducationForm extends Model
{
    public $id_edu;
    public $education;
    public $educationName;
    public $city;
    public $startDate;
    public $endDate;
    public $faculty;
    public $cafedra;
    public $speciality;
    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'status', 'id_edu'], 'integer'],
            [['faculty', 'cafedra', 'speciality'], 'string'],
            [['education', /*'city', 'educationName', 'startDate', 'endDate'*/], 'required', 'on' => 'default'],
            [['education', 'city', 'educationName', 'startDate', 'endDate'], 'required', 'on' => 'addSchool'],
            [['education', 'city', 'educationName', 'startDate', 'endDate'], 'required', 'on' => 'addLyceum'],
            [['education', 'city', 'educationName', 'startDate', 'endDate', 'speciality'], 'required', 'on' => 'addSpecializedSchool'],
            [['education', 'city', 'educationName', 'startDate', 'endDate', 'speciality'], 'required', 'on' => 'addTechnicalCollege'],
            [['education', 'city', 'educationName', 'startDate', 'endDate', 'speciality'], 'required', 'on' => 'addCollege'],
            [['education', 'city', 'educationName', 'startDate', 'endDate', 'faculty', 'cafedra', 'speciality', 'status'], 'required', 'on' => 'addUniversity'],
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
            'speciality' => 'Специальность',
            'startDate' => 'Дата поступления',
            'endDate' => 'Дата окончания',
            'faculty' => 'Факультет',
            'cafedra' => 'Кафедра',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeEdu($id)
    {
        $modelGReferens = GReferens::findOne($id);
        return $modelGReferens->name;
    }

    public function getEduTypeList()
    {
        return ArrayHelper::map(GReferens::find()
            ->where([
                'base_ref' => 482,
            ])
            ->all(),'id_ref', 'name');
    }

    public function getEduStatusList()
    {
        return ArrayHelper::map(GReferens::find()
            ->where([
                'base_ref' => 481,
            ])
            ->all(),'id_ref', 'name');
    }

    public function getScenarioName($name)
    {
        switch ($name) {
            case 'Школа':
                return 'addSchool';
                break;
            case 'Лицей':
                return 'addLyceum';
                break;
            case 'ПТУ':
                return 'addSpecializedSchool';
                break;
            case 'Техникум':
                return 'addTechnicalCollege';
                break;
            case 'Колледж':
                return 'addCollege';
                break;
            case 'ВУЗ':
                return 'addUniversity';
                break;
        }
        return false;
    }

    public function getSchools()
    {
        /* @var $user \common\models\Users */
        /* @var $modelTPerson \common\models\TPerson */
        $user = Yii::$app->user->identity;
        return TPersonEdu::find()
            ->joinWith('eduOrg')
            ->where(['id_person' => $user->tPerson->id_person])
            ->orderBy('type_edu')
            ->all();
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
        //dd($this);
        //$modelGEduOrg = (TPersonEdu::findOne())

        $modelGEduOrg = GEduOrg::findOne([
            'city' => $this->city,
            'type_edu' => $this->education,
            'name' => $this->educationName,
        ]);
        if(!$modelGEduOrg) {
            $modelGEduOrg = new GEduOrg();
            $modelGEduOrg->city = $this->city;
            $modelGEduOrg->type_edu = $this->education;
            $modelGEduOrg->name = $this->educationName;
            $modelGEduOrg->save();
        }

        $user = Yii::$app->user->identity;
        $modelTPersonEdu = ($modelTPersonEdu = TPersonEdu::findOne($this->id_edu)) ? $modelTPersonEdu : new TPersonEdu();
        $modelTPersonEdu->id_person = $user->tPerson->id_person;
        $modelTPersonEdu->edu_org = $modelGEduOrg->id_edu_org;
        $modelTPersonEdu->faculty = $this->faculty;
        $modelTPersonEdu->cafedra = $this->cafedra;
        $modelTPersonEdu->speciality = $this->speciality;
        $modelTPersonEdu->status = $this->status;
        $modelTPersonEdu->start_year = $this->startDate;
        $modelTPersonEdu->end_year = $this->endDate;
        if($modelTPersonEdu->save()) {
            return true;
        }
        dd($modelTPersonEdu->errors);
    }
}
