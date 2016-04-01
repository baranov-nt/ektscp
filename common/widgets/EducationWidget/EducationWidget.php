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
    public $attributesMax;
    public $attributesCount = 4;
    public $modelEducationForm;

    public function init()
    {
        $this->modelEducationForm = new EducationForm();
        parent::init();
    }

    public function run()
    {
        /* @var $user \common\models\Users */
        /*$user = Yii::$app->user->identity;

        $this->attributesList = $user[$this->attributesList];
        $this->attributesCount = count($this->attributesList);

        if($this->update || $this->create) {
            $this->modelEducationForm = new EducationForm();
        }*/

        $this->attributesCount = 4;

        return $this->render('view', [
            'widget' => $this
        ]);
    }
}
