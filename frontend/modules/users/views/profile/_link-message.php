<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 23.03.2016
 * Time: 14:28
 */
use yii\bootstrap\Html;
?>
<?= Html::button(
    '<i class="fa fa-envelope-o" style="font-size: 36px;"></i>',
    [
        'class' => 'btn btn-primary',
        'onclick' => '
            $.pjax({
                type: "POST",
                url: "/profile/message",
                container: "#profileData1",
                push: false
            })',
        'style' => 'margin-left: 10px;'
    ]); ?>


