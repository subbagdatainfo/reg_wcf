<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Hotel;
use app\models\HotelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Participant;
use app\models\Participantsearchhotel;
use app\models\Participantselection;
/**
 * HotelController implements the CRUD actions for Hotel model.
 */
class HotelController extends Controller
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
     * Lists all Hotel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'dashboard';
        $searchModel = new HotelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // ----------------------------------------------------PUBLIC LOCAL PARTICIPANT HOTEL----------------------------------------------------
    public function actionParticipantHotel()
    {
        $this->layout = 'dashboard';

        if (isset($_POST['hasEditable'])) {

            $id         = $_POST['editableKey'];
            $attribut   = $_POST['editableAttribute'];
            foreach ($_POST['Participant'] as $key => $value) {
                $value      = $_POST['Participant'][$key][$attribut];
            }
            $model  = Participantselection::findOne($id);

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        

            $model->hotel_id = $value;

            $hotel = Hotel::findOne($value);

            if ($model->save()) {
                // return JSON encoded output in the below format
                return ['output'=>$hotel->hotel_name, 'message'=>''];
            }else{
                // alternatively you can return a validation error
                return ['output'=>'', 'message'=>$model->getErrors()];
            }
        }

        $searchModel = new Participantsearchhotel();
        $dataProvider = $searchModel->searchHotelPublicParticipantLocal(Yii::$app->request->queryParams);


        return $this->render('participant-public', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    //-----------------------------------PUBLIC INTERNATIONAL PARTICIPANT HOTEL------------------------------------------------------
    public function actionParticipantHotelInternational()
    {
        $this->layout = 'dashboard';

        if (isset($_POST['hasEditable'])) {

            $id         = $_POST['editableKey'];
            $attribut   = $_POST['editableAttribute'];
            foreach ($_POST['Participant'] as $key => $value) {
                $value      = $_POST['Participant'][$key][$attribut];
            }
            $model  = Participantselection::findOne($id);

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        

            $model->hotel_id = $value;

            $hotel = Hotel::findOne($value);

            if ($model->save()) {
                // return JSON encoded output in the below format
                return ['output'=>$hotel->hotel_name, 'message'=>''];
            }else{
                // alternatively you can return a validation error
                return ['output'=>'', 'message'=>$model->getErrors()];
            }
        }

        $searchModel = new Participantsearchhotel();
        $dataProvider = $searchModel->searchHotelPublicParticipantInternational(Yii::$app->request->queryParams);


        return $this->render('participant-public', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    //-----------------------------------PUBLIC INVITED LOCAL PARTICIPANT HOTEL------------------------------------------------------

    public function actionParticipantLocalInvited()
    {
        $this->layout = 'dashboard';

        if (isset($_POST['hasEditable'])) {

            $id         = $_POST['editableKey'];
            $attribut   = $_POST['editableAttribute'];
            foreach ($_POST['Participant'] as $key => $value) {
                $value      = $_POST['Participant'][$key][$attribut];
            }
            $model  = Participantselection::findOne($id);

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        

            $model->hotel_id = $value;

            $hotel = Hotel::findOne($value);

            if ($model->save()) {
                // return JSON encoded output in the below format
                return ['output'=>$hotel->hotel_name, 'message'=>''];
            }else{
                // alternatively you can return a validation error
                return ['output'=>'', 'message'=>$model->getErrors()];
            }
        }

        $searchModel = new Participantsearchhotel();
        $dataProvider = $searchModel->searchInvitedLocal(Yii::$app->request->queryParams);


        return $this->render('participant-invited', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    //-----------------------------------PUBLIC INVITED INTERNATIONAL PARTICIPANT HOTEL------------------------------------------------------
    public function actionParticipantInternationalInvited()
    {
        $this->layout = 'dashboard';

        if (isset($_POST['hasEditable'])) {

            $id         = $_POST['editableKey'];
            $attribut   = $_POST['editableAttribute'];
            foreach ($_POST['Participant'] as $key => $value) {
                $value      = $_POST['Participant'][$key][$attribut];
            }
            $model  = Participantselection::findOne($id);

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        

            $model->hotel_id = $value;

            $hotel = Hotel::findOne($value);

            if ($model->save()) {
                // return JSON encoded output in the below format
                return ['output'=>$hotel->hotel_name, 'message'=>''];
            }else{
                // alternatively you can return a validation error
                return ['output'=>'', 'message'=>$model->getErrors()];
            }
        }

        $searchModel = new Participantsearchhotel();
        $dataProvider = $searchModel->searchInvitedInternational(Yii::$app->request->queryParams);


        return $this->render('participant-invited', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hotel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'dashboard';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Hotel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'dashboard';
        $model = new Hotel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Hotel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'dashboard';
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
     * Deletes an existing Hotel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Hotel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hotel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hotel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
