<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 23.03.2016
 * Time: 14:00
 */
use yii\bootstrap\Html;
?>
<?= Html::button(
    '<i class="fa fa-phone-square" style="font-size: 36px;"></i>',
    [
        'class' => 'btn btn-primary',
        'onclick' => '
            $.pjax({
                type: "POST",
                url: "/profile/call",
                container: "#profileData1",
                push: false
            })',
]); ?>
