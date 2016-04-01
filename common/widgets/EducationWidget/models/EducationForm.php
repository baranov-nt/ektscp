<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.03.2016
 * Time: 13:20
 */
namespace common\widgets\EducationWidget\models;

use common\models\GLang;
use common\models\GReferens;
use common\models\TPerson;
use common\models\TPersonContact;
use common\models\TPersonLang;
use frontend\models\GRegion;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * @property EducationForm[] $startDate
 * @property EducationForm[] $endDate
 */

class EducationForm extends Model
{
    public $education;
    public $educationName;
    public $educationType;
    public $startDate;
    public $endDate;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id_edu', 'integer'],
            [['educationName', 'educationType', 'startDate', 'endDate'], 'required', 'on' => 'educationScenario'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'education' => 'Добавить образование',
            'educationName' => 'Название уч. учреждения',
            'educationType' => 'Тип учебного учреждения',
            'startDate' => 'Дата поступления',
            'endDate' => 'Дата окончания',
        ];
    }
}
