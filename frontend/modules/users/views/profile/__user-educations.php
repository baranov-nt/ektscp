<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.03.2016
 * Time: 11:15
 */
/* @var $createEducation bool */

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
            'model' => $model
            /*'attribute' => 'phone',
            'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Phone'),
            'attributesList' => 'phonesList',
            'attributesMax' => Yii::$app->params['maxPhones'],
            'create' => $createPhone*/
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
            /*'attribute' => 'phone',
            'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Phone'),
            'attributesList' => 'phonesList',
            'attributesMax' => Yii::$app->params['maxPhones'],
            'create' => $createPhone*/
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
        /*'attribute' => 'phone',
        'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Phone'),
        'attributesList' => 'phonesList',
        'attributesMax' => Yii::$app->params['maxPhones'],
        'update' => $updatePhone*/
    ]); ?>
    <?php
else:
    ?>
    <?= EducationWidget::widget(
    [
        'attribute' => 'education',
        'attributesMax' => Yii::$app->params['maxEducations'],
        /*'attribute' => 'phone',
        'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Phone'),
        'attributesList' => 'phonesList',
        'attributesMax' => Yii::$app->params['maxPhones'],*/
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
            });
            $("#userEducation").on('pjax:complete', function() {
                $('#loadingEducation').hide();
                $("#userEducation .btn").attr('disabled', false);
            });
        });
JS;
$this->registerJs($script);
?>