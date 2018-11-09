<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\mpdf\Pdf;
use app\models\Registrasi;
use dektrium\user\models\User;
use app\models\Participant;
use app\models\ParticipantSearch;
use app\models\Participantselection;


class SeleksiController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = 'dashboard';

        return $this->render('index');
    }

    public function actionLocal()
    {

    	$this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchPublic(Yii::$app->request->queryParams);

        $searchModelModal = new ParticipantSearch();
        $dataProviderModal = $searchModelModal->searchPublicModal(Yii::$app->request->queryParams);

        return $this->render('local', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelModal'  => $searchModelModal,
            'dataProviderModal' => $dataProviderModal,
        ]);

    }

    public function actionLocalView($id)
    {

    	$this->layout = 'dashboard';

        return $this->render('localview', [
            'model' => $this->findModel($id),
        ]);

    }

    public function actionLocalSuccess($id)
    {

    	$model = $this->findModel($id);

    	$model->participant_status 	= 2;
    	$model->submit 				= FALSE;

    	if ($model->save()) {

    		/* Get Role By User Login */
	        $role_user = Yii::$app->authManager->getRolesByUser($model->user_id);
	        foreach ($role_user as $key => $value) {
	            $role_user = $key;
	        }

    		// TODO : After success public Assign role "Invitation-User"
            $role_new = (object) ['name'=>'Invitation-User'];
            Yii::$app->authManager->assign($role_new,$model->user_id);
            
            // TODO : After add Assign so remove role "Invitation-User-Representative"
            $role_old = (object) ['name'=>$role_user];
            Yii::$app->authManager->revoke($role_old,$model->user_id);

    		Yii::$app->mailer->compose()
                ->setFrom('secretariat@worldcultureforum-bali.org')
                ->setTo($model->users->email)
                ->setSubject("Success Public Participant")
                ->setHtmlBody("Dear     " . $model->full_name . ",</br></br></br>
                    <p>Congratulation ! It is our pleasure to inform you that you have been accepted to attend World Culture Forum 2016 as Public Participant. Then, you need to confirm your attendance by completing your data. The deadline for confirmation is <b>September 22th, 2016</b>. Please <a href='".Url::home(true)."/participant/re-registration?id=".$model->user_id."'>click here</a> to complete your registration data.</p>
                    
                    <p>In case you can not attend World Culture Forum 2016, please inform us no later than September 22th, 2016. Your position will be replaced by other participant who can join the event. We hope to see you in October in Bali.</p>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->send();
    	};

    	$this->redirect(Yii::$app->request->referrer);

    }

    public function actionLocalWaitingList($id)
    {

    	$model = $this->findModel($id);

    	$model->participant_status = 4;

    	if($model->save()){

            Yii::$app->mailer->compose()
                ->setFrom('secretariat@worldcultureforum-bali.org')
                ->setTo($model->users->email)
                ->setSubject("Waiting List Public Participants")
                ->setHtmlBody("Dear     " . $model->full_name . ",</br></br></br>
                    <p>It is our pleasure to inform you that you are on the waiting list of selected Public Participant to attend World Culture Forum 2016. We will inform you by email for further information regarding your application if you are accepted in <b>September 21st, 2016</b>. Otherwise, We are regret to inform you that you has not been successful to attend World Culture Forum 2016 as Public Participant. However, You can still follow all of the World Cultrue Forum agendas by watching our live streaming at <a href='http://www.worldcultureforum-bali.org' target='_blank'>www.worldcultureforum-bali.org</a></p>


                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->send();
        }

    	$this->redirect(Yii::$app->request->referrer);

    }

    public function actionLocalUnsuccess($id)
    {

    	$model = $this->findModel($id);

    	$model->participant_status = 5;

    	if ($model->save()) {

    		/* Get Role By User Login */
	        $role_user = Yii::$app->authManager->getRolesByUser($model->user_id);
	        foreach ($role_user as $key => $value) {
	            $role_user = $key;
	        }

    		// TODO : After success public Assign role "Invitation-User"
            $role_new = (object) ['name'=>'Public-User-Submit'];
            Yii::$app->authManager->assign($role_new,$model->user_id);
            
            // TODO : After add Assign so remove role "Invitation-User-Representative"
            $role_old = (object) ['name'=>$role_user];
            Yii::$app->authManager->revoke($role_old,$model->user_id);

    		Yii::$app->mailer->compose()
                ->setFrom('secretariat@worldcultureforum-bali.org')
                ->setTo($model->users->email)
                ->setSubject("Unsuccessful Public Participant")
                ->setHtmlBody("Dear     " . $model->full_name . ",</br></br></br>
                    <p>Sorry, It is our regret to inform you that you have not been successful to attend World Culture Forum 2016 as Public Participant. However, You can still follow the event by watching video streaming at http://worldcultureforum-bali.org.</p>

                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    
                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->send();
    	};

    	$this->redirect(Yii::$app->request->referrer);

    }

    public function actionInternational()
    {

    	$this->layout = 'dashboard';

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchInternationalpublic(Yii::$app->request->queryParams);

        $searchModelModal = new ParticipantSearch();
        $dataProviderModal = $searchModelModal->searchInternationalModal(Yii::$app->request->queryParams);

        return $this->render('international', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelModal'  => $searchModelModal,
            'dataProviderModal' => $dataProviderModal,
        ]);

    }

    public function actionInternationalView($id)
    {

    	$this->layout = 'dashboard';

        return $this->render('internationalview', [
            'model' => $this->findModel($id),
        ]);

    }

    public function actionInternationalSuccess($id)
    {

    	$model = $this->findModel($id);
            $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_CORE, 
                // A4 paper format
                'format' => Pdf::FORMAT_A4, 
                // portrait orientation
                // 'orientation' => Pdf::ORIENT_PORTRAIT, 
                'orientation' => Pdf::ORIENT_PORTRAIT,
                // stream to browser inline
                'destination' => Pdf::DEST_FILE, 
                'filename'  => Yii::getAlias('@webroot') . '/uploads/visa/'.$model->token.'_'. str_replace(["/","'",","], ["_","_","_"], $model->full_name) .'.pdf', 
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
                /*'options' => ['title' => 'Ticket World Culture Forum 2016'],*/
                 // call mPDF methods on the fly
               /* 'methods' => [ 
                    'SetHeader'=>['Date print : '.date("Y/m/d H:i:s")], 
                    'SetFooter'=>['Ticket World Culture Forum 2016 for ' . $model->full_name],
                ]*/
            ]);

                // return the pdf output as per the destination setting
            $pdf->render(); 
    	$model->participant_status 	= 2;
    	$model->submit 				= FALSE;

    	if ($model->save()) {

    		/* Get Role By User Login */
	        $role_user = Yii::$app->authManager->getRolesByUser($model->user_id);
	        foreach ($role_user as $key => $value) {
	            $role_user = $key;
	        }

    		// TODO : After success public Assign role "Invitation-User"
            $role_new = (object) ['name'=>'Invitation-User'];
            Yii::$app->authManager->assign($role_new,$model->user_id);
            
            // TODO : After add Assign so remove role "Invitation-User-Representative"
            $role_old = (object) ['name'=>$role_user];
            Yii::$app->authManager->revoke($role_old,$model->user_id);

    		Yii::$app->mailer->compose()
                ->setFrom('secretariat@worldcultureforum-bali.org')
                ->setTo($model->users->email)
                ->setSubject("Success Public Participant")
                ->setHtmlBody("Dear     " . $model->full_name . ",</br></br></br>
                    <p>Congratulation ! It is our pleasure to inform you that you have been accepted to attend World Culture Forum 2016 as Public Participant. Then, you need to confirm your attendance by completing your data. The deadline for confirmation is <b>September 22th, 2016</b>. Please <a href='".Url::home(true)."/participant/re-registration?id=".$model->user_id."'>click here</a> to complete your registration data.</p>

                    <p>In case you can not attend World Culture Forum 2016, please inform us no later than September 22th, 2016. Your position will be replaced by other participant who can join the event.</p>

                    <p> We also attached Letter of Invitation in case you need to apply visa. Should you have any inquiry, please do not hesitate to contact us. We hope to see you in October in Bali</b>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    
                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->attach(Yii::getAlias('@webroot') . '/uploads/visa/'.$model->token.'_'.str_replace(["/","'",","], ["_","_","_"], $model->full_name).'.pdf')
                ->send();
    	};

    	$this->redirect(Yii::$app->request->referrer);

    }

    public function actionInternationalWaitingList($id)
    {

    	$model = $this->findModel($id);

    	$model->participant_status = 4;

    	if($model->save()){

            Yii::$app->mailer->compose()
                ->setFrom('secretariat@worldcultureforum-bali.org')
                ->setTo($model->users->email)
                ->setSubject("Waiting List Public Participants")
                ->setHtmlBody("Dear     " . $model->full_name . ",</br></br></br>
                    <p>It is our pleasure to inform you that you are on the waiting list of selected Public Participant to attend World Culture Forum 2016. We will inform you by email for further information regarding your application if you are accepted in September 21st, 2016. Otherwise, We are regret to inform you that you has not been successful to attend World Culture Forum 2016 as Public Participant. However, You can still follow all of the World Cultrue Forum agendas by watching our live streaming at <a href='http://www.worldcultureforum-bali.org' target='_blank'>www.worldcultureforum-bali.org</a></p>


                    <br/><br/>
                    <br/><br/>
                    
                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->send();
        }

    	$this->redirect(Yii::$app->request->referrer);

    }

    public function actionInternationalUnsuccess($id)
    {

    	$model = $this->findModel($id);

    	$model->participant_status = 5;

    	if ($model->save()) {

    		/* Get Role By User Login */
	        $role_user = Yii::$app->authManager->getRolesByUser($model->user_id);
	        foreach ($role_user as $key => $value) {
	            $role_user = $key;
	        }

    		// TODO : After success public Assign role "Invitation-User"
            $role_new = (object) ['name'=>'Public-User-Submit'];
            Yii::$app->authManager->assign($role_new,$model->user_id);
            
            // TODO : After add Assign so remove role "Invitation-User-Representative"
            $role_old = (object) ['name'=>$role_user];
            Yii::$app->authManager->revoke($role_old,$model->user_id);

    		Yii::$app->mailer->compose()
                ->setFrom('secretariat@worldcultureforum-bali.org')
                ->setTo($model->users->email)
                ->setSubject("Unsuccessful Public Participant")
                ->setHtmlBody("Dear     " . $model->full_name . ",</br></br></br>
                    <p>Sorry, It is our regret to inform you that you have not been successful to attend World Culture Forum 2016 as Public Participant. However, You can still follow the event by watching video streaming at http://worldcultureforum-bali.org.</p>

                    <br/><br/>
                    <br/><br/>
                    
                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->send();
    	};

    	$this->redirect(Yii::$app->request->referrer);

    }


    public function actionSendEmail($min, $max)
    {   
            $attend_paticipant = Registrasi::find()->select('id_participant')->asArray()->column();

            $participant = Participant::find()->select('email')->where(['id' => $attend_paticipant])->andWhere(['not',['email' => NULL]])->groupBy('email')->asArray()->orderBy(['email' => SORT_ASC])->all();


            for ($i=$min; $i < $max; $i++) { 
                Yii::$app->mailer->compose()
                ->setFrom('secretariat@worldcultureforum-bali.org')
                ->setTo($participant[$i]['email'])
                ->setSubject("Bali Declaration input")
                ->setHtmlBody("Dear Excellencies, Distinguished Guests and Participants of the World Culture Forum 2016. 
                        <br/>
                        <br/>
                        We would like to invite you to contribute toward integrating culture in sustainable development. Please check the enclosed <b>Bali Declaration</b> below and submit any necessary input by replying to this email before 11 am, 13th October 2016. 
                    <br/>
                    <br/>
                    
                        Thank you for your attention.
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    
                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->attach(Yii::getAlias('@webroot') . '/bali-declaration.pdf')
                ->send();
            }


            /*foreach ($participant as $email_participant) {
                print_r($email_participant->email);
                die();
            }*/

            
            print_r($participant);
            die();

            
    }

    /**
     * Deletes an existing Attend model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        // return $this->redirect(['index']);
        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findModel($id)
    {
        if (($model = Participantselection::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
