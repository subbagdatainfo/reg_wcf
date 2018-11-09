<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Participant;
use app\models\ParticipantSearch;
use app\models\Participantselection;

class PenjurianController extends \yii\web\Controller
{
    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionLocal()
    {
        // Check if there is an Editable ajax request
        if (isset($_POST['hasEditable'])) {
            
            $id         = $_POST['editableKey'];
            $attribut   = $_POST['editableAttribute'];
            foreach ($_POST['Participant'] as $key => $value) {
                $value      = $_POST['Participant'][$key][$attribut];
            }
            $model      = Participantselection::findOne($id);

            // use Yii's response format to encode output as JSON
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            
            if ($attribut == 'nilai_ps') {
                $model->nilai_ps = $value;
            }elseif ($attribut == 'nilai_mo') {
                $model->nilai_mo = $value;
            }elseif ($attribut == 'nilai_eb') {
                $model->nilai_eb = $value;
            }elseif ($attribut == 'nilai_ek') {
                $model->nilai_ek = $value;
            }elseif ($attribut == 'nilai_eo') {
                $model->nilai_eo = $value;
            }elseif ($attribut == 'nilai_cv') {
                $model->nilai_cv = $value;
            }elseif ($attribut == 'nilai_rl') {
                $model->nilai_rl = $value;
            }
            
            if ($model->save()) {
                // return JSON encoded output in the below format
                return ['output'=>$value, 'message'=>''];
            }else{
                // alternatively you can return a validation error
                return ['output'=>'', 'message'=>$model->getErrors()];
            }
        }

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchPublicselection(Yii::$app->request->queryParams);

        return $this->render('local', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLocalView($id)
    {

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
                    <p>Congratulation ! It is our pleasure to inform you that you have been accepted to attend World Culture Forum 2016 as Public Participant. Please <a href='".Url::home(true)."/participant/re-registration?id=".$model->user_id."'>click here</a> to complete your registration data.</p><br/><br/>
                    
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

    	$model->save();

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
                    <p>Sorry, It is our regret to inform you that you have not been successful to attend World Culture Forum 2016 as Public Participant. However, You can still follow the event by watching video streaming at http://worldcultureforum-bali.org.</p><br/><br/>
                    
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

    	// $this->layout = 'dashboard';

        // Check if there is an Editable ajax request
        if (isset($_POST['hasEditable'])) {

            $id         = $_POST['editableKey'];
            $attribut   = $_POST['editableAttribute'];
            foreach ($_POST['Participant'] as $key => $value) {
                $value      = $_POST['Participant'][$key][$attribut];
            }
            $model      = Participantselection::findOne($id);

            // use Yii's response format to encode output as JSON
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            
            if ($attribut == 'nilai_ps') {
                $model->nilai_ps = $value;
            }elseif ($attribut == 'nilai_mo') {
                $model->nilai_mo = $value;
            }elseif ($attribut == 'nilai_eb') {
                $model->nilai_eb = $value;
            }elseif ($attribut == 'nilai_ek') {
                $model->nilai_ek = $value;
            }elseif ($attribut == 'nilai_eo') {
                $model->nilai_eo = $value;
            }elseif ($attribut == 'nilai_cv') {
                $model->nilai_cv = $value;
            }elseif ($attribut == 'nilai_rl') {
                $model->nilai_rl = $value;
            }
            
            if ($model->save()) {
                // return JSON encoded output in the below format
                return ['output'=>$value, 'message'=>''];
            }else{
                // alternatively you can return a validation error
                return ['output'=>'', 'message'=>$model->getErrors()];
            }
        }

        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchInternationalpublicselection(Yii::$app->request->queryParams);

        return $this->render('international', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
                    <p>Congratulation ! It is our pleasure to inform you that you have been accepted to attend World Culture Forum 2016 as Public Participant. Please <a href='".Url::home(true)."/participant/re-registration?id=".$model->user_id."'>click here</a> to complete your registration data.</p><br/><br/>
                    
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

    public function actionInternationalWaitingList($id)
    {

    	$model = $this->findModel($id);

    	$model->participant_status = 4;

    	$model->save();

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
                    <p>Sorry, It is our regret to inform you that you have not been successful to attend World Culture Forum 2016 as Public Participant. However, You can still follow the event by watching video streaming at http://worldcultureforum-bali.org.</p><br/><br/>
                    
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


    public function actionLocalHasil()
    {
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchPublicselectionhasil(Yii::$app->request->queryParams);

        return $this->render('local-hasil', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInternationalHasil()
    {
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->searchInternationalselectionhasil(Yii::$app->request->queryParams);

        return $this->render('international-hasil', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
