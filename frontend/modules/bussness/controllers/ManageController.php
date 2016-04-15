<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.04.2016
 * Time: 10:45
 */

namespace frontend\modules\bussness\controllers;

use common\models\TOffice;
use common\models\TOfficeSearch;
use frontend\controllers\BehaviorsController;
use frontend\modules\bussness\models\CompanyForm;
use yii\helpers\Url;

class ManageController extends BehaviorsController
{
    public function actionIndex()
    {
        $modelCompanyForm = new CompanyForm();
        $searchModel = new TOfficeSearch();
        $searchModel->user = \Yii::$app->user->id;
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render(
            'index',
            [
                'modelCompanyForm' => $modelCompanyForm,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
    }

    public function actionCreate()
    {
        $modelCompanyForm = new CompanyForm();
        if($modelCompanyForm->load(\Yii::$app->request->post())) {
            if($idTOffice = $modelCompanyForm->saveBussness()) {
                \Yii::$app->getSession()->setFlash('info', \Yii::t('app', 'Визитка успешно добавлена'));
                return $this->redirect(Url::to(['/bussness/manage/view', 'id' => $idTOffice]));
            } else {
                \Yii::$app->getSession()->setFlash('error', \Yii::t('app', 'Ошибка данных'));
                return $this->render(
                    'index',
                    [
                        'modelCompanyForm' => $this,
                    ]
                );
            }
        }
        return $this->redirect('index');
    }

    public function actionView($id = null)
    {
        if($id) {
            $modelTOffice = TOffice::findOne($id);
            return $this->render(
                'view',
                [
                    'modelTOffice' => $modelTOffice
                ]);
        }
        return $this->redirect('index');
    }
}
