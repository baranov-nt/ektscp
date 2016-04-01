<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 05.10.2015
 * Time: 18:16
 */
/* @var $widget \common\widgets\DataFieldsList\AttributesList */
/* @var $modelDataFieldsForm \common\widgets\DataFieldsList\models\DataFieldsForm */

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
$modelDataFieldsForm = $widget->modelDataFieldsForm;
?>
<?= \common\widgets\AlertIGrowl::widget() ?>
<div class="clearfix"></div>
<div class="col-md-4" style="margin-bottom: 20px;  ">
    <h5 style="padding-top: 0; margin-top: 0;"><?= $modelDataFieldsForm->getAttributeLabel($widget->attribute) ?>:</h5>
</div>
<div class="col-md-8" style="margin-bottom: 20px;">
    <div class="row">
        <?php
        foreach($widget->attributesList as $key => $value):
            ?>
            <?php
            if($widget->update == $key):
                ?>
                <?php $form = ActiveForm::begin([
                'action' => Url::to(['/users/profile/update-'.$widget->attribute, 'id' => $key]),
                'options' => [
                    'data-pjax' => true,
                ],
                'fieldConfig' => [
                    'template' => "{input}",
                ],
                'fieldClass' => ActiveField::className(),
            ]); ?>
                <div class="col-xs-8 text-right" style="padding-left: 0; padding-bottom: 0 !important; margin-bottom: 0 !important;">
                    <?php
                    $modelDataFieldsForm[$widget->attribute] = $value;
                    ?>
                    <?php
                    if($widget->attribute == 'phone'):
                        ?>
                        <?= $form->field($widget->modelDataFieldsForm, $widget->attribute, ['template'=>'{input}'])->widget(MaskedInput::className(),[
                        'name' => 'phone',
                        'mask' => '7 (999) 999-9999',
                        'options' => [
                            'placeholder' => '7 (___) ___-____',
                            'class' => 'form-control text-right',
                            'style' => 'font-size: 12px; height: 30px !important;'
                        ]])->label(false)->error(false) ?>
                        <?php
                    elseif($widget->attribute == 'birthdate'):
                        $modelDataFieldsForm[$widget->attribute] = Yii::$app->formatter->asDate($value, "php:d.m.Y");
                        ?>
                        <?= $form->field($widget->modelDataFieldsForm, $widget->attribute)->widget(
                        DatePicker::classname(), [
                        'language' => 'ru',
                        'name' => 'startSale',
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'layout' => '{input}{picker}',
                        //'value' => Yii::$app->formatter->asDate(time(), "php:d.m.Y"),
                        'options' => [
                            'class' => 'period-picker',
                        ],
                        'pickerButton' => '<span class="input-group-addon kv-field-separator calendar-button-style kv-date-calendar">
                                            <svg width="18" height="18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink= "http://www.w3.org/1999/xlink">
	                                            <image xlink:href="/images/activeCAL.svg" x="0" y="0" height="18px" width="18px"/>
                                            </svg>
                                       </span>',
                        'buttonOptions' => 'label',
                        'pluginOptions' => [
                            'todayHighlight' => false,
                            'todayBtn' => false,
                            'format' => 'dd.mm.yyyy',
                            'autoclose' => true,
                        ]
                    ]);
                        ?>
                        <?php
                    elseif($widget->attribute == 'gender'):
                        ?>
                        <?= $form->field($widget->modelDataFieldsForm, $widget->attribute)->dropDownList(['1' => 'мужской', '0' => 'женский'],
                        [
                            'class'  => 'chosen-select text-right',
                        ])->label(false)->error(false);
                        $placeholder = Yii::t('app', $widget->attributesPlaceHolder);
                        ?>
                        <?php
                    elseif($widget->attribute == 'marital'):
                        ?>
                        <?= $form->field($widget->modelDataFieldsForm, $widget->attribute)->dropDownList($modelDataFieldsForm->getMaritalList(),
                        [
                            'class'  => 'chosen-select text-right',
                        ])->label(false)->error(false);
                        ?>
                        <?php
                    elseif($widget->attribute == 'children'):
                        ?>
                        <?= $form->field($widget->modelDataFieldsForm, $widget->attribute)->dropDownList(['1' => 'есть', '0' => 'нет'],
                        [
                            'class'  => 'chosen-select text-right',
                        ])->label(false)->error(false);
                        $placeholder = Yii::t('app', $widget->attributesPlaceHolder);
                        ?>
                        <?php
                    elseif($widget->attribute == 'birthcity'):
                        ?>
                        <?= $form->field($widget->modelDataFieldsForm, $widget->attribute)->dropDownList($modelDataFieldsForm->getBirthcityList(),
                        [
                            'class'  => 'chosen-select text-right',
                        ])->label(false)->error(false);
                        ?>
                        <?php
                    elseif($widget->attribute == 'langs'):
                        ?>
                        <?php
                        $modelDataFieldsForm[$widget->attribute] = $modelDataFieldsForm->getLangsValue();
                        ?>
                        <?= $form->field($widget->modelDataFieldsForm, $widget->attribute)->dropDownList($modelDataFieldsForm->getLangsList(),
                        [
                            'class'  => 'form-control chosen-select',
                            'multiple' => 'true',
                            'data-placeholder' => Yii::t('app', $widget->attributesPlaceHolder)
                        ])->label(false)->error(false);
                        ?>
                        <?php
                    else:
                        ?>
                        <?= $form->field($widget->modelDataFieldsForm, $widget->attribute, ['template'=>'{input}'])->textInput(
                        [
                            'placeholder' => $widget->attributesPlaceHolder,
                            'class' => 'form-control text-right',
                            'style' => 'font-size: 12px; height: 30px !important;'
                        ])->label(false)->error(false) ?>
                        <?php
                    endif;
                    ?>
                </div>
                <div class="col-xs-4 text-right" style="padding: 0;">
                    <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span>", ['class' => 'btn btn-sm btn-success', 'title' => 'Сохранить']) ?>
                </div>
                <?= $form->field($widget->modelDataFieldsForm, 'id_pc')->hiddenInput(['value' => $key])->label(false)->error(false)->hint(false) ?>
                <?php ActiveForm::end(); ?>
                <?php
            else:
                ?>
                <div class="col-xs-8 text-right" style="font-size: 12px; padding-top: 5px; padding-right: 30px;">
                    <?php
                    switch($widget->attribute) {
                        case 'phone':
                            ?>
                            <p><?= $value ?></p>
                            <?php
                            break;
                        case 'email':
                            ?>
                            <p><a href="mailto:<?= $value ?>"><?= $value ?></a></p>
                            <?php
                            break;
                        case 'skype':
                            ?>
                            <p><?= $value ?></p>
                            <?php
                            break;
                        case 'site':
                            ?>
                            <p><a href="<?= $value ?>" target="_blank"><?= $value ?></a></p>
                            <?php
                            break;
                        case 'birthdate':
                            ?>
                            <p><?= Yii::$app->formatter->asDate($value, "php:d.m.Y") ?> г.</p>
                            <?php
                            break;
                        case 'gender':
                            ?>
                            <p><?= ($value == 1) ? 'мужской' : 'женский' ?></p>
                            <?php
                            break;
                        case 'marital':
                            ?>
                            <p><?= $modelDataFieldsForm->maritalStatus ?></p>
                            <?php
                            break;
                        case 'children':
                            ?>
                            <p><?= ($value == 1) ? 'есть' : 'нет' ?></p>
                            <?php
                            break;
                        case 'birthcity':
                            ?>
                            <p><?= $modelDataFieldsForm->cityName ?></p>
                            <?php
                            break;
                        case 'langs':
                            ?>
                            <p><?= $modelDataFieldsForm->myLangsList ?></p>
                            <?php
                            break;
                            ?>
                            <?php
                    }
                    ?>
                </div>
                <div class="col-xs-4 text-right"  style="padding: 0;">
                    <?= Html::a("<span class='glyphicon glyphicon-pencil'></span>", Url::to(['/users/profile/update-'.$widget->attribute, 'id' => $key]),
                        [
                            'class' => 'btn btn-sm btn-primary',
                            'style' => 'margin: 0;',
                            'title' => 'Редактировать'
                        ]);?>
                    <?php
                    if($widget->showDeleteButton):
                        ?>
                        <?= Html::a("<span class='glyphicon glyphicon-trash'></span>", Url::to(['/users/profile/delete-'.$widget->attribute, 'id' => $key]),
                        [
                            'class' => 'btn btn-sm btn-danger',
                            'style' => 'margin-left: 2px; float: rigth;',
                            'title' => 'Удалить'
                        ]);?>
                        <?php
                    endif;
                    ?>
                </div>
                <?php
            endif;
            ?>
            <?php
        endforeach;
        ?>
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
                if($widget->attribute == 'phone'):
                    ?>
                    <?= $form->field($widget->modelDataFieldsForm, $widget->attribute, ['template'=>'{input}'])->widget(MaskedInput::className(),[
                    'name' => 'phone',
                    'mask' => '7 (999) 999-9999',
                    'options' => [
                        'placeholder' => '7 (___) ___-____',
                        'class' => 'form-control text-right',
                        'style' => 'font-size: 12px; height: 30px !important;'
                    ]])->label(false)->error(false) ?>
                    <?php
                elseif($widget->attribute == 'birthdate'):
                    $time = strtotime("-21 year", time());
                    $modelDataFieldsForm[$widget->attribute] = Yii::$app->formatter->asDate($time, "php:d.m.Y");
                    ?>
                    <?= $form->field($widget->modelDataFieldsForm, $widget->attribute)->widget(
                    DatePicker::classname(), [
                    'language' => 'ru',
                    'name' => 'startSale',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'layout' => '{input}{picker}',
                    //'value' => Yii::$app->formatter->asDate(time(), "php:d.m.Y"),
                    'options' => [
                        'class' => 'period-picker',
                    ],
                    'pickerButton' => '<span class="input-group-addon kv-field-separator calendar-button-style kv-date-calendar">
                                            <svg width="18" height="18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink= "http://www.w3.org/1999/xlink">
	                                            <image xlink:href="/images/activeCAL.svg" x="0" y="0" height="18px" width="18px"/>
                                            </svg>
                                       </span>',
                    'buttonOptions' => 'label',
                    'pluginOptions' => [
                        'todayHighlight' => false,
                        'todayBtn' => false,
                        'format' => 'dd.mm.yyyy',
                        'autoclose' => true,
                    ]
                ]);
                    ?>
                    <?php
                elseif($widget->attribute == 'gender'):
                    ?>
                    <?= $form->field($widget->modelDataFieldsForm, $widget->attribute)->dropDownList(['1' => 'мужской', '0' => 'женский'],
                    [
                        'class'  => 'chosen-select text-right',
                    ])->label(false)->error(false);
                    $placeholder = Yii::t('app', $widget->attributesPlaceHolder);
                    $script = <<< JS
                        $("document").ready(function(){
                            $(".chosen-single span").text("$placeholder");
                        });
JS;
                    $this->registerJs($script);
                    ?>
                    <?php
                elseif($widget->attribute == 'marital'):
                    ?>
                    <?= $form->field($widget->modelDataFieldsForm, $widget->attribute)->dropDownList($modelDataFieldsForm->getMaritalList(),
                    [
                        'class'  => 'chosen-select text-right',
                    ])->label(false)->error(false);
                    $placeholder = Yii::t('app', $widget->attributesPlaceHolder);
                    $script = <<< JS
                        $("document").ready(function(){
                            $(".chosen-single span").text("$placeholder");
                        });
JS;
                    $this->registerJs($script);
                    ?>
                    <?php
                elseif($widget->attribute == 'children'):
                    ?>
                    <?= $form->field($widget->modelDataFieldsForm, $widget->attribute)->dropDownList(['1' => 'есть', '0' => 'нет'],
                    [
                        'class'  => 'chosen-select text-right',
                    ])->label(false)->error(false);
                    $placeholder = Yii::t('app', $widget->attributesPlaceHolder);
                    $script = <<< JS
                        $("document").ready(function(){
                            $(".chosen-single span").text("$placeholder");
                        });
JS;
                    $this->registerJs($script);
                    ?>
                    <?php
                elseif($widget->attribute == 'birthcity'):
                    ?>
                    <?= $form->field($widget->modelDataFieldsForm, $widget->attribute)->dropDownList($modelDataFieldsForm->getBirthcityList(),
                    [
                        'class'  => 'chosen-select text-right',
                    ])->label(false)->error(false);
                    $placeholder = Yii::t('app', $widget->attributesPlaceHolder);
                    $script = <<< JS
                        $("document").ready(function(){
                            $(".chosen-single span").text("$placeholder");
                        });
JS;
                    $this->registerJs($script);
                    ?>
                    <?php
                elseif($widget->attribute == 'langs'):
                    ?>
                    <?= $form->field($widget->modelDataFieldsForm, $widget->attribute)->dropDownList($modelDataFieldsForm->getLangsList(),
                    [
                        'class'  => 'form-control chosen-select',
                        'multiple' => 'true',
                        'data-placeholder' => Yii::t('app', $widget->attributesPlaceHolder)
                    ])->label(false)->error(false);
                    ?>
                    <?php
                else:
                    ?>
                    <?= $form->field($widget->modelDataFieldsForm, $widget->attribute, ['template'=>'{input}'])->textInput(
                    [
                        'placeholder' => $widget->attributesPlaceHolder,
                        'form-control text-right',
                        'class' => 'form-control text-right',
                        'style' => 'font-size: 12px; height: 30px !important;'
                    ])->label(false)->error(false) ?>
                    <?php
                endif;
                ?>
            </div>
            <div class="col-xs-4 text-right" style="padding: 0;">
                <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span>", ['class' => 'btn btn-sm btn-success', 'title' => 'Сохранить']) ?>
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
            elseif(($widget->attribute == 'birthdate' || $widget->attribute == 'gender') && !$widget->attributesList):
                ?>
                <div class="col-xs-8 text-right" style="font-size: 12px; padding-top: 5px; padding-right: 30px;">

                </div>
                <div class="col-xs-4 text-right"  style="padding: 0;">
                    <?= Html::a("<span class='glyphicon glyphicon-plus'></span>", Url::to(['/users/profile/create-'.$widget->attribute]),
                        [
                            'class' => 'btn btn-sm btn-warning',
                            'style' => 'float: right; margin: 0;',
                            'title' => 'Добавить',
                            'disabled' => false
                        ]);?>
                </div>
                <?php
            endif;
        endif;
        ?>
    </div>
</div>
