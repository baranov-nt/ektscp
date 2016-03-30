<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.03.2016
 * Time: 11:24
 */
use yii\bootstrap\Modal;

switch (Yii::$app->controller->action->id) {
    case 'call':
        $modalSize = 'modal-lg';
        $header = 'Форма для звонка';
        break;
    case 'message':
        $modalSize = 'modal-lg';
        $header = 'Отправить сообщение';
        break;
    case 'favorite':
        $modalSize = 'modal-sm';
        $header = 'Подписаться';
        break;
}
?>
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