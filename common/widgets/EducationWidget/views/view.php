<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 05.10.2015
 * Time: 18:16
 */
/* @var $widget \common\widgets\EducationWidget\EducationWidget */
/* @var $modelEducationForm \common\widgets\EducationWidget\models\EducationForm */
/* @var $one \common\models\TPersonEdu */

use yii\bootstrap\Html;
use yii\helpers\Url;
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
<div class="col-md-12">
    <?php
    foreach ($modelEducationForm->schools as $one):
        ?>
        <?php
        if($widget->update == $one->id_edu):
            ?>
            <div style="border: 1px solid #cccccc; padding: 20px;">
                <?php $form = ActiveForm::begin([
                    'action' => Url::to(['/users/profile/update-education', 'id' => $one->id_edu]),
                    'options' => [
                        'data-pjax' => true,
                    ],
                    'fieldConfig' => [
                        'template' => "{input}",
                    ],
                    'fieldClass' => ActiveField::className(),
                ]); ?>
                <h3><?= $one->eduOrg->typeEdu->name ?></h3>
                <?php
                switch ($one->eduOrg->typeEdu->name) {
                    case 'Школа':
                        $labelName = 'Номер';
                        ?>
                        <?php
                        break;
                    case 'Лицей':
                        $labelName = 'Название/Номер';
                        ?>
                        <?php
                        break;
                    case 'ПТУ':
                        $labelName = 'Номер';
                        ?>
                        <?php
                        break;
                }
                $modelEducationForm->id_edu = $one->id_edu;
                $modelEducationForm->education = $one->eduOrg->typeEdu->id_ref;
                $modelEducationForm->educationName = $one->eduOrg->name;
                $modelEducationForm->city = $one->eduOrg->city;
                $modelEducationForm->faculty = $one->faculty;
                $modelEducationForm->cafedra = $one->cafedra;
                $modelEducationForm->speciality = $one->speciality;
                $modelEducationForm->status = $one->status;
                $modelEducationForm->startDate = $one->start_year;
                $modelEducationForm->endDate = $one->end_year;
                $modelEducationForm->scenario = $modelEducationForm->getScenarioName($one->eduOrg->typeEdu->name);
                ?>

                <?= $form->field($modelEducationForm, 'educationName', ['template'=>'{label}{input}'])->textInput(
                    [
                        'class' => 'form-control text-right',
                        'style' => 'font-size: 12px; height: 30px !important;'
                    ])->label($labelName) ?>
                <?= $form->field($modelEducationForm, 'city')->dropDownList($modelEducationForm->getEduCityList(),
                    [
                        'id' => 'select_city',
                        'class'  => 'form-control chosen-select text-right',
                    ]);
                ?>
                <?php
                if($modelEducationForm->scenario == 'addUniversity'
                ):
                    ?>
                    <?= $form->field($modelEducationForm, 'faculty', ['template'=>'{label}{input}'])->textInput(
                    [
                        'placeholder' => 'Введите факультет',
                        'form-control text-right',
                        'class' => 'form-control text-right',
                        'style' => 'font-size: 12px; height: 30px !important;'
                    ]) ?>
                    <?= $form->field($modelEducationForm, 'cafedra', ['template'=>'{label}{input}'])->textInput(
                    [
                        'placeholder' => 'Введите кафедру',
                        'form-control text-right',
                        'class' => 'form-control text-right',
                        'style' => 'font-size: 12px; height: 30px !important;'
                    ]) ?>
                    <?= $form->field($modelEducationForm, 'status', ['template'=>'{label}{input}'])->dropDownList($modelEducationForm->eduStatusList,
                    [
                        'id' => 'select_status',
                        'class'  => 'chosen-select text-right',
                    ]);
                    $script = <<< JS
                        $("document").ready(function(){
                            jQuery('#select_status').val('');
                            $('#select_status').trigger('chosen:updated');
                            $("#select_status_chosen span").text("Выберите статус");
                        });
JS;
                    $this->registerJs($script);
                    ?>
                    <?php
                endif;
                ?>
                <?php
                if($modelEducationForm->scenario == 'addSpecializedSchool'
                    || $modelEducationForm->scenario == 'addTechnicalCollege'
                    || $modelEducationForm->scenario == 'addCollege'
                    || $modelEducationForm->scenario == 'addUniversity'
                ):
                    ?>
                    <?= $form->field($modelEducationForm, 'speciality', ['template'=>'{label}{input}'])->textInput(
                    [
                        'placeholder' => 'Введите специальность',
                        'form-control text-right',
                        'class' => 'form-control text-right',
                        'style' => 'font-size: 12px; height: 30px !important;'
                    ]) ?>
                    <?php
                endif;
                ?>
                <div class="text-right" style="width: 50%; float: right;">
                    <label class="control-label">Период обучения</label>
                    <?= DatePicker::widget([
                        'model' => $modelEducationForm,
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
                        ],
                        'type' => DatePicker::TYPE_RANGE,
                        'form' => $form,
                        'pluginOptions' => [
                            'format' => 'yyyy',
                            'autoclose' => true,
                            'minViewMode' => 2,
                        ]
                    ]);
                    ?>
                </div>
                <div class="clearfix"></div>
                <?php
                //dd($modelEducationForm->education);
                ?>
                <?= Html::hiddenInput('scenario', $modelEducationForm->getScenarioName($one->eduOrg->typeEdu->name)) ?>
                <?= $form->field($modelEducationForm, 'education')->hiddenInput()->label(false) ?>
                <?= $form->field($modelEducationForm, 'id_edu')->hiddenInput()->label(false) ?>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-sm btn-success', 'title' => 'Сохранить']) ?>
                <?php ActiveForm::end(); ?>
            </div>
            <?php
        else:
            ?>
            <div class="row">
                <div class="col-md-12" style="padding: 10px 0 10px 0; border-bottom: 1px solid #eaeaea;">
                    <?= $one->eduOrg->typeEdu->name.': '.$one->eduOrg->name ?><br>
                    <?= 'Город : '.$one->eduOrg->city0->name ?><br>
                    <?php
                    if($one->faculty):
                        ?>
                        <?= 'Факультет: '.$one->faculty ?><br>
                        <?php
                    endif;
                    ?>
                    <?php
                    if($one->cafedra):
                        ?>
                        <?= 'Кафедра: '.$one->cafedra ?><br>
                        <?php
                    endif;
                    ?>
                    <?php
                    if($one->speciality):
                        ?>
                        <?= 'Специальность: '.$one->speciality ?><br>
                        <?php
                    endif;
                    ?>
                    <?php
                    if($one->status):
                        ?>
                        <?= 'Статус: '.$one->status0->name ?><br>
                        <?php
                    endif;
                    ?>
                    <?= 'Годы учебы: '.$one->start_year.' - '.$one->end_year ?><br>
                    <div style="margin: 20px 0 10px 0;">
                        <?= Html::a("Изменить", Url::to(['/users/profile/update-education', 'id' => $one->id_edu]),
                            [
                                'class' => 'btn btn-sm btn-primary',
                                'style' => 'margin: 0;',
                                'title' => 'Редактировать'
                            ]);?>
                        <?= Html::button('Удалить',
                            [
                                'class' => 'btn btn-sm btn-danger',
                                'style' => 'margin-left: 2px; float: rigth;',
                                'title' => 'Удалить',
                                'data-toggle' => 'modal',
                                'data-target' => '#deleteEducation-'.$one->id_edu
                            ])
                        ?>
                        <?= $this->render('_modal-confirm', ['one' => $one]); ?>
                    </div>
                </div>
            </div>
            <?php
        endif;
        ?>
        <?php
    endforeach;
    ?>
</div>
<div class="clearfix"></div>
<div style="margin-top: 30px;"></div>
<div class="col-md-4" style="margin-bottom: 20px;  ">
    <h5 style="padding-top: 0; margin-top: 0;"><?= $modelEducationForm->getAttributeLabel($widget->attribute) ?>:</h5>
</div>
<div class="col-md-8" style="margin-bottom: 20px;">

    <div class="row text-right">
        <?php
        if($widget->create == true):
            ?>
            <?php $form = ActiveForm::begin([
            'id' => 'educationCreateForm',
            'action' => Url::to(['/users/profile/create-'.$widget->attribute]),
            'options' => [
                'data-pjax' => true,
            ],
            'fieldConfig' => [
                'template' => "{input}",
            ],
        ]); ?>
            <?= $form->field($modelEducationForm, 'education')->dropDownList($modelEducationForm->eduTypeList,
            [
                'id' => 'select_type',
                'class'  => 'chosen-select text-right',
                'onchange' => '
                        $.pjax({
                            type: "POST",
                            url: "/users/profile/create-education",
                            data: jQuery("#educationCreateForm").serialize(),
                            container: "#userEducation",
                            push: false,
                            scrollTo: false
                        })
                        ',
                'value' => ''
            ]);
            ?>
            <?php
            if($modelEducationForm->education == ''):
                $script = <<< JS
                        $("document").ready(function(){
                            //document.getElementById('select_type').value = '';
                            jQuery('#select_type').val('');
                            $('#select_type').trigger('chosen:updated');
                            $("#select_type_chosen span").text("Тип образования");
                        });
JS;
                $this->registerJs($script);
            endif;
            switch ($modelEducationForm->scenario) {
                case 'addSchool':
                    $labelName = 'Номер';
                    ?>
                    <?php
                    break;
                case 'addLyceum':
                    $labelName = 'Название/Номер';
                    ?>
                    <?php
                    break;
                case 'addSpecializedSchool':
                    $labelName = 'Номер';
                    ?>
                    <?php
                    break;
            }
            ?>
            <?php
            //d($modelEducationForm->scenario);
            if($modelEducationForm->scenario != 'default'):
                ?>
                <?= $form->field($modelEducationForm, 'educationName', ['template'=>'{label}{input}'])->textInput(
                [
                    'class' => 'form-control text-right',
                    'style' => 'font-size: 12px; height: 30px !important;'
                ])->label($labelName) ?>
                <?= $form->field($modelEducationForm, 'city')->dropDownList($modelEducationForm->getEduCityList(),
                [
                    'id' => 'select_city',
                    'class'  => 'form-control chosen-select text-right',
                ]);
                $placeholder = Yii::t('app', 'Город');
                $script = <<< JS
                        $("document").ready(function(){
                            jQuery('#select_city').val('');
                            $('#select_city').trigger('chosen:updated');
                            $("#select_city_chosen span").text("Город");
                        });
JS;
                $this->registerJs($script);
                ?>
                <?php
                if($modelEducationForm->scenario == 'addUniversity'
                ):
                    ?>
                    <?= $form->field($modelEducationForm, 'faculty', ['template'=>'{label}{input}'])->textInput(
                    [
                        'placeholder' => 'Введите факультет',
                        'form-control text-right',
                        'class' => 'form-control text-right',
                        'style' => 'font-size: 12px; height: 30px !important;'
                    ]) ?>
                    <?= $form->field($modelEducationForm, 'cafedra', ['template'=>'{label}{input}'])->textInput(
                    [
                        'placeholder' => 'Введите кафедру',
                        'form-control text-right',
                        'class' => 'form-control text-right',
                        'style' => 'font-size: 12px; height: 30px !important;'
                    ]) ?>
                    <?= $form->field($modelEducationForm, 'status', ['template'=>'{label}{input}'])->dropDownList($modelEducationForm->eduStatusList,
                    [
                        'id' => 'select_status',
                        'class'  => 'chosen-select text-right',
                    ]);
                    $script = <<< JS
                        $("document").ready(function(){
                            jQuery('#select_status').val('');
                            $('#select_status').trigger('chosen:updated');
                            $("#select_status_chosen span").text("Выберите статус");
                        });
JS;
                    $this->registerJs($script);
                    ?>
                    <?php
                endif;
                ?>
                <?php
                if($modelEducationForm->scenario == 'addSpecializedSchool'
                    || $modelEducationForm->scenario == 'addTechnicalCollege'
                    || $modelEducationForm->scenario == 'addCollege'
                    || $modelEducationForm->scenario == 'addUniversity'
                ):
                    ?>
                    <?= $form->field($modelEducationForm, 'speciality', ['template'=>'{label}{input}'])->textInput(
                    [
                        'placeholder' => 'Введите специальность',
                        'form-control text-right',
                        'class' => 'form-control text-right',
                        'style' => 'font-size: 12px; height: 30px !important;'
                    ]) ?>
                    <?php
                endif;
                ?>
                <div class="text-right" style="width: 50%; float: right;">
                    <label class="control-label">Период обучения</label>
                    <?php
                    $modelEducationForm->startDate = '1985';
                    $modelEducationForm->endDate = '1990';
                    ?>
                    <?= DatePicker::widget([
                        'model' => $modelEducationForm,
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
                        ],
                        'type' => DatePicker::TYPE_RANGE,
                        'form' => $form,
                        'pluginOptions' => [
                            'format' => 'yyyy',
                            'autoclose' => true,
                            'minViewMode' => 2,
                        ]
                    ]);
                    ?>
                </div>
                <div class="clearfix"></div>
                <?= Html::hiddenInput('scenario', $modelEducationForm->scenario) ?>
                <div class="text-left" style="padding: 10px;">
                    <?= Html::submitButton("Добавить",
                        [
                            'class' => 'btn btn-sm btn-success',
                            'title' => 'Сохранить'
                        ]) ?>
                </div>
                <?php
            endif;
            ?>
            <?= Html::submitButton("",
            [
                'id' => 'submitEducationButton',
                'class' => 'btn btn-sm btn-success',
                'style' => 'display: none',
            ]) ?>
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
