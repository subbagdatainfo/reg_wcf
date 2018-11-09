<?php

namespace app\controllers;
use app\models\OpeningCeremonyGuestbook;
use app\models\Participant;
use yii\data\ActiveDataProvider;

class OpeningRegistrasiController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = 'dashboard';

    	$count  = OpeningCeremonyGuestbook::find()->count();

        return $this->render('index',[
        	'count' => $count
        ]);
    }

    public function actionRegister($invitation_code){

        $this->layout = 'dashboard';
        
        // replace tanda kutip 2 " " $_GET invitation_code
        $invitation_code =  str_replace('"','', $invitation_code);

        $model_participant =  Participant::find()->where(['invitation_code' => $invitation_code,'participant_status' => [1,2]])->one();

        if(!empty($model_participant)){

            if(!empty($model_participant)){

                $model = new OpeningCeremonyGuestbook();

                $model->id_particpant  = $model_participant->id;

                if ($model->save()) {
                	return  $this->redirect(['registration-detail', 'invitation_code' => $invitation_code]);
                }
            }else{
                throw new NotFoundHttpException('Data Peserta Yang Anda Cari Tidak Ada.');
            }
        }else{
            \Yii::$app->getSession()->setFlash('error_kedua', 'Participant ini terdaftar, tetapi tidak lolos seleksi');
            return $this->render('_blank');
        }
    }

    public function actionRegistrationDetail($invitation_code){


        $this->layout = 'dashboard';
        $model_participant =  Participant::find()->where(['invitation_code' => $invitation_code,'participant_status' => [1,2]])->one();

        //Query untuk memasukan participant kedalam symposium_guest_book
        $count  = OpeningCeremonyGuestbook::find()->count();

        //query listing symposium_guest_book
        return  $this->render('registrasi-detail',[
            'count' => $count,
            'model_participant'     => $model_participant,
        ]);
    }

    public function actionList(){

        $this->layout = 'dashboard';

        $symposiumguestbook =  OpeningCeremonyGuestbook::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $symposiumguestbook,
            'pagination' => array('pageSize' => 10),
        ]);

        return $this->render('list', ['dataProvider' => $dataProvider]);
    }

}
