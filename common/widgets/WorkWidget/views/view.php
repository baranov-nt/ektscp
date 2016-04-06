<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 05.10.2015
 * Time: 18:16
 */
/* @var $widget \common\widgets\WorkWidget\WorkWidget */
/* @var $modelWorkForm \common\widgets\WorkWidget\models\WorkForm */
/* @var $one \common\models\TPersonWork */



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
$modelWorkForm = $widget->modelWorkForm;
?>
<?= \common\widgets\AlertIGrowl::widget() ?>
<div class="col-md-12">
    <?php
    foreach ($modelWorkForm->works as $one):
        ?>
        <?php
        if($widget->update == $one->id_work):
            ?>
            <div style="border: 1px solid #cccccc; padding: 20px;">
                <?php $form = ActiveForm::begin([
                    'action' => Url::to(['/users/profile/update-work', 'id' => $one->id_work]),
                    'options' => [
                        'data-pjax' => true,
                    ],
                    'fieldConfig' => [
                        'template' => "{input}",
                    ],
                    'fieldClass' => ActiveField::className(),
                ]); ?>
                <?php
                $modelWorkForm->id_work = $one->id_work;
                $modelWorkForm->city = $one->city;
                $modelWorkForm->org = $one->org;
                $modelWorkForm->post = $one->post;
                $modelWorkForm->startDate = $one->start_year;
                $modelWorkForm->endDate = $one->end_year;
                ?>
                <?= $form->field($modelWorkForm, 'city')->dropDownList($modelWorkForm->getWorkCityList(),
                    [
                        'id' => 'select_city',
                        'class'  => 'form-control chosen-select text-right',
                    ]);
                ?>
                <?= $form->field($modelWorkForm, 'org', ['template'=>'{label}{input}'])->textInput(
                    [
                        'class' => 'form-control text-right',
                        'style' => 'font-size: 12px; height: 30px !important;'
                    ]) ?>
                <?= $form->field($modelWorkForm, 'post', ['template'=>'{label}{input}'])->textInput(
                    [
                        'class' => 'form-control text-right',
                        'style' => 'font-size: 12px; height: 30px !important;'
                    ]) ?>
                <div class="text-right" style="width: 50%; float: right;">
                    <label class="control-label">Период работы</label>
                    <?= DatePicker::widget([
                        'model' => $modelWorkForm,
                        'language' => 'ru',
                        'attribute' => 'startDate',
                        'attribute2' => 'endDate',
                        'separator' => ' - ',
                        'options' => [
                            'placeholder' => 'Дата поступления',
                        ],
                        'options2' => [
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
                <?= $form->field($modelWorkForm, 'id_work')->hiddenInput()->label(false) ?>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-sm btn-success', 'title' => 'Сохранить']) ?>
                <?php ActiveForm::end(); ?>
            </div>
            <?php
        else:
            ?>
            <div class="row">
                <div class="col-md-12" style="padding: 10px 0 10px 0; border-bottom: 1px solid #eaeaea;">
                    <?= 'Организация: '.$one->org ?><br>
                    <?= 'Город : '.$one->city0->name ?><br>
                    <?= 'Должность : '.$one->post ?><br>
                    <?= 'Годы работы: '.$one->start_year.' - '.$one->end_year ?><br>
                    <div style="margin: 20px 0 10px 0;">
                        <?= Html::a("Изменить", Url::to(['/users/profile/update-work', 'id' => $one->id_work]),
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
                                'data-target' => '#deleteWork-'.$one->id_work
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
    <h5 style="padding-top: 0; margin-top: 0;"><?= $modelWorkForm->getAttributeLabel($widget->attribute) ?>:</h5>
</div>
<div class="col-md-8" style="margin-bottom: 20px;">
    <div class="row text-right">
        <?php
        if($widget->create == true):
            ?>
            <?php $form = ActiveForm::begin([
            'id' => 'workCreateForm',
            'action' => Url::to(['/users/profile/create-work']),
            'options' => [
                'data-pjax' => true,
            ],
            'fieldConfig' => [
                'template' => "{input}",
            ],
        ]); ?>
            <?= $form->field($modelWorkForm, 'city')->dropDownList($modelWorkForm->getWorkCityList(),
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
            <?= $form->field($modelWorkForm, 'org', ['template'=>'{label}{input}'])->textInput(
            [
                'class' => 'form-control text-right',
                'style' => 'font-size: 12px; height: 30px !important;'
            ]) ?>
            <?= $form->field($modelWorkForm, 'post', ['template'=>'{label}{input}'])->textInput(
            [
                'class' => 'form-control text-right',
                'style' => 'font-size: 12px; height: 30px !important;'
            ]) ?>
            <div class="text-right" style="width: 50%; float: right;">
                <label class="control-label">Период работы</label>
                <?php
                $modelWorkForm->startDate = '2000';
                $modelWorkForm->endDate = '2016';
                ?>
                <?= DatePicker::widget([
                    'model' => $modelWorkForm,
                    'language' => 'ru',
                    'attribute' => 'startDate',
                    'attribute2' => 'endDate',
                    'separator' => ' - ',
                    'options' => [
                        'placeholder' => 'Дата поступления',
                    ],
                    'options2' => [
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
            <div class="text-left" style="padding: 10px;">
                <?= Html::submitButton("Добавить",
                    [
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
            ?>
            <div class="col-xs-8 text-right" style="font-size: 12px; padding-top: 5px; padding-right: 30px;">

            </div>
            <div class="col-xs-4 text-right"  style="padding: 0;">
                <?= Html::a("<span class='glyphicon glyphicon-plus'></span>", Url::to(['/users/profile/create-work']),
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
        ?>
    </div>
</div>
