<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 01.04.2016
 * Time: 14:05
 */
namespace common\widgets\EducationWidget;

use common\widgets\EducationWidget\models\EducationForm;
use Yii;
use yii\base\Widget;


class EducationWidget extends Widget
{
    public $attribute;
    public $create = false;
    public $update = false;
    public $attributesMax;
    public $attributesCount = 4;
    public $modelEducationForm;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if(!$this->modelEducationForm) {
            $this->modelEducationForm = new EducationForm();
        }

        return $this->render('view', [
            'widget' => $this
        ]);
    }
}
