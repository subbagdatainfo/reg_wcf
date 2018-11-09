<?php

namespace app\controllers;

use Yii;
use app\models\Symposiumguestbook;
use app\models\SymposiumguestbookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use app\models\Participant;
use app\models\Symposium;
use yii\data\ActiveDataProvider;
/**
 * SymposiumGuestBookController implements the CRUD actions for Symposiumguestbook model.
 */
class SymposiumGuestBookController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Symposiumguestbook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SymposiumguestbookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSymposiumSatu(){

        $this->layout = 'dashboard';


        $symposium_satu = Symposium::find()->where(['id' => 1])->one();

        $symposium_guest_count  = Symposiumguestbook::find()->where(['symposium_id' => $symposium_satu->id])->count();


        return  $this->render('registrasi_symposium_satu',[
                'symposium_satu' => $symposium_satu,
                'symposium_guest_count' => $symposium_guest_count
        ]);
    }

    public function actionSymposiumDua(){

        $this->layout = 'dashboard';

        $symposium_dua = Symposium::find()->where(['id' => 2])->one();
        $symposium_guest_count  = Symposiumguestbook::find()->where(['symposium_id' => $symposium_dua->id])->count();


        return  $this->render('registrasi_symposium_dua',[
                'symposium_dua' => $symposium_dua,
                'symposium_guest_count' => $symposium_guest_count,
        ]);
    }

    public function actionSymposiumTiga(){

        $this->layout = 'dashboard';

        $symposium_tiga = Symposium::find()->where(['id' => 3])->one();
        $symposium_guest_count  = Symposiumguestbook::find()->where(['symposium_id' => $symposium_tiga->id])->count();


        return  $this->render('registrasi_symposium_tiga',[
                'symposium_tiga' => $symposium_tiga,
                'symposium_guest_count' => $symposium_guest_count,
        ]);
    }

    public function actionSymposiumEmpat(){

        $this->layout = 'dashboard';


        $symposium_empat = Symposium::find()->where(['id' => 4])->one();
        $symposium_guest_count  = Symposiumguestbook::find()->where(['symposium_id' => $symposium_empat->id])->count();

        return  $this->render('registrasi_symposium_empat',[
                'symposium_empat' => $symposium_empat,
                'symposium_guest_count' => $symposium_guest_count,
        ]);
    }

    public function actionSymposiumLima(){

        $this->layout = 'dashboard';

        $symposium_lima = Symposium::find()->where(['id' => 5])->one();
        $symposium_guest_count  = Symposiumguestbook::find()->where(['symposium_id' => $symposium_lima->id])->count();


        return  $this->render('registrasi_symposium_lima',[
                'symposium_lima' =>  $symposium_lima,
                'symposium_guest_count' => $symposium_guest_count,
        ]);
    }

    public function actionSymposiumEnam(){

        $this->layout = 'dashboard';

        $symposium_enam = Symposium::find()->where(['id' => 6])->one();
        $symposium_guest_count  = Symposiumguestbook::find()->where(['symposium_id' => $symposium_enam->id])->count();


        return  $this->render('registrasi_symposium_enam',[
                'symposium_enam' => $symposium_enam,
                'symposium_guest_count' => $symposium_guest_count,
        ]);
    }



    //Function yang menangani input from ticket with scan barcode

    public function actionRegister($id,$invitation_code){


        $this->layout = 'dashboard';
        
        // replace tanda kutip 2 " " $_GET invitation_code
        $invitation_code =  str_replace('"','', $invitation_code);

        

        $model_participant =  Participant::find()->where(['invitation_code' => $invitation_code])->one();


        if(!empty($model_participant)){


            $model = new Symposiumguestbook();

            $model->participant_id  = $model_participant->id;
            $model->symposium_id    = $id;


            $model->save();
        }else{
            throw new NotFoundHttpException('Data Peserta Yang Anda Cari Tidak Ada.');
        }

        return  $this->redirect(['registration-detail', 'id'  => $id,'invitation_code' => $invitation_code]);

    }

    public function actionRegisterHariPertama($id,$invitation_code){


        $this->layout = 'dashboard';
        
        // replace tanda kutip 2 " " $_GET invitation_code
        $invitation_code =  str_replace('"','', $invitation_code);

        

        $model_participant =  Participant::find()->where(['invitation_code' => $invitation_code,'participant_status' => [1,2]])->one();

        if(!empty($model_participant)){
            if($model_participant->symposium_day_one_id != $id){


                \Yii::$app->getSession()->setFlash('error', 'Maaf Anda Tidak Terdaftar Di Symposium Ini');
                return $this->render('_blank',['model_participant' => $model_participant]);    


            }elseif(!empty($model_participant)){


                $model = new Symposiumguestbook();

                $model->participant_id  = $model_participant->id;
                $model->symposium_id    = $id;


                $model->save();
            }else{
                throw new NotFoundHttpException('Data Peserta Yang Anda Cari Tidak Ada.');
            }
        }else{
            \Yii::$app->getSession()->setFlash('error_kedua', 'Participant ini terdaftar, tetapi tidak lolos seleksi');
            return $this->render('_blank_participant_pertama');
        }

        return  $this->redirect(['registration-detail', 'id'  => $id,'invitation_code' => $invitation_code]);

    }


    public function actionRegisterHariKedua($id,$invitation_code){


        $this->layout = 'dashboard';
        
        // replace tanda kutip 2 " " $_GET invitation_code
        $invitation_code =  str_replace('"','', $invitation_code);

        

        $model_participant =  Participant::find()->where(['invitation_code' => $invitation_code,'participant_status' => [1,2]])->one();


        if(!empty($model_participant)){
            if($model_participant->symposium_day_two_id != $id){


                \Yii::$app->getSession()->setFlash('error', 'Maaf Anda Tidak Terdaftar Di Symposium Ini');
                return $this->render('_blankdua',['model_participant' => $model_participant]);


            }elseif(!empty($model_participant)){


                $model = new Symposiumguestbook();

                $model->participant_id  = $model_participant->id;
                $model->symposium_id    = $id;


                $model->save();
            }else{
                throw new NotFoundHttpException('Data Peserta Yang Anda Cari Tidak Ada.');
            }
        }else{
           \Yii::$app->getSession()->setFlash('error_kedua', 'Participant ini terdaftar, tetapi tidak lolos seleksi');
            return $this->render('_blank_participant_pertama');
        }
        return  $this->redirect(['registration-detail', 'id'  => $id,'invitation_code' => $invitation_code]);

    }

    //Function untuk menampilkan detail peserta dan symposium yang di daftarkan

    public function actionRegistrationDetail($id, $invitation_code){


        $this->layout = 'dashboard';
        $model_participant =  Participant::find()->where(['invitation_code' => $invitation_code])->one();

        //Query untuk memasukan participant kedalam symposium_guest_book

        $symposium_guest        = Symposium::find()->where(['id'    => $id])->one();
        $symposium_guest_count  = Symposiumguestbook::find()->where(['symposium_id' => $id])->count();


        //query listing symposium_guest_book


        return  $this->render('registrasi-detail',[
            'symposium_guest'       => $symposium_guest,
            'symposium_guest_count' => $symposium_guest_count,
            'model_participant'     => $model_participant,
        ]);

    }

    public function actionListSymposium($id){

        $this->layout = 'dashboard';


        $symposiumguestbook =  Symposiumguestbook::find()->where(['symposium_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $symposiumguestbook,
            'pagination' => array('pageSize' => 10),
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);


    }


    /**
     * Displays a single Symposiumguestbook model.
     * @param integer $id
     * @return mixed
     */
    /*public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Creates a new Symposiumguestbook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   /* public function actionCreate()
    {
        $model = new Symposiumguestbook();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Updates an existing Symposiumguestbook model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Deletes an existing Symposiumguestbook model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the Symposiumguestbook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Symposiumguestbook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Symposiumguestbook::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelParticipant($invitation_code)
    {
        if (($model = Participant::find()->where(['invitation_code' => $invitation_code])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Data Peserta Yang Anda Cari Tidak Ada.');
        }
    }
}
