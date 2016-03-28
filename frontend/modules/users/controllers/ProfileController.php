<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 21.03.2016
 * Time: 17:04
 */

namespace frontend\modules\users\controllers;

use common\widgets\UserDataWidget\models\ContactsForm;
use Yii;
use common\models\TPerson;
use frontend\controllers\BehaviorsController;

class ProfileController extends BehaviorsController
{
    public function actionIndex() {
        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);
        return $this->render('index',
            [
                'modelTPerson' => $modelTPerson
            ]);
    }

    public function actionCall() {

        return $this->renderAjax('_modal',
            [
                'header' => 'Позвонить'
            ]);
    }

    public function actionMessage() {
        return $this->renderAjax('_modal',
            [
                'header' => 'Отправить сообщение'
            ]);
    }

    public function actionFavorite() {
        return $this->renderAjax('_modal',
            [
                'header' => 'Подписаться'
            ]);
    }

    public function actionUpdateImage() {
        /* @var $modelTPerson \common\models\TPerson */
        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);
        if(Yii::$app->request->post('id_file')) {
            $modelTPerson->id_photo = Yii::$app->request->post('id_file');
            if($modelTPerson->update()) {
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Фото сохранено.'));
            }
        }

        return $this->renderAjax('_avatar',
            [
                'modelTPerson' => $modelTPerson
            ]);
    }

    public function actionShowContactForm() {
        $modelContactsForm = new ContactsForm(['scenario' => 'addPhone']);

        $phoneCount = 1;

        return $this->renderAjax(
            '_UserDataWidget',
            [
                'id' => 'user-data',
                'offset' => Yii::$app->request->post('offset'),
                'showContactForm' => true,
                'modelContactsForm' => $modelContactsForm,
                'phoneCount' => $phoneCount,
            ]
        );
    }

    public function actionAddPhone() {
        $modelContactsForm = new ContactsForm(['scenario' => 'addPhone']);

        $phoneCount = '';
        if($modelContactsForm->load(Yii::$app->request->post())) {
            $phoneCount = count($modelContactsForm->phone);
            if($modelContactsForm->validate()) {
                $phoneCount++;
            }
        }

        return $this->renderAjax(
            '_UserDataWidget',
            [
                'id' => 'user-data',
                'offset' => $modelContactsForm->offset,
                'showContactForm' => true,
                'modelContactsForm' => $modelContactsForm,
                'phoneCount' => $phoneCount,
            ]
        );
    }

    public function actionDeletePhone() {
        $modelContactsForm = new ContactsForm(['scenario' => 'addPhone']);

        $phoneCount = '';
        if($modelContactsForm->load(Yii::$app->request->post())) {
            $phoneCount = count($modelContactsForm->phone);
            if($modelContactsForm->validate()) {
                $phoneCount++;
            }
        }

        return $this->renderAjax(
            '_UserDataWidget',
            [
                'id' => 'user-data',
                'offset' => $modelContactsForm->offset,
                'showContactForm' => true,
                'modelContactsForm' => $modelContactsForm,
                'phoneCount' => $phoneCount,
            ]
        );
    }

    public function actionAddNewPhone() {
        /*$modelContactsForm = new ContactsForm(['scenario' => 'addPhone']);
        $phoneCount = '';
        if($modelContactsForm->load(Yii::$app->request->post())) {
            $phoneCount = count($modelContactsForm->phone);
            if($modelContactsForm->validate()) {
                $phoneCount++;
            }
        }

        return $this->renderAjax(
            '_UserDataWidget',
            [
                'id' => 'user-data',
                'offset' => $modelContactsForm->offset,
                'showContactForm' => true,
                'modelContactsForm' => $modelContactsForm,
                'phoneCount' => $phoneCount,
            ]
        );*/
    }
}