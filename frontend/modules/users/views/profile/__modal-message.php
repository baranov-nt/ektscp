<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 23.03.2016
 * Time: 14:34
 */
use yii\bootstrap\Html;

$this->title = 'Cообщение';
?>
<p><?= Html::encode($this->title) ?></p>
<div class="form-group">
    <?= Html::textInput('text', '', ['class' => 'form-control', 'style' => 'width: 100%']); ?>
</div>
<?= Html::button('Отправить сообщение', ['class' => 'btn btn-success', 'data-dismiss' => 'modal']); ?>

