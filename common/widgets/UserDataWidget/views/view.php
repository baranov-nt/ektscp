<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 16.02.2016
 * Time: 11:32
 */
/* @var $widget \common\widgets\UserDataWidget\UserDataWidget */
/* @var $modelContactsForm \common\widgets\UserDataWidget\models\ContactsForm */
/* @var $user common\models\Users */
/* @var $id string */
/* @var $offset string */
/* @var $phoneCount string */

use yii\bootstrap\Collapse;
use yii\bootstrap\Html;

echo Collapse::widget([
    'items' => [
        // equivalent to the above
        [
            'label' => 'Контакты ',
            //'content' => Html::button('добавить / редактировать', ['style' => 'margin: 0 !important;', 'class' => 'btn btn-warning btn-sm']).'<br><br>Данные (Контакты)',
            'content' =>  $widget->showContactForm ?
                $this->render('_form-contact', [
                    'id' => $widget->id,
                    'offset' => $widget->offset,
                    'modelContactsForm' => $widget->modelContactsForm,
                    'phoneCount' => $widget->phoneCount,
                ])
                :
                $this->render('_view-contact', [
                    'id' => $widget->id
                ]),
            'contentOptions' => [
                'class' => $widget->showContactForm ? 'in' : '',
            ],
            'options' => [

            ],
        ],
        // another group item
        [
            'label' => 'Общие сведения',
            'content' => Html::button('добавить / редактировать', ['style' => 'margin: 0 !important;', 'class' => 'btn btn-warning btn-sm']).'<br><br>Данные (Общие сведения)',
            'contentOptions' => [

            ],
            'options' => [],
        ],
        // if you want to swap out .panel-body with .list-group, you may use the following
        [
            'label' => 'Образование',
            'content' => [
                Html::button('добавить / редактировать', ['style' => 'margin: 0 !important;', 'class' => 'btn btn-warning btn-sm']).'<br><br>Данные (Образование Школа)',
                Html::button('добавить / редактировать', ['style' => 'margin: 0 !important;', 'class' => 'btn btn-warning btn-sm']).'<br><br>Данные (Образование ПТУ)',
                Html::button('добавить / редактировать', ['style' => 'margin: 0 !important;', 'class' => 'btn btn-warning btn-sm']).'<br><br>Данные (Образование Институт)',
            ],
            'contentOptions' => [
                //'class' => 'in'
            ],
            'options' => [],
            //'footer' => 'Footer' // the footer label in list-group
        ],
    ],
    'encodeLabels' => false,
    'options' => [

    ]
]);