<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 23.03.2016
 * Time: 15:35
 */
use yii\bootstrap\Html;
?>
<?= Html::button(
    '<i class="fa fa-plus-square" style="font-size: 36px;"></i>',
    [
        'class' => 'btn btn-primary',
        'onclick' => '
            $.pjax({
                type: "POST",
                url: "/profile/favorite",
                container: "#profileData1",
                push: false
            })',
        'style' => 'margin-left: 10px;'
    ]); ?>
