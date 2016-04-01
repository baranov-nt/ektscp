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
/* @var $user \common\models\Users */
$user = Yii::$app->user->identity;

if(isset($createBirthdate)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'birthdate',
        'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Birthdate'),
        'attributesList' => 'birthdate',
        'attributesMax' => 1,
        'create' => $createBirthdate,
        'showDeleteButton' => false
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
        'update' => $updateBirthdate,
        'showDeleteButton' => false
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
        'showDeleteButton' => false
    ]); ?>
    <?php
endif;
?>
<?php
if(isset($createGender)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'gender',
        'attributesPlaceHolder' => Yii::t('app', 'Выберите ваш пол'),
        'attributesList' => 'gender',
        'attributesMax' => 1,
        'create' => $createGender,
        'showDeleteButton' => false
    ]); ?>
    <?php
elseif(isset($updateGender)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'gender',
        'attributesPlaceHolder' => Yii::t('app', 'Выберите ваш пол'),
        'attributesList' => 'gender',
        'attributesMax' => 1,
        'update' => $updateGender,
        'showDeleteButton' => false
    ]); ?>
    <?php
else:
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'gender',
        'attributesPlaceHolder' => Yii::t('app', 'Выберите ваш пол'),
        'attributesList' => 'gender',
        'attributesMax' => 1,
        'showDeleteButton' => false
    ]); ?>
    <?php
endif;
?>
<?php
if($user->tPerson->sex !== null || isset($successCreateGender)):
    ?>
    <?php
    if(isset($createMarital)):
        ?>
        <?= AttributesList::widget(
        [
            'attribute' => 'marital',
            'attributesPlaceHolder' => Yii::t('app', 'Ваше семейное положение'),
            'attributesList' => 'marital',
            'attributesMax' => 1,
            'create' => $createMarital,
            'showDeleteButton' => false
        ]); ?>
        <?php
    elseif(isset($updateMarital)):
        ?>
        <?= AttributesList::widget(
        [
            'attribute' => 'marital',
            'attributesPlaceHolder' => Yii::t('app', 'Выберите ваше семейное положение'),
            'attributesList' => 'marital',
            'attributesMax' => 1,
            'update' => $updateMarital,
            'showDeleteButton' => false
        ]); ?>
        <?php
    else:
        ?>
        <?= AttributesList::widget(
        [
            'attribute' => 'marital',
            'attributesPlaceHolder' => Yii::t('app', 'Выберите ваше семейное положение'),
            'attributesList' => 'marital',
            'attributesMax' => 1,
            'showDeleteButton' => false
        ]); ?>
        <?php
    endif;
    ?>
<?php
endif;
?>
<?php
if(isset($createChildren)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'children',
        'attributesPlaceHolder' => Yii::t('app', 'У вас есть дети?'),
        'attributesList' => 'children',
        'attributesMax' => 1,
        'create' => $createChildren,
        'showDeleteButton' => false
    ]); ?>
    <?php
elseif(isset($updateChildren)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'children',
        'attributesPlaceHolder' => Yii::t('app', 'У вас есть дети?'),
        'attributesList' => 'children',
        'attributesMax' => 1,
        'update' => $updateChildren,
        'showDeleteButton' => false
    ]); ?>
    <?php
else:
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'children',
        'attributesPlaceHolder' => Yii::t('app', 'У вас есть дети?'),
        'attributesList' => 'children',
        'attributesMax' => 1,
        'showDeleteButton' => false
    ]); ?>
    <?php
endif;
?>
<?php
if(isset($createBirthcity)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'birthcity',
        'attributesPlaceHolder' => Yii::t('app', 'Выберите родной город'),
        'attributesList' => 'birthcity',
        'attributesMax' => 1,
        'create' => $createBirthcity,
        'showDeleteButton' => false
    ]); ?>
    <?php
elseif(isset($updateBirthcity)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'birthcity',
        'attributesPlaceHolder' => Yii::t('app', 'Выберите родной город'),
        'attributesList' => 'birthcity',
        'attributesMax' => 1,
        'update' => $updateBirthcity,
        'showDeleteButton' => false
    ]); ?>
    <?php
else:
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'birthcity',
        'attributesPlaceHolder' => Yii::t('app', 'Выберите родной город'),
        'attributesList' => 'birthcity',
        'attributesMax' => 1,
        'showDeleteButton' => false
    ]); ?>
    <?php
endif;
?>
<?php
if(isset($createLangs)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'langs',
        'attributesPlaceHolder' => Yii::t('app', 'Выбор языка'),
        'attributesList' => 'langs',
        'attributesMax' => 1,
        'create' => $createLangs,
        'showDeleteButton' => false
    ]); ?>
    <?php
elseif(isset($updateLangs)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'langs',
        'attributesPlaceHolder' => Yii::t('app', 'Выбор языка'),
        'attributesList' => 'langs',
        'attributesMax' => 1,
        'update' => $updateLangs,
        'showDeleteButton' => false
    ]); ?>
    <?php
else:
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'langs',
        'attributesPlaceHolder' => Yii::t('app', 'Выбор языка'),
        'attributesList' => 'langs',
        'attributesMax' => 1,
        'showDeleteButton' => false
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


