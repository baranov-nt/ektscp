<?
use yii\bootstrap\Modal;
?>
<?php
$js=<<<JS
    $("#oknoModal").modal("show");
JS;
$this->registerJS($js);
Modal::begin([
    'id' => 'oknoModal',
    'header' => '<h1 class="text-center">Свой шаблон</h1>',
    'toggleButton' => false
]);
?>
Контент
<?php
Modal::end();