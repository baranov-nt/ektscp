<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.04.2016
 * Time: 18:22
 */
/* @var $one \common\models\TPersonEdu */
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>
<?php
Modal::begin([
    'id' => 'deleteEducation-'.$one->id_edu,
    'size' => 'modal-md',
    'header' => '<h4 class="text-center">Вы уверены, что хотите удалить образование?</h4>',
]);
?>
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
<div class="text-center" style="margin-top: 30px;">
    <?= Html::a("Да", Url::to(['/users/profile/delete-education', 'id' => $one->id_edu]),
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
