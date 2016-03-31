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
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'phoneScenario']);

        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate() && $modelDataFieldsForm->createPhone()) {
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно добавленны'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['phone'][0]));
            }
            $this->renderManual('__user-contacts');
        }

        $this->renderManual('__user-contacts', 'createPhone', true);
    }

    public function actionUpdatePhone($id) {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'phoneScenario']);

        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate() && $modelDataFieldsForm->savePhone()) {
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно изменены'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['phone'][0]));
            }
            $this->renderManual('__user-contacts');
        }
        $this->renderManual('__user-contacts', 'updatePhone', $id);
    }

    public function actionDeletePhone($id) {
        TPersonContact::findOne($id)->delete();
        Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно удалены'));
        $this->renderManual('__user-contacts');
    }

    public function actionCreateEmail() {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'emailScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->createEmail();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно добавленны'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['email'][0]));
            }
            $this->renderManual('__user-contacts');
        }
        $this->renderManual('__user-contacts', 'createEmail', true);
    }

    public function actionUpdateEmail($id) {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'emailScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->saveEmail();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно изменены'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['email'][0]));
            }
            $this->renderManual('__user-contacts');
        }
        $this->renderManual('__user-contacts', 'updateEmail', $id);
    }

    public function actionDeleteEmail($id) {
        TPersonContact::findOne($id)->delete();
        Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно удалены'));
        $this->renderManual('__user-contacts');
    }

    public function actionCreateSkype() {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'skypeScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->createSkype();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно добавленны'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['skype'][0]));
            }
            $this->renderManual('__user-contacts');
        }
        $this->renderManual('__user-contacts', 'createSkype', true);
    }

    public function actionUpdateSkype($id) {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'skypeScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->saveSkype();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно изменены'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['skype'][0]));
            }
            $this->renderManual('__user-contacts');
        }
        $this->renderManual('__user-contacts', 'updateSkype', $id);
    }

    public function actionDeleteSkype($id) {
        TPersonContact::findOne($id)->delete();
        Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно удалены'));
        $this->renderManual('__user-contacts');
    }

    public function actionCreateSite() {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'siteScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->createSite();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно добавленны'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['site'][0]));
            }
            $this->renderManual('__user-contacts');
        }
        $this->renderManual('__user-contacts', 'createSite', true);
    }

    public function actionUpdateSite($id) {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'siteScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->saveSite();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно изменены'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['site'][0]));
            }
            $this->renderManual('__user-contacts');
        }
        $this->renderManual('__user-contacts', 'updateSite', $id);
    }

    public function actionDeleteSite($id) {
        TPersonContact::findOne($id)->delete();
        Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно удалены'));
        $this->renderManual('__user-contacts');
    }

    public function actionCreateBirthdate() {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'birthdateScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->createBirthdate();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно добавленны'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['birthdate'][0]));
            }
            $this->renderManual('__user-about');
        }
        $this->renderManual('__user-about', 'createBirthdate', true);
    }

    public function actionUpdateBirthdate($id) {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'birthdateScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->saveBirthdate();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно изменены'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['birthdate'][0]));
            }
            $this->renderManual('__user-about');
        }
        $this->renderManual('__user-about', 'updateBirthdate', $id);
    }

    public function actionCreateGender() {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'genderScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->createGender();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно добавленны'));
                $this->renderManual('__user-about', 'successCreateGender', true);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['gender'][0]));
                $this->renderManual('__user-about');
            }
        }
        $this->renderManual('__user-about', 'createGender', true);
    }

    public function actionUpdateGender($id) {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'genderScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->saveGender();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно изменены'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['gender'][0]));
            }
            $this->renderManual('__user-about');
        }
        $this->renderManual('__user-about', 'updateGender', $id);
    }

    public function actionCreateMarital() {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'maritalScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->createMarital();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно добавленны'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['marital'][0]));
            }
            $this->renderManual('__user-about');
        }
        $this->renderManual('__user-about', 'createMarital', true);
    }

    public function actionUpdateMarital($id) {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'maritalScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->saveMarital();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно изменены'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['marital'][0]));
            }
            $this->renderManual('__user-about');
        }
        $this->renderManual('__user-about', 'updateMarital', $id);
    }

    public function actionCreateChildren() {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'childrenScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->createChildren();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно добавленны'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['children'][0]));
            }
            $this->renderManual('__user-about');
        }
        $this->renderManual('__user-about', 'createChildren', true);
    }

    public function actionUpdateChildren($id) {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'childrenScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->saveChildren();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно изменены'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['children'][0]));
            }
            $this->renderManual('__user-about');
        }
        $this->renderManual('__user-about', 'updateChildren', $id);
    }

    public function actionCreateBirthcity() {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'birthcityScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->createBirthcity();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно добавленны'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['birthcity'][0]));
            }
            $this->renderManual('__user-about');
        }
        $this->renderManual('__user-about', 'createBirthcity', true);
    }

    public function actionUpdateBirthcity($id) {
        $modelDataFieldsForm = new DataFieldsForm(['scenario' => 'birthcityScenario']);
        if($modelDataFieldsForm->load(Yii::$app->request->post())) {
            if($modelDataFieldsForm->validate()) {
                $modelDataFieldsForm->saveBirthcity();
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Данные успешно изменены'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', $modelDataFieldsForm->errors['birthcity'][0]));
            }
            $this->renderManual('__user-about');
        }
        $this->renderManual('__user-about', 'updateBirthcity', $id);
    }

    private function renderManual($render, $sendProperty = false, $value = false) {
        if($sendProperty && $value) {
            return $this->render($render,
                [
                    $sendProperty => $value
                ]);
        }
        return $this->render($render);
    }
}