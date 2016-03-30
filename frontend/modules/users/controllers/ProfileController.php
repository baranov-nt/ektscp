<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 21.03.2016
 * Time: 17:04
 */

namespace frontend\modules\users\controllers;

use common\models\TPersonContact;
use common\widgets\DataFieldsList\models\DataFieldsForm;
use common\widgets\PhonesList\models\PhoneForm;
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
        return $this->render('_modal', [
            'modal' => true
        ]);
    }

    public function actionMessage() {
        return $this->render('_modal', [
            'modal' => true
        ]);
    }

    public function actionFavorite() {
        return $this->render('_modal', [
            'modal' => true
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

    public function actionCreatePhone() {

        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'phoneScenario']);

        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate() && $modelDataFieldsForm->createPhone()) {
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            }
            Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['phone'][0]));
            return $this->render('__user-contacts',
                [
                    'modelTPerson' => $modelTPerson,
                ]);
        }

        return $this->render('__user-contacts',
            [
                'modelTPerson' => $modelTPerson,
                'createPhone' => true
            ]);
    }

    public function actionUpdatePhone($id) {

        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);

        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'phoneScenario']);

        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate() && $modelDataFieldsForm->savePhone()) {
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['phone'][0]));
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            }
        }

        return $this->render('__user-contacts',
            [
                'modelTPerson' => $modelTPerson,
                'updatePhone' => $id
            ]);
    }

    public function actionDeletePhone($id) {
        TPersonContact::findOne($id)->delete();
        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);
        return $this->render('__user-contacts',
            [
                'modelTPerson' => $modelTPerson,
            ]);
    }

    public function actionCreateEmail() {

        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'emailScenario']);

        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->createEmail();
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['email'][0]));
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            }
        }

        return $this->render('__user-contacts',
            [
                'modelTPerson' => $modelTPerson,
                'createEmail' => true
            ]);
    }

    public function actionUpdateEmail($id) {

        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);

        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'emailScenario']);

        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->saveEmail();
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['email'][0]));
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            }
        }

        return $this->render('__user-contacts',
            [
                'modelTPerson' => $modelTPerson,
                'updateEmail' => $id
            ]);
    }

    public function actionDeleteEmail($id) {
        TPersonContact::findOne($id)->delete();
        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);
        return $this->render('__user-contacts',
            [
                'modelTPerson' => $modelTPerson,
            ]);
    }

    public function actionCreateSkype() {

        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'skypeScenario']);

        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->createSkype();
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['skype'][0]));
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            }
        }

        return $this->render('__user-contacts',
            [
                'modelTPerson' => $modelTPerson,
                'createSkype' => true
            ]);
    }

    public function actionUpdateSkype($id) {

        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);

        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'skypeScenario']);

        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->saveSkype();
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['skype'][0]));
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            }
        }

        return $this->render('__user-contacts',
            [
                'modelTPerson' => $modelTPerson,
                'updateSkype' => $id
            ]);
    }

    public function actionDeleteSkype($id) {
        TPersonContact::findOne($id)->delete();
        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);
        return $this->render('__user-contacts',
            [
                'modelTPerson' => $modelTPerson,
            ]);
    }

    public function actionCreateSite() {

        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'siteScenario']);

        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->createSite();
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['site'][0]));
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            }
        }

        return $this->render('__user-contacts',
            [
                'modelTPerson' => $modelTPerson,
                'createSite' => true
            ]);
    }

    public function actionUpdateSite($id) {

        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);

        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'siteScenario']);

        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->saveSite();
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['site'][0]));
                return $this->render('__user-contacts',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            }
        }

        return $this->render('__user-contacts',
            [
                'modelTPerson' => $modelTPerson,
                'updateSite' => $id
            ]);
    }

    public function actionDeleteSite($id) {
        TPersonContact::findOne($id)->delete();
        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);
        return $this->render('__user-contacts',
            [
                'modelTPerson' => $modelTPerson,
            ]);
    }

    public function actionCreateBirthdate() {

        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'birthdateScenario']);

        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->createBirthdate();
                return $this->render('__user-about',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['birthdate'][0]));
                return $this->render('__user-about',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            }
        }

        return $this->render('__user-about',
            [
                'modelTPerson' => $modelTPerson,
                'createBirthdate' => true
            ]);
    }

    public function actionUpdateBirthdate($id) {

        $modelTPerson = TPerson::findOne(['user' => Yii::$app->user->id]);

        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'birthdateScenario']);

        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->saveBirthdate();
                return $this->render('__user-about',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['birthdate'][0]));
                return $this->render('__user-about',
                    [
                        'modelTPerson' => $modelTPerson,
                    ]);
            }
        }

        return $this->render('__user-about',
            [
                'modelTPerson' => $modelTPerson,
                'updateBirthdate' => $id
            ]);
    }
}