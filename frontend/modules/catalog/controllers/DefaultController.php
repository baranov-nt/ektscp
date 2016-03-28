<?php

namespace frontend\modules\catalog\controllers;

use common\models\TOffice;
use common\models\TOfficeSearch;
use Yii;
use yii\web\Controller;
use frontend\modules\catalog\models\CatalogForm;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new TOfficeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdd()
    {
        $modelTOffice = new TOffice();

        if ($modelTOffice->load(Yii::$app->request->post())) {
            $modelTOffice = $modelTOffice->saveCard();
            if(!$modelTOffice->errors) {
                Yii::$app->session->setFlash('info', 'Визитка успешно добавлена.');
                return $this->redirect(['update', 'id' => $modelTOffice->id_office]);
            }

            Yii::$app->session->setFlash('error', 'Ошибка. Проверте поля формы.');
        }

        return $this->render(
            'add',
            [
                'modelTOffice' => $modelTOffice
            ]
        );
    }

    public function actionUpdate($id)
    {
        //dd(Yii::$app->request->post());
        $modelTOffice = $this->findModel($id);

        if ($modelTOffice->load(Yii::$app->request->post())) {
            $modelTOffice = $modelTOffice->saveCard();
            if(!$modelTOffice->errors) {
                Yii::$app->session->setFlash('info', 'Визитка успешно изменена.');
            } else {
                $errors = '<br>';
                foreach($modelTOffice->errors as $one) {
                    $errors .= $one[0].'<br>';
                }
                Yii::$app->session->setFlash('error', Yii::t('app', 'Ошибка:').$errors);
            }
        }

        return $this->render(
            'add',
            [
                'modelTOffice' => $modelTOffice
            ]
        );
    }

    public function actionIcons()
    {
        return $this->render('icons');
    }
	
    public function actionTest()
    {
        return $this->render('_map');
    }

    /**
     * Finds the AdRealEstate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TOffice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($modelTOffice = TOffice::findOne(
                [
                    'id_office' => $id,
                    'subtype' => 1
                ])) !== null) {
            return $modelTOffice;
        } else {
            throw new NotFoundHttpException('Запрашиваемая визитка не найдена.');
        }
    }
}
