<?php

namespace app\models;
use cakebake\actionlog\model\ActionLog;
use dektrium\user\helpers\Password;
use dektrium\user\models\Token;
use dektrium\user\models\User as BaseUser;
use yii\behaviors\TimestampBehavior;
use yii\log\Logger;
use Yii;
use yii\helpers\Url;

class User extends BaseUser
{
     public function register()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $this->confirmed_at = $this->module->enableConfirmation ? null : time();
        $this->password     = $this->module->enableGeneratingPassword ? Password::generate(8) : $this->password;

        $this->trigger(self::BEFORE_REGISTER);

        if (!$this->save()) {
            return false;
        }

        if ($this->module->enableConfirmation) {
            /** @var Token $token */
            $token = Yii::createObject(['class' => Token::className(), 'type' => Token::TYPE_CONFIRMATION]);
            $token->link('user', $this);
        }

        $this->mailer->sendWelcomeMessage($this, isset($token) ? $token : null);
        $this->trigger(self::AFTER_REGISTER);

        // the following three lines were added:
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('register');
        $auth->assign($authorRole, $this->id);

        return true;
    }

    public function attemptConfirmation($code)
    {
        $token = $this->finder->findTokenByParams($this->id, $code, Token::TYPE_CONFIRMATION);

        if ($token instanceof Token && !$token->isExpired) {
            $token->delete();
            if (($success = $this->confirm())) {
                Yii::$app->user->login($this, $this->module->rememberFor);
                $message = Yii::t('user', 'Thank you, your account has been confirmed. Please fill registration data by clicking button below.<br><br><a href="'.Url::to(['/']).'" class="btn btn-success">Next Step</a>');
            } else {
                $message = Yii::t('user', 'Something went wrong and your account has not been confirmed.');
                
            }
        } else {
            $success = false;
            $message = Yii::t('user', 'The confirmation link is invalid or expired. Please try requesting a new one.'.'
                <br>
                <br>

                <a href="'.Url::to(['/']).'" class="btn btn-danger">Next Step</a>');
        }

        Yii::$app->session->setFlash($success ? 'success' : 'danger', $message);

        return $success;
    }
}