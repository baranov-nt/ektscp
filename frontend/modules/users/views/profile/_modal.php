<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 23.03.2016
 * Time: 13:38
 */
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php
Pjax::begin([
    'id' => 'contact-buttons',
    'timeout' => 9000,
    'enablePushState' => false,
    'options' => [
        'class' => 'col-xs-12'
    ]
]);
?>
<?= Html::a('<span class="glyphicon glyphicon-phone-alt"></span>', Url::to(['/users/profile/call']),
    [
        'class' => 'btn btn-primary'
    ]);
?>
<?= Html::a('<span class="glyphicon glyphicon-envelope"></span>', Url::to(['/users/profile/message']),
    [
        'class' => 'btn btn-primary',
        'style' => 'margin-left: 5px;'
    ]);
?>
<?= Html::a('<span class="glyphicon glyphicon-paperclip"></span>', Url::to(['/users/profile/favorite']),
    [
        'class' => 'btn btn-primary',
        'style' => 'margin-left: 5px;'
    ]);
?>
<?php
if(isset($modal)):
    ?>
    <?= $this->render('__open-modal'); ?>
    <?php
endif;
?>
<?php Pjax::end(); ?>


