<?php

namespace app\controllers;

use Yii;
use app\models\Companion;
use app\models\CompanionSearch;
use app\models\Companionregistration;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Varietypartisipant;
use dektrium\user\models\User;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

/**
 * CompanionController implements the CRUD actions for Participant model.
 */
class CompanionController extends Controller
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
    public function actionIndex()
    {
    	$this->layout = 'dashboard';

        $searchModel = new CompanionSearch();
        $dataProvider = $searchModel->searchParticipant(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Participant model.
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
     * Creates a new Participant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$this->layout = 'dashboard';

        $model = new Companion();

        if (Yii::$app->request->post()) {

        	// Get id participant from this user
        	$id_participant						= Companion::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

        	$format_invitation_code_selected	= Varietypartisipant::find()->select('format_invitation_code')->where(['group_participant_id' => 7])->asArray()->column();

            // TODO : Get 3 character terakhir                       
            $array_id_companion                 = Varietypartisipant::find()->select('id')->where(['group_participant_id'=>7])->OrderBy('id')->AsArray()->Column();
            $nomor_urut_sekarang                = Companion::find()->where(['variety_id' => $array_id_companion])->OrderBy(['id' => SORT_DESC])->one();
            
            if ($nomor_urut_sekarang) {
                $nomor_urut_terbaru             = substr($nomor_urut_sekarang->invitation_code, -3);
            }else{
                $nomor_urut_terbaru             = 0;
            }

            $model_companion                    = new Companion();
            $model_companion->title             = $_POST["Companion"]["title"];
            $model_companion->full_name         = $_POST["Companion"]["full_name"];
            $model_companion->variety_id        = $array_id_companion[0];
            $model_companion->visit_subak_bali  = FALSE;
            $model_companion->is_companion      = TRUE;
            $model_companion->invitation_code   = $format_invitation_code_selected[0] . sprintf("%'.03d", ((int)$nomor_urut_terbaru + 1));
            $model_companion->token             = rand(111111,999999);
            $model_companion->room_type_id      = 5;
            $model_companion->is_companion      = TRUE;
            $model_companion->is_companion_from = $id_participant->id;

            if ($model_companion->save()) {
                return $this->redirect(['index']);
            }else{
                print_r($model_companion->getErrors());
                die();
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Participant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$this->layout 	= 'dashboard';
    	$model 			= $this->findModelCompanion($id);

    	$identify_id	= Companion::find()->where(['id' => $id])->one();
    	$user_id_login	= Companion::find()->where(['id'=>$identify_id->is_companion_from])->one();

    	if ($identify_id->is_companion_valid == TRUE && $user_id_login->user_id == Yii::$app->user->identity->id) {

	        $symposium_id_1 = Companion::find()->where(['symposium_day_one_id'=> 1])->count();
	        $symposium_id_2 = Companion::find()->where(['symposium_day_one_id'=> 2])->count();
	        $symposium_id_3 = Companion::find()->where(['symposium_day_one_id'=> 3])->count();
	        $symposium_id_4 = Companion::find()->where(['symposium_day_two_id'=> 4])->count();
	        $symposium_id_5 = Companion::find()->where(['symposium_day_two_id'=> 5])->count();
	        $symposium_id_6 = Companion::find()->where(['symposium_day_two_id'=> 6])->count();

	        $symposium_day_one_id_is 	= [];
	        if ($symposium_id_1 < 276) { array_push($symposium_day_one_id_is, 1); };
	        if ($symposium_id_2 < 276) { array_push($symposium_day_one_id_is, 2); };
	        if ($symposium_id_3 < 276) { array_push($symposium_day_one_id_is, 3); };
	        
	        $symposium_day_two_id_is 	= [];
	        if ($symposium_id_4 < 276) { array_push($symposium_day_two_id_is, 4); };
	        if ($symposium_id_5 < 276) { array_push($symposium_day_two_id_is, 5); };
	        if ($symposium_id_6 < 276) { array_push($symposium_day_two_id_is, 6); };

	        $quota_culturalvisit    	= Companion::find()->where(['cultural_visit' => true])->count();

	        if ($model->submit == TRUE) {
	            /***
	             * TODO : IF $model->submit = TRUE
	             * Render ke halaman for reregistrationdisable
	             ***/

	            return $this->render('_form_registration_data_disable', [
	                'model'                 => $model,
	                'user'                  => User::find()->where(['id' => Yii::$app->user->identity->id])->one(),
	                'quota_culturalvisit'   => $quota_culturalvisit,
	                'symposium_day_one_id_is' => $symposium_day_one_id_is,
	                'symposium_day_two_id_is' => $symposium_day_two_id_is
	            ]);

	        }elseif ($model->submit == FALSE) {

	        	if (empty($model->user_photo)) {
	                // tidak_ada_user_photo
	                $model->scenario = 'tidak_ada_user_photo';
	            }
	            if (empty($model->ktp_pasport)) {
	                // tidak_ada_user_photo
	                $model->scenario = 'tidak_ada_ktp_pasport';
	            }
	            if (empty($model->user_photo) && empty($model->ktp_pasport)) {
	                // tidak_ada_user_photo_dan_ktp_pasport
	                $model->scenario = 'tidak_ada_user_photo_dan_ktp_pasport';
	            }

	            //TO DO : Mendapatkan data uploads file
                $tmp_foto           = $model->user_photo;
                $tmp_essay          = $model->essay;
                $tmp_paper          = $model->full_paper;
                $tmp_abstract       = $model->abstract;
                $tmp_presentation   = $model->file_presentation;
	            $tmp_ktp_pasport	= $model->ktp_pasport;

	            if (Yii::$app->request->post()) {

	            	$model->load($_POST);

                    if(UploadedFile::getInstance($model, 'essay')){
                        $model->essay = UploadedFile::getInstance($model, 'essay');
                        move_uploaded_file($model->essay->tempName, Yii::getAlias('@webroot') . '/uploads/essay/'. $model->essay->baseName . '.'.$model->essay->extension);
                        $model->essay =  $model->essay->baseName . '.' . $model->essay->extension;
                    }else{
                        $model->essay =  $tmp_essay;
                    }

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'user_photo')){
                        $model->user_photo = UploadedFile::getInstance($model, 'user_photo');
                        move_uploaded_file($model->user_photo->tempName, Yii::getAlias('@webroot') . '/uploads/user_photo/'. $model->user_photo->baseName . '.'.$model->user_photo->extension);
                        $model->user_photo =  $model->user_photo->baseName . '.' . $model->user_photo->extension;
                    }else{
                        $model->user_photo = $tmp_foto;
                    }

                     // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'ktp_pasport')){
                        $model->ktp_pasport = UploadedFile::getInstance($model, 'ktp_pasport');
                        move_uploaded_file($model->ktp_pasport->tempName, Yii::getAlias('@webroot') . '/uploads/ktp_pasport/'. $model->ktp_pasport->baseName . '.'.$model->ktp_pasport->extension);
                        $model->ktp_pasport =  $model->ktp_pasport->baseName . '.' . $model->ktp_pasport->extension;
                    }else{
                        $model->ktp_pasport = $tmp_ktp_pasport;
                    }


                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'abstract')){
                        $model->abstract = UploadedFile::getInstance($model, 'abstract');
                        move_uploaded_file($model->abstract->tempName, Yii::getAlias('@webroot') . '/uploads/abstract/'. $model->abstract->baseName . '.'.$model->abstract->extension);
                        $model->abstract =  $model->abstract->baseName . '.' . $model->abstract->extension;
                    }else{

                        $model->abstract = $tmp_abstract;
                    }

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'file_presentation')){
                        $model->file_presentation = UploadedFile::getInstance($model, 'file_presentation');
                        move_uploaded_file($model->file_presentation->tempName, Yii::getAlias('@webroot') . '/uploads/presentation/'. $model->file_presentation->baseName . '.'.$model->file_presentation->extension);
                        $model->file_presentation =  $model->file_presentation->baseName . '.' . $model->file_presentation->extension;
                    }else{
                        $model->file_presentation = $tmp_presentation;
                    }

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'full_paper')){
                        $model->full_paper = UploadedFile::getInstance($model, 'full_paper');
                        move_uploaded_file($model->full_paper->tempName, Yii::getAlias('@webroot') . '/uploads/paper/'. $model->full_paper->baseName . '.'.$model->full_paper->extension);
                        $model->full_paper =  $model->full_paper->baseName . '.' . $model->full_paper->extension;
                    }else{
                        $model->full_paper = $tmp_paper;
                    }
                    
                    if (isset($_POST["submitdata"])) {
                        // Submit data
                        $model->submit = TRUE;
                    }elseif (isset($_POST["savedata"])) {
                        // Save data

                        $model->submit = FALSE;
                        \Yii::$app->getSession()->setFlash('save', 'Your data has been save. Thanks for saving to WCF 2016.');
                    }

                    if ($model->save()) {
                        return $this->redirect(['index']);
                    }else{
                    	print_r($model->getErrors());
                    	die();
                        return $this->render('_form_registration_data', [
                            'model'                 	=> $model,
                            'user'                  	=> User::find()->where(['id' => Yii::$app->user->identity->id])->one(),
                            'quota_culturalvisit'   	=> $quota_culturalvisit,
                            'symposium_day_one_id_is' 	=> $symposium_day_one_id_is,
                            'symposium_day_two_id_is' 	=> $symposium_day_two_id_is
                        ]);
                    }

                } else {
                    return $this->render('_form_registration_data', [
                        'model' 					=> $model,
                        'user'						=> User::find()->where(['id' => Yii::$app->user->identity->id])->one(),
                        'quota_culturalvisit'   	=> $quota_culturalvisit,
                        'symposium_day_one_id_is' 	=> $symposium_day_one_id_is,
                        'symposium_day_two_id_is'	=> $symposium_day_two_id_is
                    ]);
                }
	        }
        }else{
        	$this->layout = 'dashboard';
        	throw new NotFoundHttpException('Not permited.');
        }
    }

    /**
     * Tiket undangan
     * $param = user_id
     * jika bukan user login yang meminta maka data tidak bisa di cetak
     **/
    public function actionTicket($id){

        $this->layout = 'dashboard';

        $identify_id	= Companion::find()->where(['id' => $id])->one();
    	$user_id_login	= Companion::find()->where(['id'=>$identify_id->is_companion_from])->one();

    	if ($identify_id->is_companion_valid == TRUE && $identify_id->submit == TRUE && $user_id_login->user_id == Yii::$app->user->identity->id) {

            $model = $this->findModel($id);

            if ($model) {

                if ($model->symposium_day_one_id) {
                    // setup kartik\mpdf\Pdf component
                    $pdf = new Pdf([
                        // set to use core fonts only
                        'mode' => Pdf::MODE_CORE, 
                        // A4 paper format
                        'format' => Pdf::FORMAT_A4, 
                        // portrait orientation
                        // 'orientation' => Pdf::ORIENT_PORTRAIT, 
                        'orientation' => Pdf::ORIENT_LANDSCAPE,
                        // stream to browser inline
                        'destination' => Pdf::DEST_BROWSER, 

                        // your html content input
                        'content' =>  $this->renderPartial('ticket', ['model' => $model]),
                        // format content from your own css file if needed or use the
                        // enhanced bootstrap css built by Krajee for mPDF formatting 
                        // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                        'cssFile' => '@webroot/css/bootstrap.css',
                        // 'cssFile' => '@webroot/css/site.css',
                        // any css to be embedded if required
                        // 'cssInline' => '.tg  {border-collapse:collapse;border-spacing:0;} .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;} .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;} .tg .tg-yw4l{vertical-align:top}', 
                         // set mPDF properties on the fly
                        'options' => ['title' => 'Ticket World Culture Forum 2016'],
                         // call mPDF methods on the fly
                        'methods' => [ 
                            'SetHeader'=>['Date print : '.date("Y/m/d H:i:s")], 
                            'SetFooter'=>['Ticket World Culture Forum 2016 for ' . $model->full_name],
                        ]
                    ]);

                    // return the pdf output as per the destination setting
                    return $pdf->render(); 

                }else{

                    return $this->render('blank');

                }
            }else{

                return $this->render('blank');

            }

        }else{

            return $this->render('blank');

        }
        
    }

    /**
     * Deletes an existing Participant model.
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
     * Finds the Participant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Participant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelCompanion($id)
    {
        if (($model = Companionregistration::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
