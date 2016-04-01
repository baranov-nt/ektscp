<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 29.03.2016
 * Time: 10:44
 */
/* @var $modelTPerson common\models\TPerson */

use yii\bootstrap\Collapse;

echo Collapse::widget([
    'items' => [
        // equivalent to the above
        [
            'label' => 'Контакты <span id="loadingContacts" class="fa fa-spinner fa-spin" style="display: none;"></span>',
            'content' => $this->render('__user-contacts'),
            'contentOptions' => [
            ],
            'options' => [

            ],
        ],
        // another group item
        [
            'label' => 'Общие сведения <span id="loadingAbouts" class="fa fa-spinner fa-spin" style="display: none;"></span>',
            'content' => $this->render('__user-about'),
            'contentOptions' => [

            ],
            'options' => [],
        ],
        // if you want to swap out .panel-body with .list-group, you may use the following
        [
            'label' => 'Образование  <span id="loadingEducation" class="fa fa-spinner fa-spin" style="display: none;"></span>',
            'content' => $this->render('__user-educations'),
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
?>