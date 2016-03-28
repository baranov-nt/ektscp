<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 24.03.2016
 * Time: 14:01
 */
/* @var $id string */
/* @var $offset string */
/* @var $modelContactsForm \common\widgets\UserDataWidget\models\ContactsForm */
/* @var $phoneCount string */

use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use frontend\assets\ChosenAsset;
use yii\bootstrap\Html;

ChosenAsset::register($this);
?>
<?php $form = ActiveForm::begin([
    //'action' => '',
    'method' => 'post',
    'id' => 'contact-form',
]); ?>
<?php
$i = 0;
while($phoneCount > 0):
?>
    <div class="col-xs-10">
        <?php
        $error = '';
        $errorClass = '';
        if($modelContactsForm->errors['phone['.$i.']']) {
            $error = '<p class="" style="display: block; color: #a94442">'.$modelContactsForm->errors['phone['.$i.']'][0].'</p>';
            $errorClass = 'has-error';
        };
        ?>
        <?= $form->field($modelContactsForm, 'phone['.$i.']',
            [
                'options'=>['id'=>'custom-id_wrapper','class'=>'form-group '.$errorClass],
                'template'=>"{label}\n\n\t\n\t{input}\n\n\t\n\t{hint}\n\n\t\n\t$error"
            ])->widget(MaskedInput::className(),[
            'name' => 'phone[0]',
            'mask' => '7 (999) 999-9999',
            'options' => [
                'placeholder' => '7 (___) ___-____',
                'class' => 'form-control'
            ]])->error(false); ?>
    </div>
    <div class="col-xs-1">
        <?php
        if($phoneCount == 1):
        ?>
        <label class="control-label">&nbsp</label>
        <?= Html::button('<span class="glyphicon glyphicon-plus" style="font-size: 24px;"></span>',
            [
                'class' => 'btn btn-success',
                'style' => 'padding: 2px 2px 1px 5px;;',
                'onclick' => '
                $.pjax({
                    type: "POST",
                    url: "/users/profile/add-phone",
                    data: jQuery("#contact-form").serialize(),
                    container: "#'.$id.'",
                    push: false
                })'
            ]); ?>
            <?php
            else:
                ?>
                <label class="control-label">&nbsp</label>
                <?= Html::button('<span class="glyphicon glyphicon-minus" style="font-size: 24px;"></span>',
                [
                    'class' => 'btn btn-danger',
                    'style' => 'padding: 2px 5px 1px 5px;;',
                    'onclick' => '
                $.pjax({
                    type: "POST",
                    url: "/users/profile/delete-phone",
                    data: jQuery("#contact-form").serialize(),
                    container: "#'.$id.'",
                    push: false
                })'
                ]); ?>
            <?php
        endif;
            ?>
    </div>
<?php
$phoneCount--;
$i++;
endwhile;
?>
    <div class="clearfix"></div>
    <div class="col-md-12">
        <?= $form->field($modelContactsForm, 'email[]') ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($modelContactsForm, 'skype') ?>
    </div>
    <h3 class="text-center" style="margin: 0; font-weight: 300;">Адрес</h3>

    <div class="col-md-12">
        <?= $form->field($modelContactsForm, 'city')->dropDownList($modelContactsForm->cityList, [
            'class'  => 'form-control chosen-select',
            'prompt' => Yii::t('app', 'Выберете город'),
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($modelContactsForm, 'street') ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($modelContactsForm, 'house')->error(false) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($modelContactsForm, 'housing') ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($modelContactsForm, 'office') ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($modelContactsForm, 'offset')->hiddenInput()->label(false) ?>
        <?= Html::button('Сохранить',
            [
                'class' => 'btn btn-success',
                'onclick' => ''
            ]) ?>
    </div>

<?php ActiveForm::end(); ?>
<?php
//d($offset);
$js=<<<JS
$(window).scroll(function(event){
   $("#contactsform-offset").val($("body").scrollTop());
});
$("#$id").on("pjax:complete", function() {
    //alert($offset);
    $("html,body").scrollTop($offset);
 });
//$('html, body').animate({ scrollTop: $('#<id>').offset().top -200}, 'fast');
$("html,body").scrollTop($offset);
JS;
$this->registerJS($js);
