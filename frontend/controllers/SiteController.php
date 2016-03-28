<?php
namespace frontend\controllers;

use common\models\Users;
use ffmpeg_movie;
use frontend\models\RegForm;
use Yii;
use common\models\LoginForm;
use frontend\modules\files\components\FilesController;

/**
 * Site controller
 */
class SiteController extends BehaviorsController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $modelUser = Users::findOne([
                'username' => $model->username,
                'old_user' => 1
            ]);
            if($modelUser) {
                \Yii::$app->response->redirect(Yii::$app->authComponent->getLoginUrl().'?return_url='.Yii::$app->urlManager->createAbsoluteUrl(['/user/login-old-user']).'&error_url='.Yii::$app->urlManager->createAbsoluteUrl(['/user/error-login']).'&username='.$model->username.'&password='.$model->password, 301)->send();
            }

            if($model->login()) {
                return $this->redirect('/users/profile/index');
                //return $this->goBack();
            }
        }
            return $this->render('login', [
                'model' => $model,
            ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new RegForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()):

            $smsKeyHash = Yii::$app->session->get('smsKey');
            $smsKey = Yii::$app->getSecurity()->decryptByPassword($smsKeyHash, 'key');

            $smsKeyInput = Yii::$app->request->post('RegForm')['smsKey'];

            if(($smsKeyInput == '')) {
                Yii::$app->getSession()->setFlash('info', Yii::t('app', 'Подтвердите телефон'));
                $model->addError('smsKey', 'Подтвердите телефон');
                $error = 'Подтвердите телефон';
                return $this->render(
                    'reg',
                    [
                        'model' => $model,
                        'error' => $error,
                    ]
                );
            } elseif($smsKeyInput != $smsKey) {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', "Не правильный смс код."));
                $model->addError('smsKey', 'Не правильный смс код');
                $error = 'Не правильный смс код';

                if(Yii::$app->request->post('updateSms') == 0 || Yii::$app->request->post('updateSms') == 1) {
                    $ok = 2;
                    return $this->render(
                        'reg',
                        [
                            'model' => $model,
                            'ok' => $ok,
                            'error' => $error
                        ]
                    );
                }

                Yii::$app->session->remove('smsKey');

                return $this->render(
                    'reg',
                    [
                        'model' => $model,
                        'error' => $error,
                    ]
                );
            };

            if ($model->validate() && ($user = $model->reg())):
                if ($user->status_user === Users::STATUS_ACTIVE):
                    if (Yii::$app->getUser()->login($user)):
                        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Поздравляем! Вы успешно зарегистрировались!'));
                        return $this->redirect('/users/profile/index');
                        //return $this->goHome();
                    endif;
                endif;
            else:
                dd($model->errors);
                return $this->render(
                    'reg',
                    [
                        'model' => $model,
                    ]);
            endif;
        else:
            $errorSms = $model->errors['smsKey'][0];
            Yii::$app->getSession()->setFlash('info', Yii::t('app', $errorSms));
            return $this->render(
                'reg',
                [
                    'model' => $model,
                    'errorSms' => $errorSms
                ]);
        endif;

        return $this->render(
            'reg',
            [
                'model' => $model,
            ]
        );
    }

    public function actionUpdateSms()
    {
        $model = new RegForm();

        if($model->load(Yii::$app->request->post()) && Yii::$app->request->post('updateSms') == 1 ):
            $phone = $model->phone;
            $phone = str_replace([" ", "(", ")", "-", "_"], "", $phone);
            $model->phone = $phone;
            if($model->validate()):
                if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                    //if ($model->smsKey == '') {
                    $phone = $model->phone;
                    $phone = str_replace([" ", "(", ")", "-", "_"], "", $phone);
                    if (iconv_strlen($phone) == 11) {
                        $smsKeyHash = Yii::$app->session->get('smsKey');
                        if(!$smsKeyHash) {
                            $smsKey = rand(1000, 9999);
                            $smsKeyHash = Yii::$app->getSecurity()->encryptByPassword($smsKey, 'key');
                            Yii::$app->session->set('smsKey', $smsKeyHash);
                        } else {
                            $smsKey = Yii::$app->getSecurity()->decryptByPassword($smsKeyHash, 'key');
                        }

                        $sms = Yii::$app->sms;
                        $result = $sms->send_sms($phone, 'Ваш код активации: '.$smsKey);
                        if (!$sms->isSuccess($result)) {
                            $error = $sms->getError($result);
                            Yii::$app->getSession()->setFlash('error', $error);
                            if(Yii::$app->request->post('updateSms') == 0) {
                                $ok = 2;
                                return $this->render(
                                    'reg',
                                    [
                                        'model' => $model,
                                        'ok' => $ok,
                                        'error' => $error,
                                    ]
                                );
                            }

                            return $this->render(
                                'reg',
                                [
                                    'model' => $model,
                                    'error' => $error,
                                ]);
                        }
                        Yii::$app->getSession()->setFlash('info', Yii::t('app', "Вам отправленно СМС сообщение с кодом ктивации."));
                        $ok = 1;
                        return $this->render(
                            'reg',
                            [
                                'model' => $model,
                                'ok' => $ok,
                                'smsKey' => $smsKey
                            ]);


                    } else {
                        Yii::$app->getSession()->setFlash('error', Yii::t('app', "Не правильный номер телефона."));
                        $error = "Не правильный номер телефона";
                        return $this->render(
                            'reg',
                            [
                                'model' => $model,
                                'error' => $error,
                            ]);
                    }
                    //}
                }
            endif;

            return $this->render(
                'reg',
                [
                    'model' => $model,
                ]);
        endif;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $updateSms = 1;
            $ok = 0;

            return $this->render(
                'reg',
                [
                    'model' => $model,
                    'ok' => $ok,
                    'updateSms' => $updateSms
                ]);
        }

        return $this->render(
            'reg',
            [
                'model' => $model,
            ]);
    }

	//Загрузка файлов
	public function actionUploadfiles(){
		if($_POST){
			$duration_video = 15;
			$size_video = 50;
			$size_image = 2;
			
			$ext_video = array("mp4", "mov", "avi", "wmv");
			$ext_file = end(explode(".", $_FILES['upl_file']['name']));
			if(in_array($ext_file, $ext_video)){
				if((($_FILES['upl_file'][size]/1024)/1024) > 50){
					print json_encode(array('errors'=>array('size'=>'Размер видео превышает '.$size_video.' мегабайт.')));
				} else {
					$file = FilesController::uploadFile($_FILES['upl_file'], 2, $errors, array("ext" => array("mp4", "mov", "avi", "wmv")), array());
					if($file){
						$movie = new ffmpeg_movie($_SERVER['DOCUMENT_ROOT'].$file->path);
						if($movie->getDuration() > 15){
							print json_encode(array('errors'=>array('time'=>'Продолжительность видео больше '.$duration_video.' секунд.')));
						} else {
							print json_encode(array('id_file'=>$file->id_file, 'file'=>$file->path, 'original_name'=>$_FILES['upl_file']['name'], "type" => 1));
						}
					} else {
						print json_encode(array('errors'=>$errors));
					}
				}
			} else {
				if((($_FILES['upl_file'][size]/1024)/1024) > $size_image){
					print json_encode(array('errors'=>array('size'=>'Размер изображения превышает '.$size_image.' мегабайта.')));
				} else {
					$file = FilesController::uploadFile($_FILES['upl_file'], 1, $errors, array("ext" => array("gif", "jpg", "png")), array());
					if($file){
						print json_encode(array('id_file'=>$file->id_file, 'file'=>$file->path, 'original_name'=>$_FILES['upl_file']['name'], "type" => 2));
					} else {
						print json_encode(array('errors'=>$errors));
					}
				}
			}
		}
	}

    public function getCurrentUrl() {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return strlen($_SERVER['QUERY_STRING']) ? $pageURL."?".$_SERVER['QUERY_STRING'] : $pageURL;
    }
}
