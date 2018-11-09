<?php

namespace app\controllers;

use Yii;

class DefaultController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = 'user';

    	$role_user = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
		
		foreach ($role_user as $key => $value) {
		    $role_user = $key;
		}

		if ($role_user !== 'register') {
			if (Yii::$app->user->isGuest) {
				return $this->render('index');
			}else{
				return $this->redirect('/web/dashboard');
			}
		}else{
			return $this->render('index');
		}
    }



}
