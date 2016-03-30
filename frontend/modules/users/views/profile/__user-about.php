<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.03.2016
 * Time: 11:14
 */
use yii\widgets\Pjax;
use common\widgets\DataFieldsList\AttributesList;
?>
<?php Pjax::begin([
    'id' => 'userAbouts',
    'enablePushState' => false,
    'timeout' => 9000
]); ?>
<?php
if(isset($createBirthdate)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'birthdate',
        'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Birthdate'),
        'attributesList' => 'birthdate',
        'attributesMax' => 1,
        'actionCreate' => '/users/profile/create-birthdate',
        'actionUpdate' => '/users/profile/update-birthdate',
        'actionDelete' => '/users/profile/delete-birthdate',
        'create' => $createBirthdate
    ]); ?>
    <?php
elseif(isset($updateBirthdate)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'birthdate',
        'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Birthdate'),
        'attributesList' => 'birthdate',
        'attributesMax' => 1,
        'actionCreate' => '/users/profile/create-birthdate',
        'actionUpdate' => '/users/profile/update-birthdate',
        'actionDelete' => '/users/profile/delete-birthdate',
        'update' => $updateBirthdate
    ]); ?>
    <?php
else:
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'birthdate',
        'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Birthdate'),
        'attributesList' => 'birthdate',
        'attributesMax' => 1,
        'actionCreate' => '/users/profile/create-birthdate',
        'actionUpdate' => '/users/profile/update-birthdate',
        'actionDelete' => '/users/profile/delete-birthdate',
    ]); ?>
    <?php
endif;
?>
<?php Pjax::end(); ?>
<?php
$script = <<< JS
        $("document").ready(function(){
            $("#userAbouts").on('pjax:send', function() {
                $('#loadingAbouts').show();
                $("#userAbouts .btn").attr('disabled', true);
            });
            $("#userAbouts").on('pjax:complete', function() {
                $('#loadingAbouts').hide();
                $("#userAbouts .btn").attr('disabled', false);
            });
        });
JS;
$this->registerJs($script);
?>


