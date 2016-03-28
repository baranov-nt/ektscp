<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 23.03.2016
 * Time: 15:37
 */
use yii\bootstrap\Html;

$this->title = 'Добавить в избранное';
?>
<div class="row">
    <div class="col-xs-6 text-center">
        <?= Html::button('Да',
            [
                'class' => 'btn btn-success',
                'data-dismiss' => 'modal'
            ]) ?>
    </div>
    <div class="col-xs-6 text-center">
        <?= Html::button('Heт',
            [
                'class' => 'btn btn-danger',
                'data-dismiss' => 'modal'
            ]) ?>
    </div>
</div>
