<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.03.2016
 * Time: 11:45
 */
namespace common\widgets\DataFieldsList;

use common\widgets\DataFieldsList\models\DataFieldsForm;
use Yii;
use yii\base\Widget;

class AttributesList extends Widget
{
    public $attribute;
    public $attributesPlaceHolder;
    public $attributesList;
    public $attributesCount;
    public $attributesMax;
    public $actionCreate;
    public $actionUpdate;
    public $actionDelete;
    public $modelDataFieldsForm;
    public $create = false;
    public $update = false;
    public $showDeleteButton = true;

    public function init()
    {
        $this->modelDataFieldsForm = new DataFieldsForm();
        parent::init();
    }

    public function run()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;

        $this->attributesList = $user[$this->attributesList];
        $this->attributesCount = count($this->attributesList);

        if($this->update || $this->create) {
            $this->modelDataFieldsForm = new DataFieldsForm();
        }

        return $this->render('view', [
            'widget' => $this
        ]);
    }
}
