<?php

namespace app\controllers;
use Yii;

class StatistikController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = 'dashboard';
    	
        return $this->render('index');
    }

}
