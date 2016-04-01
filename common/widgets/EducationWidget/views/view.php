<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 05.10.2015
 * Time: 18:16
 */
/* @var $widget \common\widgets\EducationWidget\EducationWidget */
/* @var $modelEducationForm \common\widgets\EducationWidget\models\EducationForm */

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use kartik\date\DatePicker;
use kartik\date\DatePickerAsset;
use yii\bootstrap\ActiveForm;
use common\widgets\Chosen\ChosenAsset;
use frontend\modules\users\assets\UsersAsset;
use justinvoelker\awesomebootstrapcheckbox\ActiveField;

DatePickerAsset::register($this);
ChosenAsset::register($this);
UsersAsset::register($this);
/*$this->registerCss("

 ");*/
$modelEducationForm = $widget->modelEducationForm;
?>
<?= \common\widgets\AlertIGrowl::widget() ?>
<div class="clearfix"></div>
<div class="col-md-4" style="margin-bottom: 20px;  ">
    <h5 style="padding-top: 0; margin-top: 0;"><?= $modelEducationForm->getAttributeLabel($widget->attribute) ?>:</h5>
</div>
<div class="col-md-8" style="margin-bottom: 20px;">
    <div class="row">
        <?php
        if(!$widget->create):
            if($widget->attributesMax > $widget->attributesCount):
                ?>
                <div class="col-xs-8 text-right" style="font-size: 12px; padding-top: 5px; padding-right: 30px;">

                </div>
                <div class="col-xs-4 text-right"  style="padding: 0;">
                    <?= Html::a("<span class='glyphicon glyphicon-plus'></span>", Url::to(['/users/profile/create-'.$widget->attribute]),
                        [
                            'id' => 'buttonPlusDisable',
                            'class' => 'btn btn-sm btn-warning',
                            'style' => 'float: right; margin: 0;',
                            'title' => 'Добавить',
                            'disabled' => false
                        ]);

                    ?>
                </div>
                <?php
            endif;
        endif;
        ?>
    </div>
</div>
