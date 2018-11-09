<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Participant;
use app\models\Participantpublic;
use app\models\Participantregistration;
use app\models\ParticipantSearch;
use app\models\Varietypartisipant;
use app\models\Symposium;
use app\models\Representative;
use app\models\RegistrasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;
use dektrium\user\models\User;
use yii\rbac\DbManager;

/**
 * ParticipantController implements the CRUD actions for Participant model.
 */
class ParticipantController extends Controller
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
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionSymposium()
    {
        $this->layout = 'dashboard';
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchSymposiumparticipant(Yii::$app->request->queryParams);

        return $this->render('all-data-participant-symposium', [
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
        $model = new Participant();

        if (Yii::$app->request->post()) {

            if ($_POST['Participant']['variety_id']) {

                $format_invitation_code_selected = Varietypartisipant::find()->select('format_invitation_code')->where(['id' => $_POST['Participant']['variety_id']])->asArray()->column();

                // TODO : Get 3 character terakhir
                $nomor_urut_sekarang = Participant::find()->where(['variety_id' => $_POST['Participant']['variety_id']])->OrderBy(['id' => SORT_DESC])->one();
                if ($nomor_urut_sekarang) {
                    $nomor_urut_terbaru = substr($nomor_urut_sekarang->invitation_code, -3);
                }else{
                    $nomor_urut_terbaru = 0;
                }

                // TODO : Count participant where variety_id = selected
                $nomor_urut = Participant::find()->where(['variety_id' => $_POST['Participant']['variety_id']])->count();

                $model->load($_POST);

                // TODO : SELECT category Symposium & get ID
                $get_ID = Varietypartisipant::find()->select('id')->where(['like', 'variety', 'Symposium'])->column();

                // TODO : Kondisi ketika category terpilih adalah sama dengan category Symposium maka subak visit = TRUE
                if (in_array($_POST['Participant']['variety_id'], $get_ID)) {
                    $model->visit_subak_bali     = TRUE;
                }else{
                    $model->visit_subak_bali     = FALSE;
                }
                $model->participant_status  = 1;

                $model->invitation_code = $format_invitation_code_selected[0] . sprintf("%'.03d", ((int)$nomor_urut_terbaru + 1));
                $model->token           = rand(111111,999999);

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionApplicationStatus()
    {
        $this->layout = 'dashboard';

        return $this->render('status');

    }


    public function actionRegistration($id = FALSE)
    {
        $this->layout = 'dashboard';

        if (isset($_GET["id"])) {
            $model = $this->findModelByUserRegistrationPublic($_GET["id"]);
            $model_user_photo = $model->user_photo;
            $model_essay = $model->essay;

            if (empty($model->essay)) {
                // tidak_ada_user_photo_dan_ktp_pasport
                $model->scenario = 'tidak_ada_essay';
            }
        }else{
            $model = new Participantpublic();
            $model_user_photo = $model->user_photo;
            $model_essay = $model->essay;
            $model->scenario = 'tidak_ada_essay';
        }

        // $model->scenario = 'create';

        $id     = Yii::$app->user->identity->id;

        $user   = User::find()->where(['id' => $id])->one();

        if ($model->submit == TRUE) {
            
            return $this->render('submit', [
                'model' => $model,
                'user'  => $user,
            ]);

        }else{

            if (Yii::$app->request->post()) {
            
                if (isset($_POST["submitdata"])) {

                    // Ketika submit 

                    if ($_POST["Participantpublic"]["nationality"] == 101) {
                        // NATIONAL PUBLIC PARTICIPANTS
                        $model->variety_id = 35;
                    }else{
                        // International Open Public Participants
                        $model->variety_id = 19;
                    }

                    $format_invitation_code_selected = Varietypartisipant::find()->select('format_invitation_code')->where(['id' => $model->variety_id])->asArray()->column();

                    // TODO : Get 3 character terakhir
                    $nomor_urut_sekarang = Participant::find()->where(['variety_id' => $model->variety_id])->OrderBy(['id' => SORT_DESC])->one();
                    if ($nomor_urut_sekarang) {
                        $nomor_urut_terbaru = substr($nomor_urut_sekarang->invitation_code, -3);
                    }else{
                        $nomor_urut_terbaru = 0;
                    }

                    // TODO : Count participant where variety_id = selected
                    $nomor_urut = Participant::find()->where(['variety_id' => $model->variety_id])->count();

                    $model->load($_POST);

                    $model->speaker             = FALSE;
                    $model->visit_subak_bali    = FALSE;
                    $model->participant_status  = 3;

                    $model->invitation_code     = $format_invitation_code_selected[0] . sprintf("%'.03d", ((int)$nomor_urut_terbaru + 1));
                    $model->token               = rand(111111,999999);
                    $model->user_id             = $id;

                    $microtime                  = str_replace(['.'], [''], microtime(true));

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'essay')){
                        $model->essay = UploadedFile::getInstance($model, 'essay');
                        move_uploaded_file($model->essay->tempName, Yii::getAlias('@webroot') . '/uploads/essay/'. ( $microtime + 555 ) . '_' . $model->essay->baseName . '.'.$model->essay->extension);
                        $model->essay = ( $microtime + 555 ) . '_' . $model->essay->baseName . '.' . $model->essay->extension;
                    }else{
                        $model->essay = $model_essay;
                    }

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'user_photo')){
                        $model->user_photo = UploadedFile::getInstance($model, 'user_photo');
                        move_uploaded_file($model->user_photo->tempName, Yii::getAlias('@webroot') . '/uploads/user_photo/'. ( $microtime + 444 ) . '_' . $model->user_photo->baseName . '.'.$model->user_photo->extension);
                        $model->user_photo = ( $microtime + 444 ) . '_' . $model->user_photo->baseName . '.' . $model->user_photo->extension;
                    }else{
                        $model->user_photo =  $model_user_photo;
                    }

                    $model->submit = TRUE;

                    if ($model->save()) {

                        if (isset($_GET["id"])) {


                            // TODO : After submit data for registration public Assign role "Public-User-Submit"
                            $role_new = (object) ['name'=>'Public-User-Submit'];
                            Yii::$app->authManager->assign($role_new,$id);
                            
                            // TODO : After add Assign so remove role "Public-User"
                            $role_old = (object) ['name'=>'Public-User'];
                            Yii::$app->authManager->revoke($role_old,$id);

                            
                            \Yii::$app->getSession()->setFlash('success', 'Your data has been submitted. Thanks for submitting to WCF 2016 open public participants.');
                            //return $this->redirect(['/participant/registration/'. Yii::$app->user->identity->id]);
                            return $this->redirect(Yii::$app->request->referrer);
                        }else{
                            

                            \Yii::$app->getSession()->setFlash('success', 'Thank you for your interest to attend World Culture Forum 2016. The Selected participants will be announced on September 15th, 2016. <a class="btn btn-success" href="'.Yii::$app->request->baseUrl.'/dashboard/index" role="button">Next Step</a>');
                            return $this->render('success');
                        }
                        
                    }else{
                        return $this->render('submit', [
                            'model' => $model,
                            'user'  => $user,
                        ]);
                    }

                }else{

                    // Ketika cuma save

                    if ($_POST["Participantpublic"]["nationality"] == 101) {
                        // NATIONAL PUBLIC PARTICIPANTS
                        $model->variety_id = 35;
                    }else{
                        // International Open Public Participants
                        $model->variety_id = 19;
                    }

                    $format_invitation_code_selected = Varietypartisipant::find()->select('format_invitation_code')->where(['id' => $model->variety_id])->asArray()->column();

                    // TODO : Get 3 character terakhir
                    $nomor_urut_sekarang = Participant::find()->where(['variety_id' => $model->variety_id])->OrderBy(['id' => SORT_DESC])->one();
                    if ($nomor_urut_sekarang) {
                        $nomor_urut_terbaru = substr($nomor_urut_sekarang->invitation_code, -3);
                    }else{
                        $nomor_urut_terbaru = 0;
                    }

                    // TODO : Count participant where variety_id = selected
                    $nomor_urut = Participant::find()->where(['variety_id' => $model->variety_id])->count();

                    $model->load($_POST);

                    $model->speaker             = FALSE;
                    $model->visit_subak_bali    = FALSE;
                    $model->participant_status  = 3;

                    $model->invitation_code     = $format_invitation_code_selected[0] . sprintf("%'.03d", ((int)$nomor_urut_terbaru + 1));
                    $model->token               = rand(111111,999999);
                    $model->user_id             = $id;

                    $microtime                  = str_replace(['.'], [''], microtime(true));

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'essay')){
                        $model->essay = UploadedFile::getInstance($model, 'essay');
                        move_uploaded_file($model->essay->tempName, Yii::getAlias('@webroot') . '/uploads/essay/' . ( $microtime + 555 ) . '_' . $model->essay->baseName . '.'.$model->essay->extension);
                        $model->essay = ( $microtime + 555 ) . '_' . $model->essay->baseName . '.' . $model->essay->extension;
                    }else{
                        $model->essay = $model_essay;
                    }

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'user_photo')){
                        $model->user_photo = UploadedFile::getInstance($model, 'user_photo');
                        move_uploaded_file($model->user_photo->tempName, Yii::getAlias('@webroot') . '/uploads/user_photo/' . ( $microtime + 444 ) . '_' . $model->user_photo->baseName . '.'.$model->user_photo->extension);
                        $model->user_photo = ( $microtime + 444 ) . '_' . $model->user_photo->baseName . '.' . $model->user_photo->extension;
                    }else{
                        $model->user_photo =  $model_user_photo;
                    }

                    if ($model->save()) {

                        if (isset($_GET["id"])) {
                            \Yii::$app->getSession()->setFlash('success', 'Your data has been saved. Thanks for saving to WCF 2016 open public participants.');
                            //return $this->redirect(['/participant/registration/'. Yii::$app->user->identity->id]);
                            return $this->redirect(Yii::$app->request->referrer);
                        }else{
                            // TODO : After submit data for registration public Assign role "Public-User"
                            $role_new = (object) ['name'=>'Public-User'];
                            Yii::$app->authManager->assign($role_new,$id);
                            
                            // TODO : After add Assign so remove role "register"
                            $role_old = (object) ['name'=>'register'];
                            Yii::$app->authManager->revoke($role_old,$id);

                            \Yii::$app->getSession()->setFlash('success', 'Your data has been saved. Thanks for saving to WCF 2016 open public participants.');
                            // \Yii::$app->getSession()->setFlash('success', 'Thank you for your interest to attend World Culture Forum 2016. The Selected participants will be announced on September 15th, 2016. <a class="btn btn-success" href="'.Yii::$app->request->baseUrl.'/dashboard/index" role="button">Next Step</a>');
                            return $this->render('success');
                        }
                        
                    }else{
                        return $this->render('submit', [
                            'model' => $model,
                            'user'  => $user,
                        ]);
                    }
                }
                
            } else {
                return $this->render('submit', [
                    'model' => $model,
                    'user'  => $user,
                ]);
            }

        }
    }

    /**
     * Konfirmasi undangan
     * memasukan invitation code + token
     **/
    public function actionConfirmation(){

        // $this->layout = 'main';
        
        $ParticipantCandidate = '';

        if (Yii::$app->request->post()) {

            if (is_numeric(Yii::$app->request->post('token'))) {
                
                if (isset($_POST['yes'])) {
                
                    // TODO : Memeriksa apakah invitation code dan token benar
                    $dataParticipant = Participant::find()->where(['token' => Yii::$app->request->post('token')])->one();

                    // TODO : Jika benar maka menyimpan user_id login ke table participant
                    if ($dataParticipant->invitation_code === Yii::$app->request->post('invitation_code')) {
                        $ParticipantCandidate   = $dataParticipant;
                        $model                  = $this->findModel($dataParticipant->id);
                        $model->user_id         = Yii::$app->user->identity->id;
                    }

                    if ($model->save()) {
                        // TODO : After submit data for registration public Assign role "Public-User"
                        $role_new = (object) ['name'=>'Invitation-User'];
                        Yii::$app->authManager->assign($role_new,Yii::$app->user->identity->id);
                        
                        // TODO : After add Assign so remove role "register"
                        $role_old = (object) ['name'=>'register'];
                        Yii::$app->authManager->revoke($role_old,Yii::$app->user->identity->id);

                        return $this->redirect(['re-registration', 'id' => $model->user_id]);
                        // return $this->redirect(['representative', 'id' => $model->user_id]);
                    }else{
                        return $this->render('confirmation', [
                            'ParticipantCandidate' => $ParticipantCandidate
                        ]);
                    }

                }else{

                    // TODO : Memeriksa apakah invitation code dan token benar
                    $dataParticipant = Participant::find()->where(['token' => Yii::$app->request->post('token')])->one();

                    // TODO : Jika benar maka menyimpan user_id login ke table participant
                    if ($dataParticipant->invitation_code === Yii::$app->request->post('invitation_code')) {

                        if ($dataParticipant->user_id) {
                            $ParticipantCandidate = new \StdClass;
                            $ParticipantCandidate->full_name = 'This invitation code is already in use.';
                        }else{
                            $ParticipantCandidate = $dataParticipant;
                        }

                    }else{
                        $ParticipantCandidate = new \StdClass;
                        $ParticipantCandidate->full_name = 'Invalid invitation code or token.';
                    }

                    return $this->render('confirmation', [
                        'ParticipantCandidate' => $ParticipantCandidate
                    ]);
                }

            }else{

                $ParticipantCandidate = new \StdClass;
                $ParticipantCandidate->full_name = 'Invalid invitation code or token.';

                return $this->render('confirmation', [
                    'ParticipantCandidate' => $ParticipantCandidate
                ]);
            }

        } else {
            return $this->render('confirmation', [
                'ParticipantCandidate' => $ParticipantCandidate
            ]);
        }
        
    }

    public function actionRepresentative($id){
        
        $this->layout = 'main';

        $model                  = $this->findModelByUserRegistrationID($id);
        $data_representative    = new Representative();

        if (Yii::$app->request->post()) {
            if (isset($_POST["submit-button-yes"])) {
                return $this->redirect(['re-registration', 'id' => $model->user_id]);
            }else{

                $microtime                              = str_replace(['.'], [''], microtime(true));

                $data_representative->assignment_letter = UploadedFile::getInstance($data_representative, 'assignment_letter');

                move_uploaded_file($data_representative->assignment_letter->tempName, Yii::getAlias('@webroot') . '/uploads/assignment_letter/' . ( $microtime + 666 ) . '_'  . $data_representative->assignment_letter->baseName . '.'.$data_representative->assignment_letter->extension);

                $data_representative->assignment_letter = ( $microtime + 666 ) . '_' . $data_representative->assignment_letter->baseName . '.' . $data_representative->assignment_letter->extension;

                $data_representative->name              = $_POST["Representative"]["name"];
                $data_representative->organization      = $_POST["Representative"]["organization"];
                $data_representative->position          = $_POST["Representative"]["position"];
                $data_representative->title             = $model->title;
                $data_representative->full_name         = $model->full_name;
                $data_representative->room_type         = $model->room_type_id;
                $data_representative->attend            = $model->attend_id;
                $data_representative->speaker           = $model->speaker;
                $data_representative->id_category_participant = $model->variety_id;
                $data_representative->user_id           = $model->user_id;

                if ($data_representative->save()) {
                    // TODO : After submit data for registration public Assign role "Invitation-User-Representative"
                    $role_new = (object) ['name'=>'Invitation-User-Representative'];
                    Yii::$app->authManager->assign($role_new,Yii::$app->user->identity->id);
                    
                    // TODO : After add Assign so remove role "Invitation-User"
                    $role_old = (object) ['name'=>'Invitation-User'];
                    Yii::$app->authManager->revoke($role_old,Yii::$app->user->identity->id);

                    return $this->redirect(['/dashboard']);
                }else{
                    print_r($data_representative->getErrors());
                    die();
                }
            }
        }

        return $this->render('representative',[
            'data_representative' => $data_representative,
            'model' => $model
        ]);
    }

    public function actionRepresentativeStatus(){

        $this->layout = 'dashboard';

        $dataRepresentative = Representative::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();

        return $this->render('representativestatus',[
            'status' => $dataRepresentative->approval
        ]);
    }

    public function actionContactAdministrator()
    {   
        Yii::$app->mailer->compose()
            ->setFrom('secretariat@worldcultureforum-bali.org')
            ->setTo('secretariat@worldcultureforum-bali.org')
            ->setSubject('Report From '. $_GET['full_name'])
            ->setHtmlBody('<b> Data with Full Name : '.$_GET['full_name'].', Invitation Code : '.$_GET["invitation_code"].' and Token : '.$_GET["token"].' </b>')
            ->send();
    }

    /**
     * Daftar ulang untuk undangan
     * melengkapi formulir isiian yang ada di table participant
     **/
    public function actionReRegistration($id){

        $this->layout = 'dashboard';

        $symposium_id_1 = Participant::find()->where(['symposium_day_one_id'=> 1])->count();
        $symposium_id_2 = Participant::find()->where(['symposium_day_one_id'=> 2])->count();
        $symposium_id_3 = Participant::find()->where(['symposium_day_one_id'=> 3])->count();
        $symposium_id_4 = Participant::find()->where(['symposium_day_two_id'=> 4])->count();
        $symposium_id_5 = Participant::find()->where(['symposium_day_two_id'=> 5])->count();
        $symposium_id_6 = Participant::find()->where(['symposium_day_two_id'=> 6])->count();

        $symposium_day_one_id_is = [];
        if ($symposium_id_1 < 210) {
            array_push($symposium_day_one_id_is, 1);
        }
        if ($symposium_id_2 < 210) {
            array_push($symposium_day_one_id_is, 2);
        }
        if ($symposium_id_3 < 210) {
            array_push($symposium_day_one_id_is, 3);
        }
        
        $symposium_day_two_id_is = [];
        if ($symposium_id_4 < 210) {
            array_push($symposium_day_two_id_is, 4);
        }
        if ($symposium_id_5 < 210) {
            array_push($symposium_day_two_id_is, 5);
        }
        if ($symposium_id_6 < 210) {
            array_push($symposium_day_two_id_is, 6);
        }

        $model                  = $this->findModelByUserRegistrationID($id);
        $data_representative    = new Representative();
        $user                   = User::find()->where(['id' => $id])->one();
        $quota_culturalvisit    = Participant::find()->where(['cultural_visit' => true])->count();
        $model_companion        = new Participant();

        if ($id != Yii::$app->user->identity->id) {
            throw new NotFoundHttpException('Not permited.');
        }

        if ($model->submit == TRUE || ($model->submit ==  FALSE && $model->variety_id == 19 || $model->variety_id == 35)) {
            /***
             * TODO : IF $model->submit = TRUE
             * Render ke halaman for reregistrationdisable
             ***/

            return $this->render('reregistrationdisable', [
                'model'                 => $model,
                'user'                  => $user,
                'quota_culturalvisit'   => $quota_culturalvisit,
                'symposium_day_one_id_is' => $symposium_day_one_id_is,
                'symposium_day_two_id_is' => $symposium_day_two_id_is,
                'model_companion'       => $model_companion
            ]);

        }elseif ($model->submit == FALSE) {
            /***
             * TODO : IF $model->submit = FALSE
             * Render ke halaman for reregistration
             ***/

            $model = $this->findModelByUserRegistrationID($id);

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

            $model_user_photo           = $model->user_photo;
            $model_essay                = $model->essay;
            $model_full_paper           = $model->full_paper;
            $model_abstract             = $model->abstract;
            $model_file_presentation    = $model->file_presentation;
            $model_ktp_pasport          = $model->ktp_pasport;

            $id                         = Yii::$app->user->identity->id;

            if ($model) {

                //TO DO : Mendapatkan data uploads file
                $tmp_foto           = $model->user_photo;
                $tmp_essay          = $model->essay;
                $tmp_paper          = $model->full_paper;
                $tmp_abstract       = $model->abstract;
                $tmp_presentation   = $model->file_presentation;

                if (Yii::$app->request->post()) {

                    if (isset($_POST["submit-companion-form"])) {
                        $model_companion                        = new Participant();

                        $format_invitation_code_selected        = Varietypartisipant::find()->select('format_invitation_code')->where(['group_participant_id' => 7])->asArray()->column();

                        $model_companion_post                   = $_POST["Participant"]["full_name"];

                        for ($i=0; $i < count($model_companion_post); $i++) { 

                            // TODO : Get 3 character terakhir                       
                            $array_id_companion                 = Varietypartisipant::find()->select('id')->where(['group_participant_id'=>7])->OrderBy('id')->AsArray()->Column();
                            $nomor_urut_sekarang                = Participant::find()->where(['variety_id' => $array_id_companion])->OrderBy(['id' => SORT_DESC])->one();
                            
                            if ($nomor_urut_sekarang) {
                                $nomor_urut_terbaru             = substr($nomor_urut_sekarang->invitation_code, -3);
                            }else{
                                $nomor_urut_terbaru             = 0;
                            }

                            $model_companion                    = new Participant();
                            $model_companion->title             = $model_companion_post[$i]["title"];
                            $model_companion->full_name         = $model_companion_post[$i]["full_name"];
                            $model_companion->variety_id        = $array_id_companion[0];
                            $model_companion->visit_subak_bali  = FALSE;
                            $model_companion->is_companion      = TRUE;
                            $model_companion->invitation_code   = $format_invitation_code_selected[0] . sprintf("%'.03d", ((int)$nomor_urut_terbaru + 1));
                            $model_companion->token             = rand(111111,999999);
                            $model_companion->room_type_id      = 5;
                            $model_companion->is_companion      = TRUE;
                            $model_companion->is_companion_from = $model->id;

                            if ($model_companion->save()) {
                                # code...
                            }else{
                                print_r($model_companion->getErrors());
                                die();
                            }
                        }
                        return $this->redirect(['re-registration', 'id'=>$id]);
                    }elseif (isset($_POST["submit-representative-form"])) {

                        $model                  = $this->findModelByUserRegistrationID($id);
                        $data_representative    = new Representative();

                        $microtime                              = str_replace(['.'], [''], microtime(true));

                        $data_representative->assignment_letter = UploadedFile::getInstance($data_representative, 'assignment_letter');

                        move_uploaded_file($data_representative->assignment_letter->tempName, Yii::getAlias('@webroot') . '/uploads/assignment_letter/' . ( $microtime + 666 ) . '_' . $data_representative->assignment_letter->baseName . '.'.$data_representative->assignment_letter->extension);

                        $data_representative->name              = $_POST["Representative"]["name"];
                        $data_representative->organization      = $_POST["Representative"]["organization"];
                        $data_representative->position          = $_POST["Representative"]["position"];
                        $data_representative->assignment_letter = ( $microtime + 666 ) . '_' . $data_representative->assignment_letter->baseName . '.' . $data_representative->assignment_letter->extension;
                        $data_representative->title             = $model->title;
                        $data_representative->full_name         = $model->full_name;
                        $data_representative->room_type         = $model->room_type_id;
                        $data_representative->attend            = $model->attend_id;
                        $data_representative->speaker           = $model->speaker;
                        $data_representative->id_category_participant = $model->variety_id;
                        $data_representative->user_id           = $model->user_id;

                        if ($data_representative->save()) {
                            // TODO : After submit data for registration public Assign role "Invitation-User-Representative"
                            $role_new = (object) ['name'=>'Invitation-User-Representative'];
                            Yii::$app->authManager->assign($role_new,Yii::$app->user->identity->id);
                            
                            // TODO : After add Assign so remove role "Invitation-User"
                            $role_old = (object) ['name'=>'Invitation-User'];
                            Yii::$app->authManager->revoke($role_old,Yii::$app->user->identity->id);

                            return $this->redirect(['/dashboard']);
                        }else{
                            print_r($data_representative->getErrors());
                            die();
                        }
                    }else{
                        $model = $this->findModelByUserRegistrationID($id);
                        $model->transportation = $_POST['Participantregistration']['transportation'];
                        $model->load($_POST);

                        // ========================================= UPLOAD ===========================================================================
                        // TODO : Store file ke drive

                        $microtime                              = str_replace(['.'], [''], microtime(true));

                        if(UploadedFile::getInstance($model, 'essay')){
                            $model->essay = UploadedFile::getInstance($model, 'essay');
                            move_uploaded_file($model->essay->tempName, Yii::getAlias('@webroot') . '/uploads/essay/'. ($microtime + 555) . '_' . $model->essay->baseName . '.'.$model->essay->extension);
                            $model->essay = ($microtime + 555) . '_' . $model->essay->baseName . '.' . $model->essay->extension;
                        }else{
                            $model->essay = $model_essay;

                        }

                        // TODO : Store file ke drive
                        if(UploadedFile::getInstance($model, 'user_photo')){
                            $model->user_photo = UploadedFile::getInstance($model, 'user_photo');
                            move_uploaded_file($model->user_photo->tempName, Yii::getAlias('@webroot') . '/uploads/user_photo/'. ($microtime + 444) . '_' . $model->user_photo->baseName . '.'.$model->user_photo->extension);
                            $model->user_photo = ($microtime + 444) . '_' . $model->user_photo->baseName . '.' . $model->user_photo->extension;
                        }else{
                            $model->user_photo = $model_user_photo;
                        }

                         // TODO : Store file ke drive
                        if(UploadedFile::getInstance($model, 'ktp_pasport')){
                            $model->ktp_pasport = UploadedFile::getInstance($model, 'ktp_pasport');
                            move_uploaded_file($model->ktp_pasport->tempName, Yii::getAlias('@webroot') . '/uploads/ktp_pasport/'. ($microtime + 333) . '_' . $model->ktp_pasport->baseName . '.'.$model->ktp_pasport->extension);
                            $model->ktp_pasport = ($microtime + 333) . '_' . $model->ktp_pasport->baseName . '.' . $model->ktp_pasport->extension;
                        }else{
                            $model->ktp_pasport = $model_ktp_pasport;
                        }


                        // TODO : Store file ke drive
                        if(UploadedFile::getInstance($model, 'abstract')){
                            $model->abstract = UploadedFile::getInstance($model, 'abstract');
                            move_uploaded_file($model->abstract->tempName, Yii::getAlias('@webroot') . '/uploads/abstract/'. ($microtime + 222) . '_' . $model->abstract->baseName . '.'.$model->abstract->extension);
                            $model->abstract = ($microtime + 222) . '_' . $model->abstract->baseName . '.' . $model->abstract->extension;
                        }else{

                            $model->abstract = $model_abstract;
                        }

                        // TODO : Store file ke drive
                        if(UploadedFile::getInstance($model, 'file_presentation')){
                            $model->file_presentation = UploadedFile::getInstance($model, 'file_presentation');
                            move_uploaded_file($model->file_presentation->tempName, Yii::getAlias('@webroot') . '/uploads/presentation/'. ($microtime + 111) . '_' . $model->file_presentation->baseName . '.'.$model->file_presentation->extension);
                            $model->file_presentation = ($microtime + 111) . '_' . $model->file_presentation->baseName . '.' . $model->file_presentation->extension;
                        }else{
                            $model->file_presentation = $model_file_presentation;
                        }

                        // TODO : Store file ke drive
                        if(UploadedFile::getInstance($model, 'full_paper')){
                            $model->full_paper = UploadedFile::getInstance($model, 'full_paper');
                            move_uploaded_file($model->full_paper->tempName, Yii::getAlias('@webroot') . '/uploads/paper/'. ($microtime + 666) . '_' . $model->full_paper->baseName . '.'.$model->full_paper->extension);
                            $model->full_paper = ($microtime + 666) . '_' . $model->full_paper->baseName . '.' . $model->full_paper->extension;
                        }else{
                            $model->full_paper = $model_full_paper;
                        }

                        // ========================================= UPLOAD ===========================================================================

                        if (isset($_POST["submitdata"])) {
                            // Submit data

                                $model->submit = TRUE;
                               
                            }elseif (isset($_POST["savedata"])) {
                                // Save data

                                $model->submit = FALSE;
                                \Yii::$app->getSession()->setFlash('save', 'Your data has been saved. Thanks for saving to WCF 2016.');

                        }

                        if ($model->save()) {
                         
                            // $name       = ucfirst($model->full_name);
                            // $email      = $model->email;
                            // $token      = $model->token;
                            // $address    = ucfirst($model->address);
                            // $birth      = $model->date_of_birth;
                            // $invitation = $model->invitation_code;
                            // $link       = Html::a('Download Your Ticket World Culture Forum', Url::to(['participant/print-ticket/','token' => $token],'http'));

                            // $pdf = new Pdf([
                            //     // set to use core fonts only
                            //     'mode' => Pdf::MODE_CORE, 
                            //     // A4 paper format
                            //     'format' => Pdf::FORMAT_A4, 
                            //     // portrait orientation
                            //     // 'orientation' => Pdf::ORIENT_PORTRAIT, 
                            //     'orientation' => Pdf::ORIENT_LANDSCAPE,
                            //     // stream to browser inline
                            //     'destination' => Pdf::DEST_FILE, 
                            //     'filename'  => Yii::getAlias('@webroot') . '/uploads/pdf/'.$model->token.'.pdf', 
                            //     // your html content input
                            //     'content' =>  $this->renderPartial('ticket', ['model' => $model]),
                            //     // format content from your own css file if needed or use the
                            //     // enhanced bootstrap css built by Krajee for mPDF formatting 
                            //     // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                            //     'cssFile' => '@webroot/css/bootstrap.css',
                            //     // 'cssFile' => '@webroot/css/site.css',
                            //     // any css to be embedded if required
                            //     // 'cssInline' => '.tg  {border-collapse:collapse;border-spacing:0;} .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;} .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;} .tg .tg-yw4l{vertical-align:top}', 
                            //     // set mPDF properties on the fly
                            //     'options' => ['title' => 'Ticket World Culture Forum 2016'],
                            //     // call mPDF methods on the fly
                            //     'methods' => [ 
                            //         'SetHeader'=>['Date print : '.date("Y/m/d H:i:s")], 
                            //         'SetFooter'=>['Ticket World Culture Forum 2016 for ' . $model->full_name],
                            //     ]
                            // ]);

                            // // return the pdf output as per the destination setting
                            // $pdf->render(); 

                            // return $this->redirect(['ticket', 'id' => $model->user_id]);

                            return $this->redirect(['re-registration', 'id'=>$id]);
                                
                        }else{

                            return $this->render('reregistration', [
                                'model'                 => $model,
                                'user'                  => $user,
                                'quota_culturalvisit'   => $quota_culturalvisit,
                                'symposium_day_one_id_is' => $symposium_day_one_id_is,
                                'symposium_day_two_id_is' => $symposium_day_two_id_is,
                                'data_representative' => $data_representative,
                                'model_companion'       => $model_companion
                            ]);
                        }                        
                    }
                    
                } else {
                    return $this->render('reregistration', [
                        'model' => $model,
                        'user'  => $user,
                        'quota_culturalvisit'   => $quota_culturalvisit,
                        'symposium_day_one_id_is' => $symposium_day_one_id_is,
                        'symposium_day_two_id_is' => $symposium_day_two_id_is,
                        'data_representative' => $data_representative,
                        'model_companion'       => $model_companion
                    ]);
                }
            }else{
                return $this->render('blank');
            }

        }else{
            echo "kondisi submit !== TRUE || FALSE ";
            die();
        }

    }


    public function actionPrintTicket($token)
    {   

        $model = $this->findModelByToken($token);
        $token = $model->token;

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

    }

    /**
     * Tiket undangan
     * $param = user_id
     * jika bukan user login yang meminta maka data tidak bisa di cetak
     **/
    public function actionTicket($id){

        $this->layout = 'dashboard';

        if (Yii::$app->user->identity->id == $id) {

            $model = $this->findModelByUserID($id);

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
     * Visa untuk undangan internasiona
     * $param = user_id
     * jika bukan user login yang meminta maka data tidak bisa di cetak
     **/
    public function actionVisa($id){

        $this->layout = 'dashboard';

        if (Yii::$app->user->identity->id == $id) {

            $model = $this->findModelByUserID($id);

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
                        'orientation' => Pdf::ORIENT_PORTRAIT,
                        // stream to browser inline
                        'destination' => Pdf::DEST_BROWSER, 

                        // your html content input
                        'content' =>  $this->renderPartial('visa', ['model' => $model]),
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
     * Tiket undangan
     * $param = user_id
     * jika bukan user login yang meminta maka data tidak bisa di cetak
     **/
    public function actionCard($id){

        $this->layout = 'dashboard';

        if (Yii::$app->user->identity->id == $id) {

            $model = $this->findModelByUserID($id);

            if ($model) {

                if ($model->room_type_approve) {
                    // setup kartik\mpdf\Pdf component
                    $pdf = new Pdf([
                        // set to use core fonts only
                        'mode' => Pdf::MODE_CORE, 
                        // A4 paper format
                        'format' => Pdf::FORMAT_A4, 
                        // portrait orientation
                        'orientation' => Pdf::ORIENT_PORTRAIT, 
                        // 'orientation' => Pdf::ORIENT_LANDSCAPE,
                        // stream to browser inline
                        'destination' => Pdf::DEST_BROWSER, 

                        // your html content input
                        'content' =>  $this->renderPartial('card', ['model' => $model]),
                        // format content from your own css file if needed or use the
                        // enhanced bootstrap css built by Krajee for mPDF formatting 
                        // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                        'cssFile' => '@webroot/css/bootstrap.css',
                        // 'cssFile' => '@webroot/css/site.css',
                        // any css to be embedded if required
                        // 'cssInline' => '.tg  {border-collapse:collapse;border-spacing:0;} .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;} .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;} .tg .tg-yw4l{vertical-align:top}', 
                         // set mPDF properties on the fly
                        'options' => ['title' => 'ID Card World Culture Forum 2016'],
                         // call mPDF methods on the fly
                        'methods' => [ 
                            'SetHeader'=>['Date print : '.date("Y/m/d H:i:s")], 
                            'SetFooter'=>['ID Card World Culture Forum 2016 for ' . $model->full_name],
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
     * Tiket undangan
     * $param = user_id
     * jika bukan user login yang meminta maka data tidak bisa di cetak
     **/
    public function actionTickethtml($id){
        $model = $this->findModelByUserID($id);

        return $this->render('ticket', [
            'model' => $model,
        ]);
    }

    /**
     * Tiket undangan
     * $param = user_id
     * jika bukan user login yang meminta maka data tidak bisa di cetak
     **/
    public function actionTicketbaru($id){
        $model = $this->findModelByUserID($id);

        return $this->render('ticket_', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Participant model.
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

    public function actionUpdateInvitation($id)
    {
        $this->layout = 'dashboard';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update-invitation', [
                'model' => $model,
            ]);
        }
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

    public function actionRecapitulation(){

        $this->layout = 'dashboard';

        $searchModel = new RegistrasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('recapitulation', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Participant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
        $this->layout = 'dashboard';
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
    /*protected function findModel($id)
    {
        if (($model = Participant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }*/

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
