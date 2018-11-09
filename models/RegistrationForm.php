<?php

namespace app\models;

use dektrium\user\traits\ModuleTrait;
use Yii;
use yii\base\Model;
use yii\helpers\url;
use yii\helpers\html;


class RegistrationForm extends \dektrium\user\models\RegistrationForm
{
    /**
     * @var string
     */
    public $captcha;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['captcha', 'required'];
        $rules[] = ['captcha', 'captcha'];
        $rules[] = ['username','required'];
    
        return $rules;
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        /** @var User $user */
        $user = Yii::createObject(User::className());
        $user->setScenario('register');
        $this->loadAttributes($user);

        if (!$user->register()) {
            return false;
        }

        Yii::$app->session->setFlash(
            'info',
            Yii::t('user', 'Your account has been created and a message with further instructions has been sent to your email. Please check Junk/Spam folder if you don’t get the email. Click '  .Html::a('here for the Next Step', ['/'],['style' => 'font-weight:bold; text-decoration:none; color:#40A2E3']))
        );

        return true;
    }
}