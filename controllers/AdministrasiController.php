<?php

namespace app\controllers;

use Yii;
use app\models\Participantadministrasi;
use app\models\ParticipantadministrasiSearch;
use app\models\ParticipantSearch;
use app\models\Participant;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AttendController implements the CRUD actions for Attend model.
 */
class AdministrasiController extends Controller
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
     * Lists all Attend models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'dashboard';

        $searchModel = new ParticipantadministrasiSearch();
        $dataProvider = $searchModel->searchAdministrasi(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAllDataAdministrasi()
    {
        $this->layout = 'dashboard';

        $searchModel = new ParticipantadministrasiSearch();
        $dataProvider = $searchModel->searchAdministrasibadge(Yii::$app->request->queryParams);

        return $this->render('all-data-administrasi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPaid($id)
    {
        $model = $this->findModel($id);

        $model->status_subsidi = TRUE;

        $model->save();

        return $this->redirect(Yii::$app->request->referrer);

        /*return $this->redirect(['index']);*/

    }

  
    public function actionUnPaid($id)
    {
        $model = $this->findModel($id);

        $model->status_subsidi = FALSE;

        $model->save();
        return $this->redirect(Yii::$app->request->referrer);

        /*return $this->redirect(['index']);*/
    }


    //export local
    public function actionExportLocalInvited()
    {
        $this->layout   = 'dashboard';

        $searchModel    = new ParticipantadministrasiSearch();
        $dataProvider   = $searchModel->searchAdministrasiLocalInvited(Yii::$app->request->queryParams);

        return $this->render('export-local-invited', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportLocalPublic()
    {
        $this->layout   = 'dashboard';
        
        $searchModel    = new ParticipantadministrasiSearch();
        $dataProvider   = $searchModel->searchAdministrasiExportLocal(Yii::$app->request->queryParams);

        return $this->render('export-local-public', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionScan()
    {
        $this->layout = 'dashboard';

        return  $this->render('administrasi-scan-barcode');
    }

    public function actionScanBarcode($invitation_code)
    {
        $this->layout = 'dashboard';
        // replace tanda kutip 2 " " $_GET invitation_code
        $invitation_code =  str_replace('"','', $invitation_code);



        $searchModel    = new ParticipantSearch();
        $searchModel->invitation_code = $invitation_code;
        $dataProvider   = $searchModel->search(Yii::$app->request->queryParams);

        return  $this->render('show-participant',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    //export international ** TIDAK DIGUNAKAN DIJADIKAN 1 DALAM ACTION LOCALINVITE
   /*public function actionExportInternationalInvited()
    {
        $this->layout   = 'dashboard';

        $searchModel    = new ParticipantadministrasiSearch();
        $dataProvider   = $searchModel->searchAdministrasiInternationalinvited(Yii::$app->request->queryParams);

        return $this->render('export-international-invited', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    public function actionExportInternationalPublic()
    {
        $this->layout   = 'dashboard';
        
        $searchModel    = new ParticipantadministrasiSearch();
        $dataProvider   = $searchModel->searchAdministrasiExportInternational(Yii::$app->request->queryParams);

        return $this->render('export-international-public', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Attend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Participantadministrasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
