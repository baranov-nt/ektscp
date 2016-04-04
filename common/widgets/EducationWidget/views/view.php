<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 05.10.2015
 * Time: 18:16
 */
/* @var $widget \common\widgets\EducationWidget\EducationWidget */
/* @var $modelEducationForm \common\widgets\EducationWidget\models\EducationForm */
/* @var $model \common\widgets\EducationWidget\models\EducationForm */


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
$model = $widget->model;
?>
<?= \common\widgets\AlertIGrowl::widget() ?>
<div class="clearfix"></div>
<div class="col-md-4" style="margin-bottom: 20px;  ">
    <h5 style="padding-top: 0; margin-top: 0;"><?= $modelEducationForm->getAttributeLabel($widget->attribute) ?>:</h5>
</div>
<div class="col-md-8" style="margin-bottom: 20px;">
    <div class="row text-right">
        <?php
        if($widget->create == true):
            ?>
            <?php $form = ActiveForm::begin([
            'action' => Url::to(['/users/profile/create-'.$widget->attribute]),
            'options' => [
                'data-pjax' => true,
            ],
            'fieldConfig' => [
                'template' => "{input}",
            ],
        ]); ?>
            <div class="col-xs-8 text-right" style="padding-left: 0; padding-bottom: 0 !important; margin-bottom: 0 !important;">
                <?php
                //d($modelEducationForm);
                //d($model);
                $widget->modelEducationForm[$widget->attribute] = $model->education;
                ?>
                <?= $form->field($widget->modelEducationForm, $widget->attribute)->dropDownList($modelEducationForm->eduTypeList,
                    [
                        'id' => 'select_type',
                        'class'  => 'chosen-select text-right',
                        'onchange' => 'jQuery("#submitButton").click();',
                        'value' => ''
                    ]);
                //$placeholder = Yii::t('app', $widget->attributesPlaceHolder);
                if(!$model) {
                    $script = <<< JS
                        $("document").ready(function(){
                            //document.getElementById('select_type').value = '';
                            jQuery('#select_type').val('');
                            $('#select_type').trigger('chosen:updated');
                            $("#select_type_chosen span").text("Тип образования");
                        });
JS;
                    $this->registerJs($script);
                }
                switch ($model->scenario) {
                    case 'addSchool':
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?= $form->field($model, 'educationName', ['template'=>'{label}{input}'])->textInput(
                                    [
                                        'class' => 'form-control text-right',
                                        'style' => 'font-size: 12px; height: 30px !important;'
                                    ])->label('Номер') ?>
                            </div>
                        </div>
                        <?php
                        break;
                    case 1:
                        echo "i равно 1";
                        break;
                    case 2:
                        echo "i равно 2";
                        break;
                }
                ?>
                <?php
                if($model):
                    ?>
                    <?= $form->field($model, 'city')->dropDownList($modelEducationForm->getEduCityList(),
                    [
                        'id' => 'select_city',
                        'class'  => 'form-control chosen-select text-right',
                    ])->error('fsdfsdf');
                    if(!$model->city) {
                        $placeholder = Yii::t('app', 'Город');
                        $script = <<< JS
                        $("document").ready(function(){
                            //document.getElementById('select_type').value = '';
                            jQuery('#select_city').val('');
                            $('#select_city').trigger('chosen:updated');
                            $("#select_city_chosen span").text("Город");
                        });
JS;
                        $this->registerJs($script);
                    }
                    ?>
                    <label class="control-label">Период обучения</label>
                    <?php
                    $model->startDate = '1985';
                    $model->endDate = '1990';
                    ?>
                    <?= DatePicker::widget([
                    'model' => $model,
                    'language' => 'ru',
                    'attribute' => 'startDate',
                    'attribute2' => 'endDate',
                    'separator' => 'до',
                    'options' => [
                        'placeholder' => 'Дата поступления',
                        'value' => '1985'
                    ],
                    'options2' => [
                        'value' => '1990',
                        //'placeholder' => 'Дата окончания',
                        //'style' => 'margin: 0 !important; padding: 0;'
                    ],
                    'type' => DatePicker::TYPE_RANGE,
                    'form' => $form,
                    //'layout' => '{input}{picker}',
                    //'value' => Yii::$app->formatter->asDate(time(), "php:d.m.Y"),
                    'pluginOptions' => [
                        'format' => 'yyyy',
                        'autoclose' => true,
                        'minViewMode' => 2,
                    ]
                ]);
                    ?>
                    <?php
                    //d($model->scenario);
                    ?>
                    <?= Html::hiddenInput('scenario', $model->scenario) ?>
                    <?php
                endif;
                ?>
            </div>
            <div class="col-xs-4 text-right" style="padding: 0;">
                <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span>",
                    [
                        'id' => 'submitButton',
                        'class' => 'btn btn-sm btn-success',
                        'title' => 'Сохранить'
                    ]) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <?php
        endif;
        ?>
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
