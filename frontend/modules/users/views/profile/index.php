<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 21.03.2016
 * Time: 17:13
 */
/* @var $this yii\web\View */
/* @var $modelTPerson \common\models\TPerson */
use yii\bootstrap\Html;
use common\widgets\FontAwesome\AssetBundle;
use frontend\assets\ChosenAsset;
use justinvoelker\awesomebootstrapcheckbox\ActiveField;
use yii\bootstrap\Tabs;
use yii\widgets\Pjax;
use yii\helpers\Url;

ChosenAsset::register($this);
AssetBundle::register($this);

$this->title = 'Личный кабинет';
?>
<div class="container" style="margin-bottom: 60px; padding-top: 60px;">
    <h1 class="text-center" style="padding: 30px;"><?= Html::encode($this->title) ?></h1>
    <div class="col-md-6 col-md-offset-3" style="border: 1px solid #448aff; padding: 10px;">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-8">
                        <p><?= $modelTPerson->name.' '.$modelTPerson->family.' '.$modelTPerson->second_name ?></p>
                        <p><?= $modelTPerson->city0->name ?></p>
                        <p><?= $modelTPerson->phone ?></p>
                        <p><?= $modelTPerson->email ?></p>
                    </div>
                    <?php
                    Pjax::begin([
                        'id' => 'avatarImage',
                        'timeout' => 9000,
                        'enablePushState' => false,
                        'options' => [
                            'class' => 'col-xs-4'
                        ]
                    ]);
                    ?>
                    <?= $this->render('_avatar',
                        [
                            'modelTPerson' => $modelTPerson
                        ]) ?>
                    <?php Pjax::end(); ?>
                    <?= $this->render('_modal') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-md-offset-3" style="border: 1px solid #448aff; padding: 10px; background-color: #f5f5f5;">
        <?= $this->render('_user-profile-data') ?>
    </div>
    <div class="col-md-6 col-md-offset-3" style="border: 1px solid #448aff; padding: 10px;">
        <?php
        echo Tabs::widget([
            'items' => [
                [
                    'label' => 'Что-то 1',
                    'content' => Html::button('добавить / редактировать', ['style' => 'margin: 0 !important;', 'class' => 'btn btn-warning btn-sm']).'<br><br>Данные 1',
                    'active' => true
                ],
                [
                    'label' => 'Что-то 2',
                    'content' => Html::button('добавить / редактировать', ['style' => 'margin: 0 !important;', 'class' => 'btn btn-warning btn-sm']).'<br><br>Данные 2',
                    //'headerOptions' => [...],
                    //'options' => ['id' => 'myveryownID'],
                ],
                [
                    'label' => 'Что-то 3',
                    'content' => Html::button('добавить / редактировать', ['style' => 'margin: 0 !important;', 'class' => 'btn btn-warning btn-sm']).'<br><br>Данные 3',
                    //'url' => 'http://www.example.com',
                ],
            ],
            'itemOptions' => [
                'style' => 'padding: 20px 5px 20px 5px; height: 300px;'
            ]
        ]);
        ?>
    </div>

</div>

