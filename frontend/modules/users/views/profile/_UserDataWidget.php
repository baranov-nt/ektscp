<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 24.03.2016
 * Time: 13:16
 */
/* @var $id string */
/* @var $offset string */
/* @var $showContactForm string */
/* @var $phoneCount string */
/* @var $modelContactsForm \common\widgets\UserDataWidget\models\ContactsForm */

use common\widgets\UserDataWidget\UserDataWidget;
?>
<?= UserDataWidget::widget([
    'id' => $id,
    'offset' => $offset,
    'showContactForm' => $showContactForm,
    'modelContactsForm' => $modelContactsForm,
    'phoneCount' => $phoneCount,
]) ?>
