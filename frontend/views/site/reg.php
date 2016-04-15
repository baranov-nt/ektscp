<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\widgets\Pjax;
use yii\helpers\Url;
use russ666\widgets\Countdown;
use yii\bootstrap\Modal;
use frontend\assets\ChosenAsset;
use common\widgets\AlertIGrowl;


/* @var $this yii\web\View */
/* @var $model frontend\models\RegForm */
/* @var $modelUser common\models\Users */
/* @var $form ActiveForm */

$this->title = 'Регистрация';

?>
    <div class="container">
        <div class="main-reg" style="margin-top: 60px;">
            <div class="col-md-6 col-md-offset-3">
                <div class="row">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <p>Заполните форму ниже, для регистрации:</p>
                    <?php
                    Pjax::begin([
                        //'enablePushState' => false,
                    ]);
                    ChosenAsset::register($this);
                    ?>
                    <div class="form-group">
                        <label class="control-label" for="regform-password">

                        </label>
                    </div>
                    <?php
                    $form = ActiveForm::begin(['action' => Url::to(['/site/signup']), 'id' => 'form', 'options' => ['data-pjax' => true]]); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'first_name') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'family') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'email') ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $form->field($model, 'city')->dropDownList($model->cityList, [
                                'class'  => 'form-control chosen-select',
                                'prompt' => Yii::t('app', 'Выберете город'),
                            ])
                            ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'phone')->widget(MaskedInput::className(),[
                                'name' => 'phone',
                                'mask' => '7 (999) 999-9999',
                                'options' => [
                                    'placeholder' => '7 (___) ___-____',
                                    'class' => 'form-control'
                                ]]);
                            ?>
                        </div>
                        <div class="clearfix"></div>
                        <?php
                        if(isset($ok) || isset($errorSms)):
                            if($ok != 0):
                                ?>
                                <div class="col-md-4">
                                    <?= $form->field($model, 'smsKey')->input('text', ['max' => 4]); ?>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label" for="regform-password">Повторно отправить СМС можно через
                                        <?php
                                        echo Countdown::widget([
                                            'id' => 'timer',
                                            'datetime' => date('Y-m-d H:i:s', time() + 120),
                                            'format' => '%M:%S',
                                            'events' => [
                                                'finish' => 'function(){
                            $.pjax({
                        type: "POST",
                        url: "update-sms",
                        data: jQuery("#form").serialize(),
                        container: "#w0",
                        push: false
                })}',
                                            ],
                                        ]);
                                        ?>
                                    </label>
                                </div>
                                <?php
                            endif;
                            ?>
                            <?php
                            echo Html::hiddenInput('reg', 1);
                            echo Html::hiddenInput('updateSms', 0);
                            ?>
                            <?php
                            if(isset($updateSms)):
                                ?>
                                <div class="col-md-4">
                                    <?= $form->field($model, 'smsKey')->input('text', ['max' => 4]); ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-4">
                                    <?php
                                    echo Html::button('Отправить смс повторно', ['onclick' => '
            $.pjax({
                        type: "POST",
                        url: "update-sms",
                        data: jQuery("#form").serialize(),
                        container: "#w0",
                        push: false
                })
            ']);
                                    ?>
                                </div>
                                <?php
                                echo Html::hiddenInput('updateSms', 1);
                            endif;
                        else:
                            ?>
                            <div class="clearfix"></div>
                            <div class="col-md-4">
                                <?=  Html::button('Подтвердить телефон', [
                                    'class' => 'btn btn-default',
                                    'id' => 'sendSms',
                                    'name' => 'sendSms',
                                    'onclick' => '
            $.pjax({
                        type: "POST",
                        url: "update-sms",
                        data: jQuery("#form").serialize(),
                        container: "#w0",
                        push: false
                })
            ']);
                                ?>
                            </div>
                            <?php
                            echo Html::hiddenInput('updateSms', 1);
                        endif;
                        ?>
                        <div id="sms-widget"></div>
                        <div class="col-md-12" style="margin-top: 20px;">
                            <?= $form->field($model, 'success', [
                                'template' => "<div class=\"col-xs-1\">{input}</div><div class=\"col-xs-11\">Регистрируясь, я подтверждаю свое согласие с условиями <a data-toggle='modal' data-target='#w1' style='cursor: pointer'>пользовательского соглашения</a>
                    </div><div class=\"col-xs-12\">{error}</div>",
                            ])->checkbox()->label(false); ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4">
                            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary']) ?>
                            <?/*= Html::a('Войти', ['/site/login'], ['class'=>'btn btn-primary']) */?>
                        </div>
                        <?php
                        if($model->scenario === 'emailActivation' || $model->scenario === 'phoneAndEmailFinish'):
                            ?>
                            <i>*На указанный емайл будет отправлено письмо для активации аккаунта.</i>
                            <?php
                        endif;
                        ?>
                    </div>
                    <?= $form->field($model, 'error')->hiddenInput(['value' => $error])->label(false) ?>
                    <?php ActiveForm::end(); ?>

                    <?php
                    Countdown::widget([
                        'id' => 'timer2',
                        'datetime' => date('Y-m-d H:i:s', time() + 50000),
                        'format' => '%M:%S',
                        'events' => [

                        ],
                    ]);
                    ?>
                    <?= AlertIGrowl::widget() ?>
                    <?php
                    Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
<?php
Modal::begin([
    'size' => 'modal-lg',
    'header' => '<h2>Пользовательское соглашение</h2>',
    'footer' => 'Для сайта MCM',
    'options' => [
        'style' => ''
    ]
]);
?>
    <p>
    <p><strong>1.Общие условия</strong></p>  <p>1.1. Использование материалов и сервисов Сайта регулируется нормами действующего законодательства Российской Федерации.</p>
    <p>1.2. Настоящее Соглашение является публичной офертой. Получая доступ к материалам Сайта Пользователь считается присоединившимся к настоящему Соглашению. </p>
    <p>1.3. Администрация Сайта вправе в любое время в одностороннем порядке изменять условия настоящего Соглашения. Такие изменения вступают в силу по истечении 3 (Трех) дней с момента размещения новой версии Соглашения на сайте. При несогласии Пользователя с внесенными изменениями он обязан отказаться от доступа к Сайту, прекратить использование материалов и сервисов Сайта.</p>  <p><strong>2. Обязательства Пользователя</strong></p>  <p>2.1. Пользователь соглашается не предпринимать действий, которые могут рассматриваться как нарушающие российское законодательство или нормы международного права, в том числе в сфере <a href="http://copyright.ru/intellectual/" title="интеллектуальной собственности">интеллектуальной собственности</a>, <u>
        <a href="http://copyright.ru/ru/documents/avtorskoe_pravo/avtorskie_prava/" title="авторских">авторских</a> </u>и/или <u>
        <a href="http://copyright.ru/ru/documents/avtorskoe_pravo/smegnie_prava/" title="смежных правах">смежных правах</a></u>, а также любых действий, которые приводят или могут привести к нарушению нормальной работы Сайта и сервисов Сайта.</p>  <p>2.2. Использование материалов Сайта без согласия <a href="http://copyright.ru/documents/avtorskoe_pravo/pravoobladateli/" title="правообладателей">правообладателей</a> не допускается (статья 1270&nbsp;Г.К РФ). Для правомерного использования материалов Сайта необходимо заключение <u>
        <a href="http://copyright.ru/ru/documents/avtorskoe_pravo/peredacha_avtorskih_prav/" title="лицензионных договоров">лицензионных договоров</a></u> (получение лицензий) от Правообладателей. </p>  <p>2.3. При <a href="http://copyright.ru/library/zakonodatelstvo/gk_rf_obschee_zakonodatel/grazhdanskii_kodeks_RF_4_chast/glava_70__avtorskoe_pravo/#20" title="цитировании">цитировании</a> материалов Сайта, включая охраняемые авторские произведения, ссылка на Сайт обязательна (подпункт 1 пункта 1 статьи 1274&nbsp;Г.К РФ).</p>  <p>2.4. Комментарии и иные записи Пользователя на Сайте не должны вступать в противоречие с требованиями законодательства Российской Федерации и общепринятых норм морали и нравственности.</p>  <p>2.5. Пользователь предупрежден о том, что Администрация Сайта не несет ответственности за посещение и использование им внешних ресурсов, ссылки на которые могут содержаться на сайте. </p>  <p>2.6. Пользователь согласен с тем, что Администрация Сайта не несет ответственности и не имеет прямых или косвенных обязательств перед Пользователем в связи с любыми возможными или возникшими потерями или убытками, связанными с любым содержанием Сайта, <u><a href="http://copyright.ru/ru/documents/registraciy_avtorskih_prav/" title="регистрацией авторских прав">регистрацией авторских прав</a></u> и сведениями о такой регистрации, товарами или услугами, доступными на или полученными через внешние сайты или ресурсы либо иные контакты Пользователя, в которые он вступил, используя размещенную на Сайте информацию или ссылки на внешние ресурсы.</p>  <p>2.7. Пользователь принимает положение о том, что все материалы и сервисы Сайта или любая их часть могут сопровождаться рекламой. Пользователь согласен с тем, что Администрация Сайта не несет какой-либо ответственности и не имеет каких-либо обязательств в связи с такой рекламой.</p>  <p><strong>3. Прочие условия</strong></p>  <p>3.1. Все возможные споры, вытекающие из настоящего Соглашения или связанные с ним, подлежат разрешению в соответствии с действующим законодательством Российской Федерации. </p>  <p>3.2. Ничто в Соглашении не может пониматься как установление между Пользователем и Администрации Сайта агентских отношений, отношений товарищества, отношений по совместной деятельности, отношений личного найма, либо каких-то иных отношений, прямо не предусмотренных Соглашением.</p>  <p>3.3. Признание судом какого-либо положения Соглашения недействительным или не подлежащим принудительному исполнению не влечет недействительности иных положений Соглашения.</p>  <p>3.4. Бездействие со стороны Администрации Сайта в случае нарушения кем-либо из Пользователей положений Соглашения не лишает Администрацию Сайта права предпринять позднее соответствующие действия в защиту своих интересов и <a href="http://copyright.ru/documents/zashita_avtorskih_prav/" title="защиту авторских прав">защиту авторских прав</a> на охраняемые в соответствии с законодательством материалы Сайта.</p>
    <p><strong>Пользователь подтверждает, что ознакомлен со всеми пунктами настоящего Соглашения и безусловно принимает их.</strong></p>
<?php
Modal::end();
?>