<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 01.04.2016
 * Time: 14:05
 */
namespace common\widgets\WorkWidget;

use common\widgets\WorkWidget\models\WorkForm;
use Yii;
use yii\base\Widget;


class WorkWidget extends Widget
{
    public $attribute;
    public $create = false;
    public $update = false;
    public $attributesMax;
    public $attributesCount = 4;
    public $modelWorkForm;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if(!$this->modelWorkForm) {
            $this->modelWorkForm = new WorkForm();
        }

        return $this->render('view', [
            'widget' => $this
        ]);
    }
}
