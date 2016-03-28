<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 23.03.2016
 * Time: 13:38
 */
use yii\bootstrap\Modal;
?>
<?php
switch (Yii::$app->controller->action->id) {
    case 'call':
        $modalSize = 'modal-lg';
        break;
    case 'message':
        $modalSize = 'modal-lg';
        break;
    case 'favorite':
        $modalSize = 'modal-sm';
        break;
}
?>
<?= $this->render('_link-call'); ?>
<?= $this->render('_link-message'); ?>
<?= $this->render('_link-favorite'); ?>
<?php
$js=<<<JS
        $("#profileModal").modal("show");
JS;
$this->registerJS($js);
Modal::begin([
    'size' => $modalSize,
    'id' => 'profileModal',
    'header' => '<h1 class="text-center">'.$header.'</h1>',
    'toggleButton' => false
]);
?>
        <?php
        switch (Yii::$app->controller->action->id) {
            case 'call':
                echo $this->render('__modal-call');
                break;
            case 'message':
                echo $this->render('__modal-message');
                break;
            case 'favorite':
                echo $this->render('__modal-favorite');
                break;
        }
        ?>
<?php
Modal::end();

