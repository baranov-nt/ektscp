<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.04.2016
 * Time: 18:22
 */
/* @var $one \common\models\TPersonWork */
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>
<?php
Modal::begin([
    'id' => 'deleteWork-'.$one->id_work,
    'size' => 'modal-md',
    'header' => '<h4 class="text-center">Вы уверены, что хотите удалить работу?</h4>',
]);
?>
<?= 'Организация: '.$one->org ?><br>
<?= 'Город : '.$one->city0->name ?><br>
<?= 'Должность : '.$one->post ?><br>
<?= 'Годы работы: '.$one->start_year.' - '.$one->end_year ?><br>
<div class="text-center" style="margin-top: 30px;">
    <?= Html::a("Да", Url::to(['/users/profile/delete-work', 'id' => $one->id_work]),
        [
            'class' => 'btn btn-sm btn-danger',
            'style' => 'margin-left: 2px; float: rigth;',
            'title' => 'Удалить',
        ]);?>
    <?= Html::button("Нет",
        [
            'class' => 'btn btn-sm btn-success',
            'style' => 'margin-left: 2px; float: rigth;',
            'title' => 'Нет',
            'data-dismiss' => 'close',
            'aria-hidden' => true
        ]);?>
</div>

<?php
Modal::end();
?>
