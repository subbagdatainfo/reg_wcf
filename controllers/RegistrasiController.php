<?php

namespace app\controllers;

use Yii;
use app\models\Registrasi;
use app\models\Participant;
use app\models\RegistrasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * RegistrasiController implements the CRUD actions for Registrasi model.
 */
class RegistrasiController extends Controller
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
     * Lists all Registrasi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'dashboard';
        $searchModel = new RegistrasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $all_attend = Registrasi::find()->count();
        $all_participant = Participant::find()->where(['participant_status'=>[1,2]])->count();

        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'all_attend'    => $all_attend,
            'all_participant' => $all_participant
        ]);
    }


    public function actionCheck(){

        $this->layout = 'dashboard';

        $searchModel = new RegistrasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return  $this->render('registrasi',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionRegistrasiParticipant($invitation_code){


        $this->layout = 'dashboard';

        // replace tanda kutip 2 " " $_GET invitation_code
        $invitation_code =  str_replace('"','', $invitation_code);




        //menemukan model_participant berdasarkan invitation_code
        //$model_participant = $this->findModelParticipant($invitation_code);


        return  $this->render('registrasi-detail',[
                'model' => $this->findModelParticipant($invitation_code),
            ]);
    }

    /**
     * Displays a single Registrasi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Registrasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAttend($id)
    {
        $model = new Registrasi();
        
            $model->id_participant = $id;

            if($model->save()){
                return $this->redirect('/web/registrasi/check');
            }else{
                print_r($model->getErrors());
            }
    }

    /**
     * Updates an existing Registrasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Registrasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionBadge($id)
    {

        $model = $this->findModelParticipantBadge($id);

        $model->updateCounters(['counter'   => 1]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => [62, 100],
            // portrait orientation
            // 'orientation' => Pdf::ORIENT_PORTRAIT, 
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,

            'marginLeft'    => 0,
            'marginRight'   => 0,
            'marginTop'     => 0,
            'marginBottom'  => 0,
            'marginHeader'  => 0,
            'marginFooter'  => 0,

            // your html content input
            'content' =>  $this->renderPartial('badge', ['model' => $model]),
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssFile' => '@webroot/css/bootstrap.css',
            // 'cssFile' => '@webroot/css/site.css',
            // any css to be embedded if required
            // 'cssInline' => '.tg  {border-collapse:collapse;border-spacing:0;} .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;} .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;} .tg .tg-yw4l{vertical-align:top}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Badge World Culture Forum 2016'],
             // call mPDF methods on the fly
            'methods' => [ 
                //'SetHeader'=>['Date print : '.date("Y/m/d H:i:s")], 
                //'SetFooter'=>['Badge World Culture Forum 2016 for ' . $model->full_name],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }
    /**
     * Finds the Registrasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Registrasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Registrasi::findOne($id)) !== null) {
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

    protected function findModelParticipantBadge($id)
    {
         if (($model = Participant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
