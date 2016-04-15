<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.04.2016
 * Time: 13:51
 */
/* @var $modelCompanyForm frontend\modules\bussness\models\CompanyForm */
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\Url;
?>
<?php
Modal::begin([
    'id' => 'createCompanyModal',
    'header' => '<h3 class="text-center">Добавить компанию</h3>',
]);
?>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['/bussness/manage/create'])
]); ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($modelCompanyForm, 'name') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($modelCompanyForm, 'phone')->widget(MaskedInput::className(),[
            'name' => 'phone',
            'mask' => '7 (999) 999-9999',
            'options' => [
                'placeholder' => '7 (___) ___-____',
                'class' => 'form-control'
            ]]);
        ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($modelCompanyForm, 'desc')->textarea(['rows' => '10', 'cols' => '45', 'style' => 'height: 60px !important;']) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($modelCompanyForm, 'categories')->dropDownList($modelCompanyForm->getCategoryList(),
            [
                'class'  => 'chosen-select',
                'multiple' => 'true',
                'data-placeholder' => Yii::t('app', 'Категории')
            ]);
        ?>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
        <?= $form->field($modelCompanyForm, 'city')->dropDownList($modelCompanyForm->cityList,
            [
                'id' => 'select_city',
                'class'  => 'chosen-select',
                'style' => 'width: 100%'
            ]);
        $script = <<< JS
                        $("document").ready(function(){
                            jQuery('#select_city').val('');
                            $('#select_city').trigger('chosen:updated');
                            $("#select_city_chosen span").text("Выберите город");
                        });
JS;
        $this->registerJs($script);
        ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($modelCompanyForm, 'street') ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($modelCompanyForm, 'house')->error(false) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($modelCompanyForm, 'housing') ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($modelCompanyForm, 'office') ?>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php $form = ActiveForm::end(); ?>
</div>
<?php
Modal::end();
?>
