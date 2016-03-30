<?php
/**
 * Created by phpNT.
 * User: phpNT
 * Date: 24.03.2016
 * Time: 13:09
 */

namespace common\widgets\UserDataWidget;

use common\models\TPerson;
use common\models\TPersonContact;
use Yii;
use yii\base\Widget;
use common\widgets\UserDataWidget\models\ContactsForm;

class UserDataWidget extends Widget
{
    public $id;
    public $offset = 0;
    public $showContactForm = false;
    public $modelContactsForm = false;
    public $phoneCount = 1;

    public function init()
    {
        if(!$this->modelContactsForm) {
            $this->modelContactsForm = new ContactsForm();
        }
        parent::init();
    }

    public function run()
    {
        /* @var $user \common\models\Users */
        $user = Yii::$app->user->identity;
        //dd($user->phonesList);
        $modelTPersonContact = new TPersonContact();

        return $this->render(
            'view',
            [
                'widget' => $this,
            ]);
    }
}
