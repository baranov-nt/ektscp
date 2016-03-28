<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 24.03.2016
 * Time: 13:19
 */
/* @var $id string */
use yii\bootstrap\Html;
use yii\widgets\Pjax;
?>
<?php Pjax::begin(); ?>
<div class="col-md-12">
    <label>Дополнительные телефоны</label>
</div>
<?= Html::a("Добавить телефон", ['/users/profile/add-phone'], ['class' => 'btn btn-sm btn-success']) ?>
<?php Pjax::end(); ?>

<?/*= Html::button('добавить / редактировать',
    [
        'style' => 'margin: 0 !important;',
        'class' => 'btn btn-warning btn-sm',
        'onclick' => '
            $.pjax({
                type: "POST",
                url: "/users/profile/show-contact-form",
                data: {offset: $("body").scrollTop()},
                container: "#'.$id.'",
                push: false
            })'
    ]) */?>

