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

DatePickerAsset::register($this);
$this->registerCss("
.form-group { margin-bottom: 5px;}
.input-group-addon {height: 30px; padding: 2px 5px 0 5px;}
#datafieldsform-birthdate-kvdate { width: 140px; float: right;}
#datafieldsform-birthdate {height: 30px !important; text-align: right; padding-right: 10px !important; font-size: 14px;}
 ");
$modelDataFieldsForm = $widget->modelDataFieldsForm;
?>
<?= \common\widgets\AlertIGrowl::widget() ?>
<div class="col-md-4" style="margin-bottom: 20px;  ">
    <h4 style="padding-top: 0; margin-top: 5px;"><?= $modelDataFieldsForm->getAttributeLabel($widget->attribute) ?>:</h4>
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
                'action' => Url::to([$widget->actionUpdate, 'id' => $key]),
                'options' => [
                    'data-pjax' => true,
                ],
                'fieldConfig' => [
                    'template' => "{input}",
                ],
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
                            ?>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-xs-4 text-right"  style="padding: 0;">
                    <?= Html::a("<span class='glyphicon glyphicon-pencil'></span>", Url::to([$widget->actionUpdate, 'id' => $key]),
                        [
                            'class' => 'btn btn-sm btn-primary',
                            'style' => 'margin: 0;',
                            'title' => 'Редактировать'
                        ]);?>
                    <?php
                    if($widget->attribute != 'birthdate'):
                    ?>
                    <?= Html::a("<span class='glyphicon glyphicon-trash'></span>", Url::to([$widget->actionDelete, 'id' => $key]),
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
            'action' => Url::to([$widget->actionCreate]),
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
                    <?= Html::a("<span class='glyphicon glyphicon-plus'></span>", Url::to([$widget->actionCreate]),
                        [
                            'class' => 'btn btn-sm btn-warning',
                            'style' => 'float: right; margin: 0;',
                            'title' => 'Добавить',
                            'disabled' => false
                        ]);?>
                </div>
                <?php
            elseif($widget->attribute == 'birthdate' && !$widget->attributesList):
                ?>
                <div class="col-xs-8 text-right" style="font-size: 12px; padding-top: 5px; padding-right: 30px;">

                </div>
                <div class="col-xs-4 text-right"  style="padding: 0;">
                    <?= Html::a("<span class='glyphicon glyphicon-plus'></span>", Url::to([$widget->actionCreate]),
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
