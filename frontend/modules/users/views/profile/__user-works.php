<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.04.2016
 * Time: 10:24
 */
/* @var $createWork bool */
/* @var $modelWorkForm \common\widgets\WorkWidget\models\WorkForm */

use yii\widgets\Pjax;
use common\widgets\WorkWidget\WorkWidget;
?>
<?php Pjax::begin([
    'id' => 'userWork',
    'enablePushState' => false,
    'timeout' => 9000
]); ?>
<?php
if(isset($createWork)):
    ?>
        <?= WorkWidget::widget(
        [
            'attribute' => 'work',
            'attributesMax' => Yii::$app->params['maxWorks'],
            'create' => $createWork,
        ]);
        ?>
    <?php
elseif(isset($updateWork)):
    ?>
    <?= WorkWidget::widget(
    [
        'attribute' => 'work',
        'attributesMax' => Yii::$app->params['maxWorks'],
        'update' => $updateWork,
    ]); ?>
    <?php
else:
    ?>
    <?= WorkWidget::widget(
    [
        'attribute' => 'work',
        'attributesMax' => Yii::$app->params['maxWorks'],
    ]); ?>
    <?php
endif;
?>
<?php Pjax::end(); ?>
<?php
$script = <<< JS
        $("document").ready(function(){
            $("#userWork").on('pjax:send', function() {
                $('#loadingWork').show();
                $("#userWork .btn").attr('disabled', true);
                $(".modal").modal("hide");
            });
            $("#userWork").on('pjax:complete', function() {
                $('#loadingWork').hide();
                $("#userWork .btn").attr('disabled', false);
            });
        });
JS;
$this->registerJs($script);
?>