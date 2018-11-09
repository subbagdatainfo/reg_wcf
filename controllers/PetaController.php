<?php

namespace app\controllers;
use Yii;

class PetaController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = 'dashboard';
    	
        return $this->render('index');
    }

}
