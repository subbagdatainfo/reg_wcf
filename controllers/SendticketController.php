<?php

namespace app\controllers;


use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\mpdf\Pdf;
use yii\web\Controller;
use app\models\Participant;
use app\models\Participantregistration;


class SendticketController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSendTicketToEmail($id)
    {

        $this->layout ='dashboard';

    	 $model = $this->findModelByUserRegistrationID($id);


    	 	if($model){

    	 		if(!empty($model->full_name && $model->email && $model->token && $model->date_of_birth && $model->address && $model->symposium_day_one_id)){
						$name       = ucfirst($model->full_name);
		                $email      = $model->email;
		                $token      = $model->token;
		                $address    = ucfirst($model->address);
		                $birth      = $model->date_of_birth;
		                $invitation = $model->invitation_code;
		                $link       = Html::a('Download Your Ticket World Culture Forum', Url::to(['participant/print-ticket/','token' => $token],'http'));


		               $pdf = new Pdf([
		                // set to use core fonts only
		                'mode' => Pdf::MODE_CORE, 
		                // A4 paper format
		                'format' => Pdf::FORMAT_A4, 
		                // portrait orientation
		                // 'orientation' => Pdf::ORIENT_PORTRAIT, 
		                'orientation' => Pdf::ORIENT_LANDSCAPE,
		                // stream to browser inline
		                'destination' => Pdf::DEST_FILE, 
		                'filename'  => Yii::getAlias('@webroot') . '/uploads/pdf/'.$model->token.'.pdf', 
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
	                    $pdf->render(); 

	                    Yii::$app->mailer->compose()
	                                 ->setFrom('secretariat@worldcultureforum-bali.org')
	                                 ->setTo($email)
	                                 ->setSubject('Complete Registration Thank you for completing this registration')
	                                 ->setHtmlBody("Thanks for completing the application form. You can modify and submit your data by logging in to your account and submit again to get new ticket. Here is the detail of your application and the ticket of World Culture Forum 2016: 
	                                        <br/>
	                                        <br/>
	                                        <b>Name:</b> $name
	                                        <br/>
	                                        <b>Date of Birth:</b> $birth
	                                        <br/>
	                                        <b>Address:</b> $address<br/>
	                                        <b>Email:</b> $email
	                                        <br/>
	                                        <b>Token:</b> $token

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

	                                        <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p>

	                                        <br/>
	                                        <br/>
	                                        <br/>
	                                        <br/>
	                                        <br/>
	                                        $link
	                                        ")
	                                 ->attach(Yii::getAlias('@webroot') . '/uploads/pdf/'.$model->token.'.pdf')
	                                 ->send();
	           		return $this->redirect(Yii::$app->request->referrer);
	           	}else{

                	return $this->render('blank');

	           	}

            }else{

                return $this->render('blank');

            }


    }


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




     protected function findModelByUserRegistrationID($id)
    {
        if (($model = Participantregistration::find()->where(['user_id' => $id])->one()) !== null) {
            return $model;
        }
    }

   
}
