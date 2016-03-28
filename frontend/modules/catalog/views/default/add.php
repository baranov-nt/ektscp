<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.01.2016
 * Time: 14:25
 */
/* @var $this yii\web\View */
/* @var $modelTOffice \common\models\TOffice */
/* @var $form ActiveForm */

use common\widgets\FontAwesome\AssetBundle;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;
use frontend\assets\ChosenAsset;
use yii\widgets\MaskedInput;
use frontend\modules\catalog\assets\CatalogAsset;
use yii\helpers\Html;
use kartik\date\DatePicker;
use justinvoelker\awesomebootstrapcheckbox\ActiveField;

Yii::$app->assetManager->forceCopy = true;
/*Pjax::begin([
    'id' => 'pjax-container',
    'enablePushState' => false,
]);*/
ChosenAsset::register($this);
AssetBundle::register($this);
CatalogAsset::register($this);

$userAgentInfo = Yii::$app->userAgentParser->getUserAgentObject();
?>
<div class="wrap">
    <div class="container container-view">
        <div  class="col-md-4 col-md-offset-4">
            <span id="error-block" style="outline: none;">&nbsp;</span>
            <?= Alert::widget() ?>
            <div class="col-md-12 text-center"><h1><?= Yii::t('app', 'Умный справочник') ?></h1></div>
            <div class="col-md-12 text-center"><p class="rating-font padding-top-bottom-20">
                    <?= $modelTOffice->isNewRecord ? Yii::t('app', 'Добавление визитки') : Yii::t('app', 'Редактирование визитки') ?>
                </p></div>
            <?php
            $form = ActiveForm::begin([
                'options' => ['data-pjax' => true, 'enctype' => 'multipart/form-data'],
                'fieldClass' => ActiveField::className(),
                ]
            );
            ?>

            <?php
            if($modelTOffice->mainImg->path) {
                $display = 'block';
            } else {
                $display = 'none';
            }
            ?>
            <?= Html::img([$modelTOffice->mainImg->path], [
                'id' => 'id_file',
                'style' => 'width: 100%; display: '.$display.';'
            ]) ?>

            <?= $form->field($modelTOffice, 'file')->hiddenInput([
                'name' => 'old_file'
            ])->label(false) ?>

            <?php
            if($modelTOffice->isNewRecord):
                ?>
                <?= Html::button('Добавить изображение', ['class' => 'btn btn-info', 'id' => 'upload_image']) ?>
                <?php
            else:
                ?>
                <?= Html::button('Изменить изображение', ['class' => 'btn btn-primary', 'id' => 'upload_image']) ?>
                <?php
            endif;
            ?>

            <?= \frontend\components\widgets\WidgetUpload::widget([
                "upload_button" => [
                    "upload_image",      //id кнопки
                ],
                "input_name" => [
                    "upload_image" => "id_file", //Ключ id кнопки = значение - название инпута (name="")
                ],
                "selector_file" => [
                    "upload_image" => "id_file", //Ключ id кнопки = значение - название инпута (name="")
                ],
                'name_old_file' => [
                    "upload_image" => "old_file",
                ],
                "extensions" => "gif|jpg|jpeg|png",
                "popup_hidden" => true
            ]);?>



            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12">
                    <?= $form->field($modelTOffice, 'title') ?>
                </div>
                <div class="col-md-12">
                    <?php
                    if(!$modelTOffice->isNewRecord) {
                        $modelTOffice->category = $modelTOffice->getCategoryValue($modelTOffice);
                    }
                    echo $form->field($modelTOffice, 'category')->dropDownList($modelTOffice->categoryList, [
                        'class'  => 'form-control chosen-select',
                        'multiple' => 'true',
                        'data-placeholder' => Yii::t('app', 'Выберете категорию')
                    ]) ?>
                </div>
                <div class="col-md-12">
                    <h4 class="block-underline-bottom" style="font-weight: 300;">Адрес</h4>
                </div>
                <div class="col-md-12">
                    <?php
                    echo $form->field($modelTOffice, 'id_city')->dropDownList($modelTOffice->cityList, [
                        'class'  => 'form-control chosen-select',
                        'prompt' => Yii::t('app', 'Выберете город'),
                        //'encode'=>false
                    ])
                    ?>
                </div>
            </div>

            <?= $form->field($modelTOffice, 'street')->textInput(['placeholder' => Yii::t('app', 'Введите улицу')]) ?>

            <div class="row">
                <div class="col-xs-3">
                    <?= $form->field($modelTOffice, 'house')->textInput(['placeholder' => Yii::t('app', '---')])->error(false) ?>
                </div>
                <div class="col-xs-3">
                    <?= $form->field($modelTOffice, 'corp')->textInput(['placeholder' => Yii::t('app', '---')])->error(false) ?>
                </div>
                <div class="col-xs-3">
                    <?= $form->field($modelTOffice, 'level')->textInput(['placeholder' => Yii::t('app', '---')])->error(false) ?>
                </div>
                <div class="col-xs-3">
                    <?= $form->field($modelTOffice, 'num')->textInput(['placeholder' => Yii::t('app', '---')])->error(false) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p class="bold-font"><strong>Контакты</strong></p>
                </div>
                <div class="col-xs-11">
                    <?php
                    if(!$modelTOffice->isNewRecord) {
                        $modelTOffice->phone = $modelTOffice->getPnone($modelTOffice, 1);
                    }
                    ?>
                    <?= $form->field($modelTOffice, 'phone')->widget(MaskedInput::className(),[
                        'name' => 'phone',
                        'mask' => '7 (999) 999-9999',
                        'options' => [
                            'placeholder' => '7 (___) ___-____',
                            'class' => 'form-control'
                        ]]);
                    ?>
                </div>
                <div class="col-xs-1 col-xs-1-no-paddings">
                    <div id="phone-plus-circle-btn" class="fa fa-plus-circle fa-lg text-info plus-circle-btn" onclick="showNewField('#phone_2_field', '#phone-plus-circle-btn');"></div>
                </div>
                <?php
                if(!$modelTOffice->isNewRecord) {
                    $modelTOffice->phone2 = $modelTOffice->getPnone($modelTOffice, 2);
                }
                if ($modelTOffice->phone2) {
                    $display = 'block';
                } else {
                    $display = 'none';
                }
                ?>
                <div id="phone_2_field" style="display: <?= $display ?>">
                    <div class="col-xs-11">
                        <?= $form->field($modelTOffice, 'phone2')->widget(MaskedInput::className(),[
                            'name' => 'phone_2',
                            'mask' => '7 (999) 999-9999',
                            'options' => [
                                'id' => 'phone2_input',
                                'placeholder' => '7 (___) ___-____',
                                'class' => 'form-control'
                            ]])->label(false);
                        ?>
                    </div>
                    <div class="col-xs-1 col-xs-1-no-paddings">
                        <div id="phone-times-circle-btn"
                             class="fa fa-times-circle fa-lg text-danger times-circle-btn"
                             onclick="hideField('#phone_2_field', '#phone-plus-circle-btn', '#phone2_input');"></div>
                    </div>
                </div>

                <div class="col-xs-11">
                    <?php
                    if(!$modelTOffice->isNewRecord) {
                        $modelTOffice->email = $modelTOffice->getEmail($modelTOffice, 1);
                    }
                    ?>
                    <?= $form->field($modelTOffice, 'email'); ?>
                </div>
                <div class="col-xs-1 col-xs-1-no-paddings">
                    <div id="email-plus-circle-btn" class="fa fa-plus-circle fa-lg text-info plus-circle-btn" onclick="showNewField('#email_2_field', '#email-plus-circle-btn');"></div>
                </div>
                <?php
                if(!$modelTOffice->isNewRecord) {
                    $modelTOffice->email_2 = $modelTOffice->getEmail($modelTOffice, 2);
                }
                if ($modelTOffice->email_2) {
                    $display = 'block';
                } else {
                    $display = 'none';
                }
                ?>
                <div id="email_2_field" style="display: <?= $display ?>">
                    <div class="col-xs-11">
                        <?= $form->field($modelTOffice, 'email_2')->textInput(['id' => 'email_2_input'])->label(false); ?>
                    </div>
                    <div class="col-xs-1 col-xs-1-no-paddings">
                        <div class="fa fa-times-circle fa-lg text-danger times-circle-btn"
                             onclick="hideField('#email_2_field', '#email-plus-circle-btn', '#email_2_input');"></div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <?= $form->field($modelTOffice, 'web');
                    ?>
                </div>
            </div>

            <h4 class="block-underline-bottom" style="font-weight: 300;">Режим работы</h4>
            <div class="row">
                <div class='col-xs-12'>
                <?php
                if(!$modelTOffice->isNewRecord) {
                    $modelTOffice->daysOfWeek = $modelTOffice->getDaysOfWeekValue($modelTOffice);
                }
                echo $form->field($modelTOffice, 'daysOfWeek')->inline()->checkboxList($modelTOffice->getDaysList(),
                    [
                        'itemOptions' => [
                            'disabled' => false,
                            'divOptions' => [
                                'class' => 'checkbox checkbox-info',
                                'style' => 'margin-left: 10px; padding-left: 10px;padding-right: 5px;'
                            ],
                            'class' => 'checkbox-elem'
                        ],
                    ]);
                ?>
                    </div>

                    <div class='col-xs-12'>
                    <?php
                    if(!$modelTOffice->isNewRecord) {
                        $modelTOffice->workMode = $modelTOffice->getWorkMode($modelTOffice);
                    }

                    if($userAgentInfo->browser == 'Opera') {
                        if($userAgentInfo->version < 13) {
                            echo $form->field($modelTOffice, 'workMode')
                                ->inline(true)
                                ->radioList(['1' => 'Рабочий день', '2' => 'Круглосуточно'],
                                    [
                                        'item' => function($index, $label, $name, $checked, $value) {
                                            if($checked)
                                                $checked = 'checked';
                                            $return = '<div style="float: left; padding: 0 10px 0 10px;">';
                                            $return .= '<input id="radio-style-'.$value.'" type="radio" name="' . $name . '" value="'.$value.'" style="outline: none;" '.$checked.' onclick="radioWorkModeClick(this)">';
                                            $return .= '<label for="radio-style-'.$value.'">'.$label.'</label>';
                                            $return .= '</div>';
                                            return $return;
                                        }

                                        //'separator'=>false,
                                    ])->label(false);
                        }
                    } else {
                        echo $form->field($modelTOffice, 'workMode')
                            ->inline(true)
                            ->radioList(['1' => 'Рабочий день', '2' => 'Круглосуточно'],
                                [
                                    'item' => function($index, $label, $name, $checked, $value) {
                                        if($checked) {
                                            $checked = 'checked';
                                        }
                                        $return = '<div class="radio radio-info" style="margin: 0 10px 0 0; float: left;">';
                                        $return .= '<input id="radio-style-'.$value.'" type="radio" name="' . $name . '" value="'.$value.'" style="outline: none;" '.$checked.' onclick="radioWorkModeClick(this)">';
                                        $return .= '<label for="radio-style-'.$value.'">'.$label.'</label>';
                                        $return .= '</div>';
                                        return $return;
                                    }
                                ])->label(false);
                    }
                    ?>
                    </div>
            </div>

            <?php
            if($modelTOffice->workMode == 1) {
                $display = 'block';
            } else {
                $display = 'none';
            }
            ?>
            <div id="daysOfWeek-block" class="row" style="display: <?= $display ?>; margin-top: 30px;">
                <div class="col-sm-6">
                    <p class="block-underline-bottom">Начало рабочего дня</p>
                    <div class="input-group spinner">
                        <?php
                        $value = 10;
                        if(!$modelTOffice->isNewRecord) {
                            $value = $modelTOffice->getHourStartWorkWorkDay($modelTOffice);
                        }
                        ?>
                        <?= $form->field($modelTOffice, 'hours_start_workday')->textInput([
                            'id' => 'catalogform-hours-start',
                            'class' => 'form-control input-spinner-field',
                            'value' => $value,
                            'style' => 'height: 36px !important;',
                            'max' => 24
                        ])->label(false) ?>
                        <div class="input-group-btn-vertical" style="top: -8px;">
                            <button class="btn btn-info btn-hours-start" type="button"><i class="fa fa-caret-up"></i></button>
                            <button class="btn btn-info btn-hours-start" type="button"><i class="fa fa-caret-down"></i></button>
                        </div>
                        <?php
                        $value = 00;
                        if(!$modelTOffice->isNewRecord) {
                            $value = $modelTOffice->getMinutesStartWorkWorkDay($modelTOffice);
                        }
                        ?>
                        <?= $form->field($modelTOffice, 'minutes_start_workday')->textInput(
                            [
                                'id' => 'catalogform-minutes-start',
                                'class' => 'form-control input-spinner-field',
                                'value' => $value,
                                'max' => 60,
                                'style' => 'height: 36px !important; margin: 0 0 0 10px;',
                            ])
                            ->label(false)
                        ?>
                        <div class="input-group-btn-vertical" style="top: -8px;">
                            <button class="btn btn-info btn-minutes-start" type="button"><i class="fa fa-caret-up"></i></button>
                            <button class="btn btn-info btn-minutes-start" type="button"><i class="fa fa-caret-down"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <p class="block-underline-bottom">Конец рабочего дня</p>
                    <div class="input-group spinner">
                        <?php
                        $value = 18;
                        if(!$modelTOffice->isNewRecord) {
                            $value = $modelTOffice->getHourEndWorkWorkDay($modelTOffice);
                        }
                        ?>
                        <?= $form->field($modelTOffice, 'hours_end_workday')->textInput([
                            'id' => 'catalogform-hours-end',
                            'class' => 'form-control input-spinner-field',
                            'value' => $value,
                            'max' => 24,
                            'style' => 'height: 36px !important;',
                        ])->label(false) ?>
                        <div class="input-group-btn-vertical" style="top: -8px;">
                            <button class="btn btn-info btn-hours-end" type="button"><i class="fa fa-caret-up"></i></button>
                            <button class="btn btn-info btn-hours-end" type="button"><i class="fa fa-caret-down"></i></button>
                        </div>
                        <?php
                        $value = 00;
                        if(!$modelTOffice->isNewRecord) {
                            $value = $modelTOffice->getMinutesEndWorkWorkDay($modelTOffice);
                        }
                        ?>
                        <?= $form->field($modelTOffice, 'minutes_end_workday')->textInput(
                            [
                                'id' => 'catalogform-minutes-end',
                                'class' => 'form-control input-spinner-field',
                                'value' => $value,
                                'max' => 60,
                                'style' => 'height: 36px !important; margin: 0 0 0 10px;',
                            ])
                            ->label(false)
                        ?>
                        <div class="input-group-btn-vertical" style="top: -8px;">
                            <button class="btn btn-info btn-minutes-end" type="button"><i class="fa fa-caret-up"></i></button>
                            <button class="btn btn-info btn-minutes-end" type="button"><i class="fa fa-caret-down"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-xs-12">
                <p class="block-underline-bottom" style="padding-top: 15px;"></p>
            </div>
                <div class="col-xs-12">
            <?php
            $modelTOffice->timeout = 0;
            if(!$modelTOffice->isNewRecord) {
                $modelTOffice->timeout = $modelTOffice->getTimeout($modelTOffice);
            }
            echo $form->field($modelTOffice, 'timeout')
                ->checkboxList(['1' => 'Перерыв'],
                    [
                        'item' =>
                            function ($index, $label, $name, $checked, $value) {
                                return Html::checkbox($name, $checked, [
                                    'id' => 'checkbox-timeout',
                                    //'value' => $value,
                                    'label' => '<label for="' . $label . '">' . $label . '</label>',
                                    'labelOptions' => [
                                        'class' => 'checkbox checkbox-info',
                                    ],
                                    'onclick' => 'checkboxTimeoutClick();'
                                ]);
                            },
                        'separator'=>false,
                    ])->label(false);
            ?>
                </div>
            </div>

            <?php
            if(!$modelTOffice->isNewRecord) {
                if ($modelTOffice->timeout == 1) {
                    $display = 'block';
                } else {
                    $display = 'none';
                }
            }
            ?>
            <div class="row" id="catalog-timiout-block" style="display: <?= $display ?>; padding-bottom: 20px;">
                <div class="col-sm-6">
                    <p class="block-underline-bottom">Начало перерыва</p>
                    <div class="input-group spinner">
                        <?php
                        $value = 13;
                        if(!$modelTOffice->isNewRecord) {
                            $value = $modelTOffice->getHourStartTimeout($modelTOffice);
                            if(!$value) {
                                $value = '13';
                            }
                        }
                        ?>
                        <?= $form->field($modelTOffice, 'hours_start_timeout')->textInput([
                            'id' => 'catalogform-hours-start-timeout',
                            'class' => 'form-control input-spinner-field',
                            'value' => $value,
                            'max' => 24,
                            'style' => 'height: 36px !important;',
                        ])->label(false); ?>
                        <div class="input-group-btn-vertical" style="top: -8px;">
                            <button class="btn btn-info btn-hours-start-timeout" type="button"><i class="fa fa-caret-up"></i></button>
                            <button class="btn btn-info btn-hours-start-timeout" type="button"><i class="fa fa-caret-down"></i></button>
                        </div>
                        <?php
                        $value = 00;
                        if(!$modelTOffice->isNewRecord) {
                            $value = $modelTOffice->getMinutesStartTimeout($modelTOffice);
                            if(!$value) {
                                $value = '00';
                            }
                        }
                        ?>
                        <?= $form->field($modelTOffice, 'minutes_start_timeout')->textInput(
                            [
                                'id' => 'catalogform-minutes-start-timeout',
                                'class' => 'form-control input-spinner-field',
                                'value' => $value,
                                'max' => 60,
                                'style' => 'height: 36px !important; margin: 0 0 0 10px;',
                            ])
                            ->label(false);
                        ?>
                        <div class="input-group-btn-vertical" style="top: -8px;">
                            <button class="btn btn-info btn-minutes-start-timeout" type="button"><i class="fa fa-caret-up"></i></button>
                            <button class="btn btn-info btn-minutes-start-timeout" type="button"><i class="fa fa-caret-down"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <p class="block-underline-bottom">Конец перерыва</p>
                    <div class="input-group spinner">
                        <?php
                        $value = 14;
                        if(!$modelTOffice->isNewRecord) {
                            $value = $modelTOffice->getHourEndTimeout($modelTOffice);
                            if(!$value) {
                                $value = '14';
                            }
                        }
                        ?>
                        <?= $form->field($modelTOffice, 'hours_end_timeout')->textInput([
                            'id' => 'catalogform-hours-end-timeout',
                            'class' => 'form-control input-spinner-field',
                            'value' => $value,
                            'max' => 24,
                            'style' => 'height: 36px !important;',
                        ])->label(false); ?>
                        <div class="input-group-btn-vertical" style="top: -8px;">
                            <button class="btn btn-info btn-hours-end-timeout" type="button"><i class="fa fa-caret-up"></i></button>
                            <button class="btn btn-info btn-hours-end-timeout" type="button"><i class="fa fa-caret-down"></i></button>
                        </div>
                        <?php
                        $value = 00;
                        if(!$modelTOffice->isNewRecord) {
                            $value = $modelTOffice->getMinutesEndTimeout($modelTOffice);
                            if(!$value) {
                                $value = '00';
                            }
                        }
                        ?>
                        <?= $form->field($modelTOffice, 'minutes_end_timeout')->textInput(
                            [
                                'id' => 'catalogform-minutes-end-timeout',
                                'class' => 'form-control input-spinner-field',
                                'value' => $value,
                                'max' => 60,
                                'style' => 'height: 36px !important; margin: 0 0 0 10px;',
                            ])
                            ->label(false);
                        ?>
                        <div class="input-group-btn-vertical" style="top: -8px;">
                            <button class="btn btn-info btn-minutes-end-timeout" type="button"><i class="fa fa-caret-up"></i></button>
                            <button class="btn btn-info btn-minutes-end-timeout" type="button"><i class="fa fa-caret-down"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-11">
                    <?php
                    if(!$modelTOffice->isNewRecord) {
                        $modelTOffice->product = $modelTOffice->getProduct($modelTOffice->id_office, 1);
                    }
                    ?>
                    <?= $form->field($modelTOffice, 'product', ['inputOptions' => [
                        'class' => 'form-control form-control-tight',
                        'placeholder' => ''
                    ]]);
                    ?>
                </div>
                <?php
                $i = 2;
                ?>
                <div class="col-xs-1 col-xs-1-no-paddings">
                    <div id="product-plus-circle-btn"
                         class="fa fa-plus-circle fa-lg text-info plus-circle-btn"
                         style="padding: 32px 0 0 0 !important;"
                         onclick="showNewProductField('#product_<?= $i ?>_field', '#product-plus-circle-btn');">

                    </div>
                </div>
                <?php
                while($i < 8):
                    ?>
                    <?php
                    $product = 'product_'.$i;
                    if(!$modelTOffice->isNewRecord) {
                        $modelTOffice->$product = $modelTOffice->getProduct($modelTOffice->id_office, $i);
                        if ($modelTOffice->$product) {
                            $display = 'block';
                        } else {
                            $display = 'none';
                        }
                    }
                    ?>
                    <div id="product_<?= $i ?>_field" style="display: <?= $display ?>;">
                        <div class="col-xs-11">
                            <?= $form->field($modelTOffice, 'product_'.$i,
                                [
                                'inputOptions' => [
                                'class' => 'form-control form-control-tight',
                                'id' => 'product_'.$i.'_input',
                                'placeholder' => ''
                            ]])->label(false);
                            ?>
                        </div>
                        <div class="col-xs-1 col-xs-1-no-paddings">
                            <div class="fa fa-times-circle fa-lg text-danger times-circle-btn"
                                 style="padding: 7px 0 0 0 !important;"
                                 onclick="hideField('#product_<?= $i ?>_field', '#product-plus-circle-btn', '#product_<?= $i ?>_input');">
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                endwhile;
                ?>
            </div>

            <div class="row">
                <div class="col-xs-11">
                    <?php
                    if(!$modelTOffice->isNewRecord) {
                        $modelTOffice->service = $modelTOffice->getService($modelTOffice->id_office, 1);
                    }
                    ?>
                    <?= $form->field($modelTOffice, 'service', ['inputOptions' => [
                        'class' => 'form-control form-control-tight',
                        'placeholder' => ''
                    ]]);
                    ?>
                </div>
                <div class="col-xs-1 col-xs-1-no-paddings">
                    <div id="service-plus-circle-btn" class="fa fa-plus-circle fa-lg text-info plus-circle-btn" style="padding: 32px 0 0 0 !important;" onclick="showNewServiceField('#service_2_field', '#service-plus-circle-btn');"></div>
                </div>
                <?php
                $i = 2;
                while($i < 8):
                    ?>
                    <?php
                    $service = 'service_'.$i;
                    if(!$modelTOffice->isNewRecord) {
                        $modelTOffice->$service = $modelTOffice->getService($modelTOffice->id_office, $i);
                        if ($modelTOffice->$service) {
                            $display = 'block';
                        } else {
                            $display = 'none';
                        }
                    }
                    ?>
                    <div id="service_<?= $i ?>_field" style="display: <?= $display ?>;">
                        <div class="col-xs-11">
                            <?= $form->field($modelTOffice, 'service_'.$i,
                                [
                                    'inputOptions' => [
                                        'id' => 'service_'.$i.'_input',
                                        'class' => 'form-control form-control-tight',
                                        'placeholder' => ''
                                    ]
                                ])->label(false);
                            ?>
                        </div>
                        <div class="col-xs-1 col-xs-1-no-paddings">
                            <div class="fa fa-times-circle fa-lg text-danger times-circle-btn"
                                 style="padding: 7px 0 0 0 !important;"
                                 onclick="hideField('#service_<?= $i ?>_field', '#service-plus-circle-btn', '#service_<?= $i ?>_input');">
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                endwhile;
                ?>
            </div>

            <div class="row">
                <div class="col-xs-11">
                    <?php
                    if(!$modelTOffice->isNewRecord) {
                        $modelTOffice->sale = $modelTOffice->getSale($modelTOffice->id_office, 1);
                    }
                    ?>
                    <?= $form->field($modelTOffice, 'sale', ['inputOptions' => [
                        'class' => 'form-control form-control-tight',
                        'placeholder' => 'Скидка на все услуги 50%'
                    ]])->hint('Текст акции 1');
                    ?>
                </div>
                <div class="col-xs-1 col-xs-1-no-paddings">
                    <div id="sale-plus-circle-btn" class="fa fa-plus-circle fa-lg text-info plus-circle-btn" style="padding: 32px 0 0 0 !important;" onclick="showNewSaleField('#sale_2_field', '#sale-plus-circle-btn');"></div>
                </div>
                <div class="col-xs-6">
                    <?php
                    $modelTOffice->startSale = Yii::$app->formatter->asDate(time(), "php:d.m.Y");
                    if(!$modelTOffice->isNewRecord) {
                        $modelTOffice->startSale = Yii::$app->formatter->asDate($modelTOffice->getStartSale($modelTOffice->id_office, 1), "php:d.m.Y");
                    }
                    ?>
                    <?php
                    echo $form->field($modelTOffice, 'startSale')->widget(
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
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'format' => 'dd.mm.yyyy',
                            'autoclose' => true,
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-xs-6">
                    <?php
                    $modelTOffice->endSale = Yii::$app->formatter->asDate(time(), "php:d.m.Y");
                    if(!$modelTOffice->isNewRecord) {
                        $modelTOffice->endSale = Yii::$app->formatter->asDate($modelTOffice->getEndSale($modelTOffice->id_office, 1), "php:d.m.Y");
                    }
                    ?>
                    <?php
                    echo $form->field($modelTOffice, 'endSale')->widget(
                        DatePicker::classname(), [
                        'language' => 'ru',
                        'name' => 'endSale',
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
                            'todayHighlight' => true,
                            'todayBtn' => true,
                            'format' => 'dd.mm.yyyy',
                            'autoclose' => true,
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-xs-12">
                    <p class="block-underline-bottom" style="padding-top: 15px; margin-bottom: 20px"></p>
                </div>
                <?php
                $i = 2;
                while($i < 4):
                    ?>
                    <?php
                    $sale = 'sale_'.$i;
                    if(!$modelTOffice->isNewRecord) {
                        $modelTOffice->$sale = $modelTOffice->getSale($modelTOffice->id_office, $i);
                        if ($modelTOffice->$sale) {
                            $display = 'block';
                        } else {
                            $display = 'none';
                        }
                    }
                    ?>
                    <div id="sale_<?= $i ?>_field" style="display: <?= $display ?>;">
                        <div class="col-xs-11">
                            <?= $form->field($modelTOffice, 'sale_'.$i,
                                [
                                    'inputOptions' => [
                                        'id' => 'sale_'.$i.'_input',
                                        'class' => 'form-control form-control-tight',
                                        'placeholder' => 'Скидка на все услуги 50%'
                                    ]])->label(false)
                                ->hint('Текст акции '.$i);
                            ?>
                        </div>
                        <div class="col-xs-1 col-xs-1-no-paddings">
                            <div class="fa fa-times-circle fa-lg text-danger times-circle-btn"
                                 style="padding: 7px 0 0 0 !important;"
                                 onclick="hideField('#sale_<?= $i ?>_field', '#sale-plus-circle-btn', '#sale_<?= $i ?>_input');"></div>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            $startSale = 'startSale_'.$i;
                            if(!$modelTOffice->isNewRecord) {
                                $modelTOffice->$startSale = Yii::$app->formatter->asDate($modelTOffice->getStartSale($modelTOffice->id_office, $i), "php:d.m.Y");
                            }
                            if(!$modelTOffice->$startSale)
                                $modelTOffice->$startSale = Yii::$app->formatter->asDate(time(), "php:d.m.Y");
                            ?>
                            <?php
                            echo $form->field($modelTOffice, 'startSale_'.$i)->widget(
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
                                    'todayHighlight' => true,
                                    'todayBtn' => true,
                                    'format' => 'dd.mm.yyyy',
                                    'autoclose' => true,
                                ]
                            ]);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            $startSale = 'endSale_'.$i;
                            if(!$modelTOffice->isNewRecord) {
                                $modelTOffice->$startSale = Yii::$app->formatter->asDate($modelTOffice->getEndSale($modelTOffice->id_office, $i), "php:d.m.Y");
                            }
                            if(!$modelTOffice->$startSale)
                                $modelTOffice->$startSale = Yii::$app->formatter->asDate(time(), "php:d.m.Y");
                            ?>
                            <?php
                            echo $form->field($modelTOffice, 'endSale_'.$i)->widget(
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
                                    'todayHighlight' => true,
                                    'todayBtn' => true,
                                    'format' => 'dd.mm.yyyy',
                                    'autoclose' => true,
                                ]
                            ]);
                            ?>
                        </div>
                        <div class="col-xs-12">
                            <p class="block-underline-bottom" style="padding-top: 15px; margin-bottom: 20px"></p>
                        </div>
                    </div>
                    <?php
                    $i++;
                endwhile;
                ?>
            </div>
            <div class="row" style="padding-bottom: 30px;">
                <div class="col-md-12">
                    <div class="form-group text-center">
                        <?php
                        if(!$modelTOffice->isNewRecord) {
                            echo $form->field($modelTOffice, 'id_office')->hiddenInput()->label(false);
                        }
                            ?>
                        <?= Html::submitButton($modelTOffice->isNewRecord ? Yii::t('app', 'Добавить визитку') : Yii::t('app', 'Изменить визитку'), [
                            'class' => $modelTOffice->isNewRecord ? 'btn btn-success btn-success-md' : 'btn btn-primary btn-primary-md',
                        ]) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
<?php
$js=<<<JS
$("#pjax-container").on("pjax:complete", function() {
    $("#error-block").attr("tabindex",-1).focus();
})
JS;
$this->registerJS($js);
//Pjax::end();
?>