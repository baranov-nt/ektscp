<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.04.2016
 * Time: 12:50
 */
/* @var $this yii\web\View */
/* @var $modelTOffice \common\models\TOffice */

use yii\bootstrap\Html;
use common\widgets\FontAwesome\AssetBundle;
use frontend\assets\ChosenAsset;
use justinvoelker\awesomebootstrapcheckbox\ActiveField;
use yii\helpers\Url;
use frontend\modules\users\assets\UsersAsset;

ChosenAsset::register($this);
AssetBundle::register($this);
UsersAsset::register($this);

$this->title = 'Визитка компании';
?>
<div class="container">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <div class="col-md-12 text-center" style="margin-bottom: 20px;">
        <?= Html::a('Показать все мои визитки', Url::to(['/bussness/manage/index']), ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="col-md-6 col-md-offset-3" style="border: 1px solid #448aff; padding: 10px;">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-8">
                        <p><?= $modelTOffice->title ?></p>
                        <p><?= $modelTOffice->idCity->name ?></p>
                        <p><?= $modelTOffice->phone ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-md-offset-3" style="border: 1px solid #448aff; padding: 10px; background-color: #f5f5f5;">
        <?= $this->render('_bussness-data') ?>
    </div>
</div>
