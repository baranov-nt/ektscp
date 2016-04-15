<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\TOfficeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carousel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => true,
            'class' => 'form-inline'
        ]
    ]); ?>

    <?= $form->field($model, 'category')->dropDownList($model->categoryList, [
        'class'  => 'form-control chosen-select',
        'prompt' => Yii::t('app', 'Все категории')
    ])->label(false) ?>
    <?= $form->field($model, 'title')->textInput([
        'style' => 'height: 25px !important;',
        'placeholder' => Yii::t('app', 'Что ищем?')
    ])->label(false) ?>
    <?= $form->field($model, 'id_city')->dropDownList($model->getCityList(), [
        'class'  => 'form-control chosen-select chosen-inline',
        'style' => 'height: 40px !important;',
        'prompt' => Yii::t('app', 'Все города')
    ])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search" style=""></span>', ['class' => 'btn btn-primary btn-primary-sm', 'style' => 'margin-bottom: 10px; height: 25px !important;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
