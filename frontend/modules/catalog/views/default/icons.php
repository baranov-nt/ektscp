<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.01.2016
 * Time: 15:45
 */
use yii\bootstrap\Html;
use kartik\date\DatePicker;
?>
<div class="container">
    <div class="col-md-2">
    <label>Название</label>
    <?=DatePicker::widget([
        'language' => 'ru',
        'name' => 'endSale',
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'layout' => '{input}{picker}',
        'value' => Yii::$app->formatter->asDate(time(), "php:d.m.Y"),
        'options' => [
            'class' => 'period-picker',
        ],
        'pickerButton' => '<span class="input-group-addon kv-field-separator calendar-button-style">
                                            <svg width="18" height="18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink= "http://www.w3.org/1999/xlink">
	                                            <image xlink:href="/images/activeCAL.svg" x="0" y="0" height="18px" width="18px"/>
                                            </svg>
                                       </span>',
        'buttonOptions' => 'label',
        'pluginOptions' => [
            'todayHighlight' => true,
            'todayBtn' => true,
            'format' => 'dd.mm.yyyy',
            'autoclose' => true,
        ]
    ]);?>
</div>
<div class="fa fa-plus-circle fa-lg text-info"></div>
<div class="fa fa-times-circle fa-lg text-danger"></div>
<div class="fa fa-plus-circle fa-lg text-info"></div>
<div class="fa fa-times-circle fa-size-xl"></div>
<div class="fa fa-times-circle fa-color-red"></div>
<div class="fa fa-times-circle text-primary fa-size-xl fa-shadow-crey"></div>
<span class="fa-stack fa-lg">
  <i class="fa fa-camera fa-stack-1x"></i>
</span>
<span class="fa-stack fa-lg">
  <i class="fa fa-camera fa-stack-1x"></i>
  <i class="fa fa-ban fa-stack-2x text-danger"></i>
</span>
<div class="fa fa-times-circle text-primary fa-size-xl fa-shadow-crey"></div>
<i class="fa fa-spinner fa-spin fa-size-xl"></i>
<i class="fa fa-circle-o-notch fa-spin fa-size-xl"></i>
<i class="fa fa-refresh fa-spin fa-size-xl"></i>
<i class="fa fa-cog fa-spin fa-size-xl"></i>
<i class="fa fa-spinner fa-pulse fa-size-xl"></i>

<?/*= Html::button('Добавить визитку', ['class' => 'btn btn-warning']) */?><!--
--><?/*= Html::submitButton('Добавить визитку', ['class' => 'btn btn-success']) */?>
<br>

<div class="container">
    <form class="form-inline" role="form">
        <div class="form-group">
            <label class="sr-only" for="exampleInputF1">Поле 1</label>
            <input type="text" class="form-control" id="exampleInputF1" placeholder="Введите Поле 1">
        </div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputF1">Поле 2</label>
            <input type="text" class="form-control" id="exampleInputF2" placeholder="Введите Поле 2">
        </div>
        <div class="form-group">
            <label class="sr-only" for="exampleInputF1">Поле 2</label>
            <input type="text" class="form-control" id="exampleInputF2" placeholder="Введите Поле 2">
        </div>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
    </form>
</div>
<br>
<div class="col-xs-6">
    <select class="form-control">
        <option>Средний - 1</option>
        <option>Средний - 2</option>
    </select>
</div>
<div class="col-xs-6">
    <select class="form-control">
        <option>Средний - 1</option>
        <option>Средний - 2</option>
    </select>
</div>
    <div class="col-md-6" style="padding: 20px; margin-top: 20px; font-size: 12px;">
        <p>
            <?= Html::button('btn btn-primary btn-primary-lg', ['class' => 'btn btn-primary btn-primary-lg', 'style' => 'outline: none;']) ?> btn btn-primary btn-primary-lg
        </p>
        <p>
            <?= Html::button('btn btn-primary btn-primary-md', ['class' => 'btn btn-primary btn-primary-md', 'style' => 'outline: none;']) ?> btn btn-primary btn-primary-md
        </p>
        <p>
            <?= Html::a('btn btn-primary btn-primary-md a-btn-style-md', '#', ['class' => 'btn btn-primary btn-primary-md a-btn-style-md', 'style' => 'outline: none;']) ?> btn btn-success btn-success-md a-btn-style-md a-btn-style-md
        </p>
        <p>
            <?= Html::button('btn btn-primary btn-primary-sm', ['class' => 'btn btn-primary btn-primary-sm', 'style' => 'outline: none;']) ?> btn btn-primary btn-primary-sm
        </p>
    </div>
    <div class="col-md-6" style="padding: 20px; margin-top: 20px; font-size: 12px; background-color: #448AFF;">
        <p>
            <?= Html::button('btn btn-primary btn-primary-inside-lg', ['class' => 'btn btn-primary btn-primary-inside-lg', 'style' => 'outline: none;']) ?> btn btn-primary btn-primary-inside-lg
        </p>
        <p>
            <?= Html::button('btn btn-primary btn-primary-inside-md', ['class' => 'btn btn-primary btn-primary-inside-md', 'style' => 'outline: none;']) ?> btn btn-primary btn-primary-inside-md
        </p>
        <p>
            <?= Html::button('btn btn-primary btn-primary-inside-sm', ['class' => 'btn btn-primary btn-primary-inside-sm', 'style' => 'outline: none;']) ?> btn btn-primary btn-primary-inside-sm
        </p>
    </div>
    <div class="col-md-12" style="padding: 20px; margin-top: 20px; font-size: 12px;">
        <p>
            <?= Html::button('<i class="fa fa-envelope-o"></i> btn btn-primary btn-primary-mail-md', ['class' => 'btn btn-primary btn-primary-mail-md', 'style' => 'outline: none;']) ?> Перед названием - &lt;i class="fa fa-envelope-o"&gt;&lt;/i&gt;, класс - btn btn-primary btn-primary-mail-md
        </p>
    </div>
    <div class="col-md-12" style="padding: 20px; margin-top: 20px; font-size: 12px;">
        <p>
            <?= Html::button('<i class="fa fa-road"></i> btn btn-primary btn-primary-route-md', ['class' => 'btn btn-primary btn-primary-route-md', 'style' => 'outline: none;']) ?> Перед названием - &lt;i class="fa fa-road"&gt;&lt;/i&gt; btn btn-primary btn-primary-route-md
        </p>
    </div>
    <div class="col-md-6" style="padding: 20px; margin-top: 20px; font-size: 12px;">
        <p>
            <?= Html::button('btn btn-success btn-success-lg', ['class' => 'btn btn-success btn-success-lg', 'style' => 'outline: none;']) ?> btn btn-success btn-success-lg
        </p>
        <p>
            <?= Html::button('btn btn-success btn-success-md', ['class' => 'btn btn-success btn-success-md', 'style' => 'outline: none;']) ?> btn btn-success btn-success-md
        </p>
        <p>
            <?= Html::a('btn btn-success btn-success-md a-btn-style-md', '#', ['class' => 'btn btn-success btn-success-md a-btn-style-md', 'style' => 'outline: none;']) ?> btn btn-success btn-success-md a-btn-style-md
        </p>
        <p>
            <?= Html::button('btn btn-success btn-success-sm', ['class' => 'btn btn-success btn-success-sm', 'style' => 'outline: none;']) ?> btn btn-success btn-success-sm
        </p>
    </div>
    <div class="col-md-12" style="padding: 20px; margin-top: 20px; font-size: 12px;">
        <h1 class="text-center">Тексты</h1>
        <div class="row" style="width: 100%">
            <div class="col-xs-6 text-right">
                <span class="page-header">Заголовок страницы</span>
            </div>
            <div class="col-xs-6">
                <span class="page-header">В &lt;h1&gt; или page-header</span>
            </div>
            <div class="col-xs-12" style="margin: 0 0 0 0 !important; padding: 0 0 0 0 !important; height: 10px !important;"></div>
            <div class="col-xs-6 text-right">
                <span class="page-subtitle">Подзаголовок</span>
            </div>
            <div class="col-xs-6">
                <span class="page-subtitle">page-subtitle</span>
            </div>
            <div class="col-xs-12" style="margin: 0 0 0 0 !important; padding: 0 0 0 0 !important; height: 10px !important;"></div>
            <div class="col-xs-6 text-right">
                <span class="page-dep">Вылет</span>
            </div>
            <div class="col-xs-6">
                <span class="page-dep">page-dep</span>
            </div>
            <div class="col-xs-12" style="margin: 0 0 0 0 !important; padding: 0 0 0 0 !important; height: 10px !important;"></div>
            <div class="col-xs-6 text-right">
                <span class="block-header">Заголовок блока</span>
            </div>
            <div class="col-xs-6">
                <span class="block-header">block-header</span>
            </div>
            <div class="col-xs-12" style="margin: 0 0 0 0 !important; padding: 0 0 0 0 !important; height: 10px !important;"></div>
            <div class="col-xs-6 text-right">
                <span class="main-text">Наборный текст основной</span>
            </div>
            <div class="col-xs-6">
                <span class="main-text">main-text</span>
            </div>
            <div class="col-xs-12" style="margin: 0 0 0 0 !important; padding: 0 0 0 0 !important; height: 10px !important;"></div>
            <div class="col-xs-6 text-right">
                <span class="main-text-dep">Вылет в основном наборе</span>
            </div>
            <div class="col-xs-6">
                <span class="main-text-dep">main-text-dep</span>
            </div>
            <div class="col-xs-12" style="margin: 0 0 0 0 !important; padding: 0 0 0 0 !important; height: 10px !important;"></div>
            <div class="col-xs-6 text-right">
                <span class="main-text-2">Наборный текст 2</span>
            </div>
            <div class="col-xs-6">
                <span class="main-text-2">main-text-2</span>
            </div>
            <div class="col-xs-12" style="margin: 0 0 0 0 !important; padding: 0 0 0 0 !important; height: 10px !important;"></div>
            <div class="col-xs-6 text-right">
                <span class="main-text-dep-2">Наборный текст выделение</span>
            </div>
            <div class="col-xs-6">
                <span class="main-text-dep-2">main-text-dep-2</span>
            </div>
            <div class="col-xs-12" style="margin: 0 0 0 0 !important; padding: 0 0 0 0 !important; height: 10px !important;"></div>
            <div class="col-xs-6 text-right">
                <span class="text-footnotes">Сноски</span>
            </div>
            <div class="col-xs-6">
                <span class="text-footnotes">text-footnotes</span>
            </div>
            <div class="col-xs-12" style="margin: 0 0 0 0 !important; padding: 0 0 0 0 !important; height: 10px !important;"></div>
            <div class="col-xs-6 text-right">
                <span class="text-footnotes-dep">Сноски выделение</span>
            </div>
            <div class="col-xs-6">
                <span class="text-footnotes-dep">text-footnotes-dep</span>
            </div>
        </div>
    </div>

    <div class="col-md-12" style="padding: 20px; margin-top: 20px; font-size: 12px;">
        <h1 class="text-center">Метки, инпуты, ошибки в формах</h1>
        <div class="row" style="width: 100%">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="catalogform-companyname">control-label в родителе (form-group)</label>
                    <input type="text" id="catalogform-companyname" class="form-control" name="CatalogForm[companyName]" value="form-control main-text">

                    <p class="help-block help-block-error"></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-error">
                    <label class="control-label" for="catalogform-companyname">control-label в родителе (form-group has-error)</label>
                    <input type="text" id="catalogform-companyname" class="form-control" name="CatalogForm[companyName]" value="form-control main-text">

                    <p class="help-block help-block-error">help-block help-block-error в теге &lt;p&gt; после инпута</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-success">
                    <label class="control-label" for="catalogform-companyname">control-label в родителе (form-group has-success)</label>
                    <input type="text" id="catalogform-companyname" class="form-control main-text" name="CatalogForm[companyName]" value="form-control main-text">

                    <p class="help-block help-block-error"></p>
                </div>
            </div>
        </div>
    </div>
</div>



