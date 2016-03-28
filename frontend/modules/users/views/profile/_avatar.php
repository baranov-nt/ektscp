<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 21.03.2016
 * Time: 18:43
 */

/* @var $this yii\web\View */
/* @var $modelTPerson \common\models\TPerson */
use yii\bootstrap\Html;
use common\widgets\FontAwesome\AssetBundle;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use frontend\components\widgets\WidgetUpload;

AssetBundle::register($this);
Pjax::widget();
?>
<?php
$form = ActiveForm::begin([
        'options' => ['data-pjax' => true, 'enctype' => 'multipart/form-data', 'id' => 'image-form'],
    ]
);
?>
<?php
$js=<<<JS
$("#avatarImage").on("pjax:complete", function() {
    $("#upload_image").attr("tabindex",-1).focus();
 });
JS;
$this->registerJS($js);
?>
<?= \common\widgets\AlertIGrowl::widget() ?>
<?php
if($modelTPerson->id_photo) {
    $display = 'block';
} else {
    $display = 'none';
}
?>
<?= Html::img([$modelTPerson->mainImg->path], [
    'id' => 'id_file',
    'style' => 'width: 100%; display: '.$display.';',
    'onload' => '
        if("'.$modelTPerson->mainImg->path.'" != $(this).attr("src")) {
            $.pjax({
                type: "POST",
                url: "update-image",
                data: jQuery("#image-form").serialize(),
                container: "#avatarImage",
                push: false
            })
        }'
]) ?>
<?= $form->field($modelTPerson, 'file')->hiddenInput([
    'name' => 'old_file',

])->label(false) ?>
<?php
if(!$modelTPerson->id_photo):
    ?>
    <?= Html::button('Добавить изображение',
    [
        'class' => 'btn btn-success btn-success-sm',
        'id' => 'upload_image',
    ]) ?>
    <?php
else:
    ?>
    <?= Html::button('Изменить изображение',
    [
        'class' => 'btn btn-primary btn-primary-sm',
        'id' => 'upload_image',
        ]) ?>
    <?php
endif;
?>

<?= WidgetUpload::widget([
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
<?php ActiveForm::end(); ?>

