<?
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\tabs\TabsX;
use common\widgets\ColorPicker\AssetColorPicker;

AssetColorPicker::register($this);
?>
<?php
$js=<<<JS
    $("#oknoModal").modal("show");
    $('#cp1').colorpicker().on('changeColor', function(e) {
        $('#headTemplate')[0].style.color = e.color.toHex();
    });
JS;
$this->registerJS($js);
Modal::begin([
    'id' => 'oknoModal',
    'header' => '<h1 class="text-center">Свой шаблон</h1>',
    'toggleButton' => false
]);
?>
<div style="margin: 0 auto;width: 400px;height: 200px;border: 1px solid grey;">
    <p id="headTemplate">Заголовок</p>
    <p id="textTemplate">Описание</p>
</div>
<div style="margin: 0 auto;margin-top: 15px;width: 330px;text-align: left;">
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="#">Заголовок</a></li>
        <li><a href="#">Описание</a></li>
        <li><a href="#">Изображение</a></li>
        <li><a href="#">Подпись</a></li>
    </ul>
    <input type="text" class="form-control" name="TAdv[headTemplate]" id="iHeadTemplate" onkeyup="$('#headTemplate').text($(this).val());" placeholder="Введите заголовок"/>
    <div id="cp1" style="margin-top: 15px;" class="input-group colorpicker-component">
        <input type="text" class="form-control" placeholder="Выберите цвет заголовка" />
        <span class="input-group-addon"><i></i></span>
    </div>
    <?= Html::textArea('TAdv[textTemplate]', null, [
        'id' => 'iTextTemplate',
        'onkeyup' => '$("#textTemplate").text($(this).val());',
        'class' => 'form-control',
        'style' => 'width: 330px;min-height: 150px;margin-top: 15px;',
        'placeholder' => Yii::t('app', 'Введите текст')
    ]); ?>
</div>
<?php
Modal::end();