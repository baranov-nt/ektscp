<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.03.2016
 * Time: 11:15
 */
/* @var $createEducation bool */
/* @var $modelEducationForm \common\widgets\EducationWidget\models\EducationForm */

use yii\widgets\Pjax;
use common\widgets\EducationWidget\EducationWidget;
?>
<?php Pjax::begin([
    'id' => 'userEducation',
    'enablePushState' => false,
    'timeout' => 9000
]); ?>
<?php
if(isset($createEducation)):
    if(isset($model)):
        ?>
        <?= EducationWidget::widget(
        [
            'attribute' => 'education',
            'attributesMax' => Yii::$app->params['maxEducations'],
            'create' => $createEducation,
            'modelEducationForm' => $model
        ]);
        ?>
        <?php
    else:
        ?>
        <?= EducationWidget::widget(
        [
            'attribute' => 'education',
            'attributesMax' => Yii::$app->params['maxEducations'],
            'create' => $createEducation,
        ]);
        ?>
        <?php
    endif;
    ?>
    <?php
elseif(isset($updateEducation)):
    ?>
    <?= EducationWidget::widget(
    [
        'attribute' => 'education',
        'attributesMax' => Yii::$app->params['maxEducations'],
        'update' => $updateEducation,
    ]); ?>
    <?php
else:
    ?>
    <?= EducationWidget::widget(
    [
        'attribute' => 'education',
        'attributesMax' => Yii::$app->params['maxEducations'],
    ]); ?>
    <?php
endif;
?>
<?php Pjax::end(); ?>
<?php
$script = <<< JS
        $("document").ready(function(){
            $("#userEducation").on('pjax:send', function() {
                $('#loadingEducation').show();
                $("#userEducation .btn").attr('disabled', true);
                $(".modal").modal("hide");
            });
            $("#userEducation").on('pjax:complete', function() {
                $('#loadingEducation').hide();
                $("#userEducation .btn").attr('disabled', false);
            });
        });
JS;
$this->registerJs($script);
?>