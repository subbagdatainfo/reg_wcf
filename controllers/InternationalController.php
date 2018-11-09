<?php

namespace app\controllers;

use Yii;
use app\models\Participant;
use app\models\Participantbadge;
use app\models\ParticipantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Varietypartisipant;
use app\models\Adminupdate;
use dektrium\user\models\User;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

class InternationalController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = 'dashboard';
        return $this->render('index');
    }

    public function actionPrintBadgeInternational()
    {
        $this->layout = 'dashboard';

        /*if (isset($_POST['hasEditable'])) {

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
        }*/
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchInternationalpublic(Yii::$app->request->queryParams);

        return $this->render('print-badge', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPrintBadgeInternationalInvited()
    {
        $this->layout = 'dashboard';

        /*if (isset($_POST['hasEditable'])) {

            $id         = $_POST['editableKey'];
            $attribut   = $_POST['editableAttribute'];
            foreach ($_POST['Participant'] as $key => $value) {
                $value      = $_POST['Participant'][$key][$attribut];
            }

            $model  = Participant::findOne($id);

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            
            $model->name_on_badge = $value;


            if ($model->save()) {
                // return JSON encoded output in the below format
                return ['output'=>$value, 'message'=>''];
            }else{
                // alternatively you can return a validation error
                return ['output'=>'', 'message'=>$model->getErrors()];
            }
        }*/
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchInternationalinvited(Yii::$app->request->queryParams);

        return $this->render('print-badge-invited', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInvited()
    {
        $this->layout = 'dashboard';
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchInternationalinvited(Yii::$app->request->queryParams);

        return $this->render('invited', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInvitedview($id)
    {
        $this->layout = 'dashboard';
        return $this->render('invitedview', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionInternationalupdateinvitation($id)
    {
        $this->layout = 'dashboard';

        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['invitedview', 'id' => $model->id]);
        } else {
            return $this->render('update-invitation', [
                'model' => $model,
            ]);
        }
    }



    public function actionInvitedupdate($id)
    {
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

        $model                  = $this->findModelByAdminupdateID($id);
        $quota_culturalvisit    = Participant::find()->where(['cultural_visit' => true])->count();

        // if ($id != Yii::$app->user->identity->id) {
        //     throw new NotFoundHttpException('Not permited.');
        // }

        
            $model = $this->findModelByAdminupdateID($id);


           
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

                    $model->transportation = $_POST['Adminupdate']['transportation'];
                    $model->load($_POST);

                    // ========================================= UPLOAD ===========================================================================
                    // TODO : Store file ke drive

                    $microtime  = str_replace(['.'], [''], microtime(true));


                    // ========================================= UPLOAD ===========================================================================
                    // TODO : Store file ke drive

                    if(UploadedFile::getInstance($model, 'essay')){
                        $model->essay = UploadedFile::getInstance($model, 'essay');
                        move_uploaded_file($model->essay->tempName, Yii::getAlias('@webroot') . '/uploads/essay/'. ( $microtime + 666 ) . '_' .$model->essay->baseName . '.'.$model->essay->extension);
                        $model->essay =  ( $microtime + 666 ) . '_' .$model->essay->baseName . '.' . $model->essay->extension;
                    }else{
                        $model->essay =  $model_essay;

                    }

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'user_photo')){
                        $model->user_photo = UploadedFile::getInstance($model, 'user_photo');
                        move_uploaded_file($model->user_photo->tempName, Yii::getAlias('@webroot') . '/uploads/user_photo/'. ( $microtime + 555 ) . '_' .$model->user_photo->baseName . '.'.$model->user_photo->extension);
                        $model->user_photo =  ( $microtime + 555 ) . '_' .$model->user_photo->baseName . '.' . $model->user_photo->extension;
                    }else{
                        $model->user_photo = $model_user_photo;
                    }

                     // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'ktp_pasport')){
                        $model->ktp_pasport = UploadedFile::getInstance($model, 'ktp_pasport');
                        move_uploaded_file($model->ktp_pasport->tempName, Yii::getAlias('@webroot') . '/uploads/ktp_pasport/'. ( $microtime + 444 ) . '_' .$model->ktp_pasport->baseName . '.'.$model->ktp_pasport->extension);
                        $model->ktp_pasport =  ( $microtime + 444 ) . '_' .$model->ktp_pasport->baseName . '.' . $model->ktp_pasport->extension;
                    }else{
                        $model->ktp_pasport = $model_ktp_pasport;
                    }


                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'abstract')){
                        $model->abstract = UploadedFile::getInstance($model, 'abstract');
                        move_uploaded_file($model->abstract->tempName, Yii::getAlias('@webroot') . '/uploads/abstract/'. ( $microtime + 333 ) . '_' .$model->abstract->baseName . '.'.$model->abstract->extension);
                        $model->abstract =  ( $microtime + 333 ) . '_' .$model->abstract->baseName . '.' . $model->abstract->extension;
                    }else{

                        $model->abstract = $model_abstract;
                    }

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'file_presentation')){
                        $model->file_presentation = UploadedFile::getInstance($model, 'file_presentation');
                        move_uploaded_file($model->file_presentation->tempName, Yii::getAlias('@webroot') . '/uploads/presentation/'. ( $microtime + 222 ) . '_' .$model->file_presentation->baseName . '.'.$model->file_presentation->extension);
                        $model->file_presentation =  ( $microtime + 222 ) . '_' .$model->file_presentation->baseName . '.' . $model->file_presentation->extension;
                    }else{
                        $model->file_presentation = $model_file_presentation;
                    }

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'full_paper')){
                        $model->full_paper = UploadedFile::getInstance($model, 'full_paper');
                        move_uploaded_file($model->full_paper->tempName, Yii::getAlias('@webroot') . '/uploads/paper/'. ( $microtime + 111 ) . '_' .$model->full_paper->baseName . '.'.$model->full_paper->extension);
                        $model->full_paper =  ( $microtime + 111 ) . '_' .$model->full_paper->baseName . '.' . $model->full_paper->extension;
                    }else{
                        $model->full_paper = $model_full_paper;
                    }

                    // ========================================= UPLOAD ===========================================================================


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


                            return $this->redirect(['international/invited']);
                            
                    }else{

                        return $this->render('reregistration', [
                            'model'                     => $model,
                            'quota_culturalvisit'       => $quota_culturalvisit,
                            'symposium_day_one_id_is'   => $symposium_day_one_id_is,
                            'symposium_day_two_id_is'   => $symposium_day_two_id_is
                        ]);
                    }
                    
                } else {
                    return $this->render('reregistration', [
                        'model' => $model,
                        'quota_culturalvisit'       => $quota_culturalvisit,
                        'symposium_day_one_id_is'   => $symposium_day_one_id_is,
                        'symposium_day_two_id_is'   => $symposium_day_two_id_is
                    ]);
                }
            }else{
                return $this->render('reregistration');
            }

    }

    public function actionInvitedupdateall($id)
    {
        $this->layout = 'dashboard';
        $model = $this->findModelInternational($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['invited']);
        } else {
            return $this->render('../participant/international', [
                'model' => $model,
            ]);
        }
    }

    public function actionInviteddelete($id)
    {
        $this->layout = 'dashboard';
        $this->findModelInternational($id)->delete();

        return $this->redirect(['invited']);
    }

    public function actionPublic()
    {
        $this->layout = 'dashboard';
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchInternationalpublic(Yii::$app->request->queryParams);

        return $this->render('public', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionPublicview($id)
    {
        $this->layout = 'dashboard';
        return $this->render('publicview', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionPublicupdate($id)
    {
        $this->layout = 'dashboard';

        $symposium_id_1 = Participant::find()->where(['symposium_day_one_id'=> 1])->count();
        $symposium_id_2 = Participant::find()->where(['symposium_day_one_id'=> 2])->count();
        $symposium_id_3 = Participant::find()->where(['symposium_day_one_id'=> 3])->count();
        $symposium_id_4 = Participant::find()->where(['symposium_day_two_id'=> 4])->count();
        $symposium_id_5 = Participant::find()->where(['symposium_day_two_id'=> 5])->count();
        $symposium_id_6 = Participant::find()->where(['symposium_day_two_id'=> 6])->count();

        $symposium_day_one_id_is = [];
        if ($symposium_id_1 < 200) {
            array_push($symposium_day_one_id_is, 1);
        }
        if ($symposium_id_2 < 200) {
            array_push($symposium_day_one_id_is, 2);
        }
        if ($symposium_id_3 < 200) {
            array_push($symposium_day_one_id_is, 3);
        }
        
        $symposium_day_two_id_is = [];
        if ($symposium_id_4 < 200) {
            array_push($symposium_day_two_id_is, 4);
        }
        if ($symposium_id_5 < 200) {
            array_push($symposium_day_two_id_is, 5);
        }
        if ($symposium_id_6 < 200) {
            array_push($symposium_day_two_id_is, 6);
        }

        $model                  = $this->findModelByAdminupdateID($id);
        $quota_culturalvisit    = Participant::find()->where(['cultural_visit' => true])->count();

        // if ($id != Yii::$app->user->identity->id) {
        //     throw new NotFoundHttpException('Not permited.');
        // }

        
            $model = $this->findModelByAdminupdateID($id);


         
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

                    $model->transportation = $_POST['Adminupdate']['transportation'];
                    $model->load($_POST);

                    // ========================================= UPLOAD ===========================================================================
                    // TODO : Store file ke drive

                    if(UploadedFile::getInstance($model, 'essay')){
                        $model->essay = UploadedFile::getInstance($model, 'essay');
                        move_uploaded_file($model->essay->tempName, Yii::getAlias('@webroot') . '/uploads/essay/'. $model->essay->baseName . '.'.$model->essay->extension);
                        $model->essay =  $model->essay->baseName . '.' . $model->essay->extension;
                    }elseif(!empty($model->essay)){
                        $model->essay =  $model_essay;

                    }

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'user_photo')){
                        $model->user_photo = UploadedFile::getInstance($model, 'user_photo');
                        move_uploaded_file($model->user_photo->tempName, Yii::getAlias('@webroot') . '/uploads/user_photo/'. $model->user_photo->baseName . '.'.$model->user_photo->extension);
                        $model->user_photo =  $model->user_photo->baseName . '.' . $model->user_photo->extension;
                    }else{
                        $model->user_photo = $model_user_photo;
                    }

                     // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'ktp_pasport')){
                        $model->ktp_pasport = UploadedFile::getInstance($model, 'ktp_pasport');
                        move_uploaded_file($model->ktp_pasport->tempName, Yii::getAlias('@webroot') . '/uploads/ktp_pasport/'. $model->ktp_pasport->baseName . '.'.$model->ktp_pasport->extension);
                        $model->ktp_pasport =  $model->ktp_pasport->baseName . '.' . $model->ktp_pasport->extension;
                    }else{
                        $model->ktp_pasport = $model_ktp_pasport;
                    }


                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'abstract')){
                        $model->abstract = UploadedFile::getInstance($model, 'abstract');
                        move_uploaded_file($model->abstract->tempName, Yii::getAlias('@webroot') . '/uploads/abstract/'. $model->abstract->baseName . '.'.$model->abstract->extension);
                        $model->abstract =  $model->abstract->baseName . '.' . $model->abstract->extension;
                    }else{

                        $model->abstract = $model_abstract;
                    }

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'file_presentation')){
                        $model->file_presentation = UploadedFile::getInstance($model, 'file_presentation');
                        move_uploaded_file($model->file_presentation->tempName, Yii::getAlias('@webroot') . '/uploads/presentation/'. $model->file_presentation->baseName . '.'.$model->file_presentation->extension);
                        $model->file_presentation =  $model->file_presentation->baseName . '.' . $model->file_presentation->extension;
                    }else{
                        $model->file_presentation = $model_file_presentation;
                    }

                    // TODO : Store file ke drive
                    if(UploadedFile::getInstance($model, 'full_paper')){
                        $model->full_paper = UploadedFile::getInstance($model, 'full_paper');
                        move_uploaded_file($model->full_paper->tempName, Yii::getAlias('@webroot') . '/uploads/paper/'. $model->full_paper->baseName . '.'.$model->full_paper->extension);
                        $model->full_paper =  $model->full_paper->baseName . '.' . $model->full_paper->extension;
                    }else{
                        $model->full_paper = $model_full_paper;
                    }

                    // ========================================= UPLOAD ===========================================================================


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

                            return $this->redirect(['international/public']);
                            
                    }else{

                        return $this->render('reregistration', [
                            'model'                     => $model,
                            'quota_culturalvisit'       => $quota_culturalvisit,
                            'symposium_day_one_id_is'   => $symposium_day_one_id_is,
                            'symposium_day_two_id_is'   => $symposium_day_two_id_is
                        ]);
                    }
                    
                } else {
                    return $this->render('reregistration', [
                        'model' => $model,
                        'quota_culturalvisit'       => $quota_culturalvisit,
                        'symposium_day_one_id_is'   => $symposium_day_one_id_is,
                        'symposium_day_two_id_is'   => $symposium_day_two_id_is
                    ]);
                }
            }else{
                return $this->render('reregistration');
            }

    }

    public function actionBadge($id)
    {

        $model = $this->findModelInternational($id);

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

    public function actionPublicdelete($id)
    {
        $this->layout = 'dashboard';
        $this->findModelInternational($id)->delete();

        return $this->redirect(['public']);
    }

    protected function findModel($id)
    {
        if (($model = Participant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelInternational($id)
    {
        if (($model = Participant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     protected function findModelByAdminupdateID($id)
    {
        if (($model = Adminupdate::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        }
    }
}
