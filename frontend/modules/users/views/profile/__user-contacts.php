<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.03.2016
 * Time: 11:13
 */
use yii\widgets\Pjax;
use common\widgets\DataFieldsList\AttributesList;
?>
<?php Pjax::begin([
    'id' => 'userContacts',
    'enablePushState' => false,
    'timeout' => 9000
]); ?>
<?php
if(isset($createPhone)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'phone',
        'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Phone'),
        'attributesList' => 'phonesList',
        'attributesMax' => Yii::$app->params['maxPhones'],
        'actionCreate' => '/users/profile/create-phone',
        'actionUpdate' => '/users/profile/update-phone',
        'actionDelete' => '/users/profile/delete-phone',
        'create' => $createPhone
    ]); ?>
    <?php
elseif(isset($updatePhone)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'phone',
        'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Phone'),
        'attributesList' => 'phonesList',
        'attributesMax' => Yii::$app->params['maxPhones'],
        'actionCreate' => '/users/profile/create-phone',
        'actionUpdate' => '/users/profile/update-phone',
        'actionDelete' => '/users/profile/delete-phone',
        'update' => $updatePhone
    ]); ?>
    <?php
else:
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'phone',
        'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Phone'),
        'attributesList' => 'phonesList',
        'attributesMax' => Yii::$app->params['maxPhones'],
        'actionCreate' => '/users/profile/create-phone',
        'actionUpdate' => '/users/profile/update-phone',
        'actionDelete' => '/users/profile/delete-phone',
    ]); ?>
    <?php
endif;
?>
<?php
if(isset($createEmail)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'email',
        'attributesPlaceHolder' => Yii::t('app', 'Введите Емайл'),
        'attributesList' => 'emailsList',
        'attributesMax' => Yii::$app->params['maxEmails'],
        'actionCreate' => '/users/profile/create-email',
        'actionUpdate' => '/users/profile/update-email',
        'actionDelete' => '/users/profile/delete-email',
        'create' => $createEmail
    ]); ?>
    <?php
elseif(isset($updateEmail)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'email',
        'attributesPlaceHolder' => Yii::t('app', 'Введите Емайл'),
        'attributesList' => 'emailsList',
        'attributesMax' => Yii::$app->params['maxEmails'],
        'actionCreate' => '/users/profile/create-email',
        'actionUpdate' => '/users/profile/update-email',
        'actionDelete' => '/users/profile/delete-email',
        'update' => $updateEmail
    ]); ?>
    <?php
else:
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'email',
        'attributesPlaceHolder' => Yii::t('app', 'Введите Емайл'),
        'attributesList' => 'emailsList',
        'attributesMax' => Yii::$app->params['maxEmails'],
        'actionCreate' => '/users/profile/create-email',
        'actionUpdate' => '/users/profile/update-email',
        'actionDelete' => '/users/profile/delete-email',
    ]); ?>
    <?php
endif;
?>
<?php
if(isset($createSkype)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'skype',
        'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Skype'),
        'attributesList' => 'skypesList',
        'attributesMax' => Yii::$app->params['maxSkypes'],
        'actionCreate' => '/users/profile/create-skype',
        'actionUpdate' => '/users/profile/update-skype',
        'actionDelete' => '/users/profile/delete-skype',
        'create' => $createSkype
    ]); ?>
    <?php
elseif(isset($updateSkype)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'skype',
        'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Skype'),
        'attributesList' => 'skypesList',
        'attributesMax' => Yii::$app->params['maxSkypes'],
        'actionCreate' => '/users/profile/create-skype',
        'actionUpdate' => '/users/profile/update-skype',
        'actionDelete' => '/users/profile/delete-skype',
        'update' => $updateSkype
    ]); ?>
    <?php
else:
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'skype',
        'attributesPlaceHolder' => Yii::t('app', 'Введите ваш Skype'),
        'attributesList' => 'skypesList',
        'attributesMax' => Yii::$app->params['maxSkypes'],
        'actionCreate' => '/users/profile/create-skype',
        'actionUpdate' => '/users/profile/update-skype',
        'actionDelete' => '/users/profile/delete-skype',
    ]); ?>
    <?php
endif;
?>
<?php
if(isset($createSite)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'site',
        'attributesPlaceHolder' => Yii::t('app', 'Введите адрес сайта'),
        'attributesList' => 'sitesList',
        'attributesMax' => Yii::$app->params['maxSites'],
        'actionCreate' => '/users/profile/create-site',
        'actionUpdate' => '/users/profile/update-site',
        'actionDelete' => '/users/profile/delete-site',
        'create' => $createSite
    ]); ?>
    <?php
elseif(isset($updateSite)):
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'site',
        'attributesPlaceHolder' => Yii::t('app', 'Введите адрес сайта'),
        'attributesList' => 'sitesList',
        'attributesMax' => Yii::$app->params['maxSites'],
        'actionCreate' => '/users/profile/create-site',
        'actionUpdate' => '/users/profile/update-site',
        'actionDelete' => '/users/profile/delete-site',
        'update' => $updateSite
    ]); ?>
    <?php
else:
    ?>
    <?= AttributesList::widget(
    [
        'attribute' => 'site',
        'attributesPlaceHolder' => Yii::t('app', 'Введите адрес сайта'),
        'attributesList' => 'sitesList',
        'attributesMax' => Yii::$app->params['maxSites'],
        'actionCreate' => '/users/profile/create-site',
        'actionUpdate' => '/users/profile/update-site',
        'actionDelete' => '/users/profile/delete-site',
    ]); ?>
    <?php
endif;
?>
<?php Pjax::end(); ?>
<?php
$script = <<< JS
        $("document").ready(function(){
            $("#userContacts").on('pjax:send', function() {
                $('#loadingContacts').show();
                $("#userContacts .btn").attr('disabled', true);
            });
            $("#userContacts").on('pjax:complete', function() {
                $('#loadingContacts').hide();
                $("#userContacts .btn").attr('disabled', false);
            });
        });
JS;
$this->registerJs($script);
?>

