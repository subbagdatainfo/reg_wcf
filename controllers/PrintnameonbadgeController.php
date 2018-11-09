<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Participant;
use app\models\Participantbadge;
use app\models\ParticipantSearch;
use app\models\Varietypartisipant;
use app\models\Symposium;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;


/**
 * ParticipantController implements the CRUD actions for Participant model.
 */
class PrintnameonbadgeController extends Controller
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
     * Lists all Participant models.
     * @return mixed
     */

    public function actionPrint($invitation_code)
    {
        $this->layout = 'dashboard';
        $invitation_code =  str_replace('"','', $invitation_code);
        if (isset($_POST['hasEditable'])) {

            $id         = $_POST['editableKey'];
            $attribut   = $_POST['editableAttribute'];
            foreach ($_POST['Participant'] as $key => $value) {
                $value      = $_POST['Participant'][$key][$attribut];
            }

            $model  = Participantbadge::findOne($id);

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            
            $model->name_on_badge = $value;


            if ($model->save()) {
                // return JSON encoded output in the below format
                return ['output'=>$value, 'message'=>''];
            }else{
                // alternatively you can return a validation error
                return ['output'=>'', 'message'=>$model->getErrors()];
            }
        }

        $searchModel = new ParticipantSearch();
        $searchModel->invitation_code = $invitation_code;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('data-participant', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionNameOnBadge()
    {
        $this->layout = 'dashboard';

        return $this->render('index');
    }

    public function actionBadge($id)
    {

        $model = $this->findModel($id);
        $model->updateCounters(['counter' => 1]);
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
     * Finds the Participant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Participant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Participant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelByUserID($id)
    {
        if (($model = Participant::find()->where(['user_id' => $id])->one()) !== null) {
            return $model;
        }
    }

    protected function findModelByToken($token)
    {
        if (($model = Participant::find()->where(['token' => $token])->one()) !== null) {
            return $model;
        }
    }

    protected function findModelByUserRegistrationID($id)
    {
        if (($model = Participantregistration::find()->where(['user_id' => $id])->one()) !== null) {
            return $model;
        }
    }

    protected function findModelByUserRegistrationPublic($id)
    {
        if (($model = Participantpublic::find()->where(['user_id' => $id])->one()) !== null) {
            return $model;
        }
    }
}
