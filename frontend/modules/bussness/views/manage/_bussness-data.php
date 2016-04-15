<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.04.2016
 * Time: 13:42
 */
/* @var $modelTPerson common\models\TPerson */

use yii\bootstrap\Collapse;

echo Collapse::widget([
    'items' => [
        // equivalent to the above
        [
            'label' => 'Открыто <span id="loadingWorkMode" class="fa fa-spinner fa-spin" style="display: none;"></span>',
            'content' => '',
            'contentOptions' => [
            ],
            'options' => [

            ],
        ],
        // another group item
        [
            'label' => 'Контакты <span id="loadingContacts" class="fa fa-spinner fa-spin" style="display: none;"></span>',
            'content' => '',
            'contentOptions' => [

            ],
            'options' => [],
        ],
        // if you want to swap out .panel-body with .list-group, you may use the following
        [
            'label' => 'Реквизиты <span id="loadingProperty" class="fa fa-spinner fa-spin" style="display: none;"></span>',
            'content' => '',
            'contentOptions' => [
                //'class' => 'in'
            ],
            'options' => [],
            //'footer' => 'Footer' // the footer label in list-group
        ],
    ],
    'encodeLabels' => false,
    'options' => []
]);
?>