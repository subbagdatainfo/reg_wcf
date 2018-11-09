<?php

namespace app\controllers;

use Yii;

class DownloadController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = 'dashboard';
    	
    	$data_double_essay = Yii::$app->db->createCommand('SELECT count(id), essay FROM participant WHERE essay NOT LIKE \'\' GROUP BY essay ORDER BY count DESC;')->queryAll();

    	$user_id = [];
    	for ($i=0; $i < count($data_double_essay); $i++) { 
    		$data_user = Yii::$app->db->createCommand('SELECT user_id, full_name, invitation_code, token FROM participant WHERE essay LIKE \''.str_replace(["'"], [""], $data_double_essay[$i]["essay"]).'\';')->queryAll();
    		if (count($data_user) > 1) {
    			for ($in=0; $in < count($data_user); $in++) { 
    				
    				$email 									= Yii::$app->db->createCommand('SELECT email FROM "user" WHERE id = '.$data_user[$in]["user_id"].';')->queryAll();

	    			$user_id[$i][$in]["invitation_code"]	= $data_user[$in]["invitation_code"];
	    			$user_id[$i][$in]["token"] 				= $data_user[$in]["token"];
	    			$user_id[$i][$in]["full_name"] 			= $data_user[$in]["full_name"];
	    			$user_id[$i][$in]["email"]				= $email[0]["email"];
	    			$user_id[$i][$in]["essay_name_file"] 	= $data_double_essay[$i]["essay"];
	    		}
    		}
    	}

    	print_r(json_encode($user_id));
    	die();
    }

    public function actionEssay()
    {
    	$this->layout = 'dashboard';
    	
    	$data_double_essay = Yii::$app->db->createCommand('SELECT count(id), essay FROM participant WHERE essay NOT LIKE \'\' GROUP BY essay ORDER BY count DESC;')->queryAll();

    	$user_id = [];
    	for ($i=0; $i < count($data_double_essay); $i++) { 
    		$data_user = Yii::$app->db->createCommand('SELECT user_id, full_name, invitation_code, token FROM participant WHERE essay LIKE \''.str_replace(["'"], [""], $data_double_essay[$i]["essay"]).'\';')->queryAll();
    		if (count($data_user) > 1) {
    			for ($in=0; $in < count($data_user); $in++) { 
    				
    				$email 									= Yii::$app->db->createCommand('SELECT email FROM "user" WHERE id = '.$data_user[$in]["user_id"].';')->queryAll();

	    			$user_id[$i][$in]["invitation_code"]	= $data_user[$in]["invitation_code"];
	    			$user_id[$i][$in]["token"] 				= $data_user[$in]["token"];
	    			$user_id[$i][$in]["full_name"] 			= $data_user[$in]["full_name"];
	    			$user_id[$i][$in]["email"]				= $email[0]["email"];
	    			$user_id[$i][$in]["essay_name_file"] 	= $data_double_essay[$i]["essay"];
	    		}
    		}
    	}

    	print_r(json_encode($user_id));
    	die();
    }

    public function actionKtp()
    {
    	$this->layout = 'dashboard';
    	
    	$data_double_essay = Yii::$app->db->createCommand('SELECT count(id), ktp_pasport FROM participant WHERE ktp_pasport NOT LIKE \'\' GROUP BY ktp_pasport ORDER BY count DESC;')->queryAll();

    	$user_id = [];
    	for ($i=0; $i < count($data_double_essay); $i++) { 
    		$data_user = Yii::$app->db->createCommand('SELECT user_id, full_name, invitation_code, token FROM participant WHERE ktp_pasport LIKE \''.str_replace(["'"], [""], $data_double_essay[$i]["ktp_pasport"]).'\';')->queryAll();
    		if (count($data_user) > 1) {
    			for ($in=0; $in < count($data_user); $in++) { 
    				
    				$email 									= Yii::$app->db->createCommand('SELECT email FROM "user" WHERE id = '.$data_user[$in]["user_id"].';')->queryAll();

	    			$user_id[$i][$in]["invitation_code"]	= $data_user[$in]["invitation_code"];
	    			$user_id[$i][$in]["token"] 				= $data_user[$in]["token"];
	    			$user_id[$i][$in]["full_name"] 			= $data_user[$in]["full_name"];
	    			$user_id[$i][$in]["email"]				= $email[0]["email"];
	    			$user_id[$i][$in]["ktp_pasport"] 		= $data_double_essay[$i]["ktp_pasport"];
	    		}
    		}
    	}

    	print_r(json_encode($user_id));
    	die();
    }

    public function actionFoto()
    {
    	$this->layout = 'dashboard';
    	
    	$data_double_essay = Yii::$app->db->createCommand('SELECT count(id), user_photo FROM participant WHERE user_photo NOT LIKE \'\' GROUP BY user_photo ORDER BY count DESC;')->queryAll();

    	$user_id = [];
    	for ($i=0; $i < count($data_double_essay); $i++) { 
    		$data_user = Yii::$app->db->createCommand('SELECT user_id, full_name, invitation_code, token FROM participant WHERE user_photo LIKE \''.str_replace(["'"], [""], $data_double_essay[$i]["user_photo"]).'\';')->queryAll();
    		if (count($data_user) > 1) {
    			for ($in=0; $in < count($data_user); $in++) { 
    				
    				$email 									= Yii::$app->db->createCommand('SELECT email FROM "user" WHERE id = '.$data_user[$in]["user_id"].';')->queryAll();

	    			$user_id[$i][$in]["invitation_code"]	= $data_user[$in]["invitation_code"];
	    			$user_id[$i][$in]["token"] 				= $data_user[$in]["token"];
	    			$user_id[$i][$in]["full_name"] 			= $data_user[$in]["full_name"];
	    			$user_id[$i][$in]["email"]				= $email[0]["email"];
	    			$user_id[$i][$in]["user_photo"] 		= $data_double_essay[$i]["user_photo"];
	    		}
    		}
    	}

    	print_r(json_encode($user_id));
    	die();
    }

    public function actionEssaySimple()
    {
    	$this->layout = 'dashboard';
    	
    	$data_email = Yii::$app->db->createCommand('SELECT email FROM essay GROUP BY email;')->queryAll();

    	echo count($data_email);
    	die();
    	print_r(json_encode($data_email));
    	die();
    }

    public function actionKirimEmailKtp(){

    	$email_ktp = Yii::$app->db->createCommand('SELECT email, full_name FROM ktp;')->queryAll();

    	// for ($i=0; $i < count($email_ktp); $i++) { 

    	// 	Yii::$app->mailer->compose()
     //            ->setFrom("secretariat@worldcultureforum-bali.org")
     //            ->setTo($email_ktp[$i]["email"])
     //            ->setSubject("WCF 2016 Attendants data validation")
     //            ->setHtmlBody("Dear Mr./Ms. " . $email_ktp[$i]["full_name"] . ",</br></br></br>
     //                <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
     //                <p>Thank you for your cooperation. We hope to see you in October.</p>
     //                <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

     //                <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
     //                <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
     //                <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
     //                <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
     //                <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
     //                <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
     //                <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
     //            ->send();
    	// };

    }

    public function actionKirimEmailJumlah(){

    	$email_foto = Yii::$app->db->createCommand('SELECT email FROM foto GROUP BY email;')->queryAll();

    	print_r(count($email_foto));
    	die();

    }

    public function actionKirimEmailFoto1(){

    	$email_foto = Yii::$app->db->createCommand('SELECT email FROM foto GROUP BY email;')->queryAll();

    	for ($i=0; $i < 11; $i++) { 

    		// $full_name = Yii::$app->db->createCommand('SELECT full_name FROM foto WHERE email LIKE \''.$email_foto[$i]["email"].'\';')->queryAll();

    		// Yii::$app->mailer->compose()
      //           ->setFrom("secretariat@worldcultureforum-bali.org")
      //           ->setTo($email_foto[$i]["email"])
      //           ->setSubject("WCF 2016 Attendants data validation")
      //           ->setHtmlBody("Dear Mr./Ms. " . $full_name[0]["full_name"] . ",</br></br></br>
      //               <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
      //               <p>Thank you for your cooperation. We hope to see you in October.</p>
      //               <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

      //               <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
      //               <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
      //               <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
      //               <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
      //               <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
      //           ->send();
    	}

    	echo "success";

    }

    public function actionKirimEmailFoto2(){

    	$email_foto = Yii::$app->db->createCommand('SELECT email FROM foto GROUP BY email;')->queryAll();

    	for ($i=11; $i < 21; $i++) { 

    		// $full_name = Yii::$app->db->createCommand('SELECT full_name FROM foto WHERE email LIKE \''.$email_foto[$i]["email"].'\';')->queryAll();

    		// Yii::$app->mailer->compose()
      //           ->setFrom("secretariat@worldcultureforum-bali.org")
      //           ->setTo($email_foto[$i]["email"])
      //           ->setSubject("WCF 2016 Attendants data validation")
      //           ->setHtmlBody("Dear Mr./Ms. " . $full_name[0]["full_name"] . ",</br></br></br>
      //               <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
      //               <p>Thank you for your cooperation. We hope to see you in October.</p>
      //               <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

      //               <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
      //               <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
      //               <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
      //               <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
      //               <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
      //           ->send();
    	}

    	echo "success";

    }

    public function actionKirimEmailFoto3(){

    	$email_foto = Yii::$app->db->createCommand('SELECT email FROM foto GROUP BY email;')->queryAll();

    	for ($i=21; $i < 31; $i++) { 

    		// $full_name = Yii::$app->db->createCommand('SELECT full_name FROM foto WHERE email LIKE \''.$email_foto[$i]["email"].'\';')->queryAll();

    		// Yii::$app->mailer->compose()
      //           ->setFrom("secretariat@worldcultureforum-bali.org")
      //           ->setTo($email_foto[$i]["email"])
      //           ->setSubject("WCF 2016 Attendants data validation")
      //           ->setHtmlBody("Dear Mr./Ms. " . $full_name[0]["full_name"] . ",</br></br></br>
      //               <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
      //               <p>Thank you for your cooperation. We hope to see you in October.</p>
      //               <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

      //               <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
      //               <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
      //               <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
      //               <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
      //               <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
      //           ->send();
    	}

    	echo "success";

    }

    public function actionKirimEmailFoto4(){

    	$email_foto = Yii::$app->db->createCommand('SELECT email FROM foto GROUP BY email;')->queryAll();

    	for ($i=31; $i < 41; $i++) { 

    		// $full_name = Yii::$app->db->createCommand('SELECT full_name FROM foto WHERE email LIKE \''.$email_foto[$i]["email"].'\';')->queryAll();

    		// Yii::$app->mailer->compose()
      //           ->setFrom("secretariat@worldcultureforum-bali.org")
      //           ->setTo($email_foto[$i]["email"])
      //           ->setSubject("WCF 2016 Attendants data validation")
      //           ->setHtmlBody("Dear Mr./Ms. " . $full_name[0]["full_name"] . ",</br></br></br>
      //               <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
      //               <p>Thank you for your cooperation. We hope to see you in October.</p>
      //               <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

      //               <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
      //               <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
      //               <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
      //               <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
      //               <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
      //           ->send();
    	}

    	echo "success";

    }

    public function actionKirimEmailFoto5(){

    	$email_foto = Yii::$app->db->createCommand('SELECT email FROM foto GROUP BY email;')->queryAll();

    	for ($i=41; $i < 51; $i++) { 

    		// $full_name = Yii::$app->db->createCommand('SELECT full_name FROM foto WHERE email LIKE \''.$email_foto[$i]["email"].'\';')->queryAll();

    		// Yii::$app->mailer->compose()
      //           ->setFrom("secretariat@worldcultureforum-bali.org")
      //           ->setTo($email_foto[$i]["email"])
      //           ->setSubject("WCF 2016 Attendants data validation")
      //           ->setHtmlBody("Dear Mr./Ms. " . $full_name[0]["full_name"] . ",</br></br></br>
      //               <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
      //               <p>Thank you for your cooperation. We hope to see you in October.</p>
      //               <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

      //               <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
      //               <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
      //               <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
      //               <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
      //               <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
      //           ->send();
    	}

    	echo "success";

    }

    public function actionKirimEmailFoto6(){

    	$email_foto = Yii::$app->db->createCommand('SELECT email FROM foto GROUP BY email;')->queryAll();

    	for ($i=51; $i < 61; $i++) { 

    		// $full_name = Yii::$app->db->createCommand('SELECT full_name FROM foto WHERE email LIKE \''.$email_foto[$i]["email"].'\';')->queryAll();

    		// Yii::$app->mailer->compose()
      //           ->setFrom("secretariat@worldcultureforum-bali.org")
      //           ->setTo($email_foto[$i]["email"])
      //           ->setSubject("WCF 2016 Attendants data validation")
      //           ->setHtmlBody("Dear Mr./Ms. " . $full_name[0]["full_name"] . ",</br></br></br>
      //               <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
      //               <p>Thank you for your cooperation. We hope to see you in October.</p>
      //               <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

      //               <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
      //               <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
      //               <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
      //               <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
      //               <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
      //           ->send();
    	}

    	echo "success";

    }

    public function actionKirimEmailFoto7(){

    	$email_foto = Yii::$app->db->createCommand('SELECT email FROM foto GROUP BY email;')->queryAll();

    	for ($i=61; $i < 71; $i++) { 

    		// $full_name = Yii::$app->db->createCommand('SELECT full_name FROM foto WHERE email LIKE \''.$email_foto[$i]["email"].'\';')->queryAll();

    		// Yii::$app->mailer->compose()
      //           ->setFrom("secretariat@worldcultureforum-bali.org")
      //           ->setTo($email_foto[$i]["email"])
      //           ->setSubject("WCF 2016 Attendants data validation")
      //           ->setHtmlBody("Dear Mr./Ms. " . $full_name[0]["full_name"] . ",</br></br></br>
      //               <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
      //               <p>Thank you for your cooperation. We hope to see you in October.</p>
      //               <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

      //               <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
      //               <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
      //               <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
      //               <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
      //               <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
      //           ->send();
    	}

    	echo "success";

    }

    public function actionKirimEmailFoto8(){

    	$email_foto = Yii::$app->db->createCommand('SELECT email FROM foto GROUP BY email;')->queryAll();

    	for ($i=71; $i < 81; $i++) { 

    		// $full_name = Yii::$app->db->createCommand('SELECT full_name FROM foto WHERE email LIKE \''.$email_foto[$i]["email"].'\';')->queryAll();

    		// Yii::$app->mailer->compose()
      //           ->setFrom("secretariat@worldcultureforum-bali.org")
      //           ->setTo($email_foto[$i]["email"])
      //           ->setSubject("WCF 2016 Attendants data validation")
      //           ->setHtmlBody("Dear Mr./Ms. " . $full_name[0]["full_name"] . ",</br></br></br>
      //               <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
      //               <p>Thank you for your cooperation. We hope to see you in October.</p>
      //               <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

      //               <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
      //               <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
      //               <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
      //               <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
      //               <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
      //           ->send();
    	}

    	echo "success";

    }

    public function actionKirimEmailFoto9(){

    	$email_foto = Yii::$app->db->createCommand('SELECT email FROM foto GROUP BY email;')->queryAll();

    	for ($i=81; $i < 92; $i++) { 

    		// $full_name = Yii::$app->db->createCommand('SELECT full_name FROM foto WHERE email LIKE \''.$email_foto[$i]["email"].'\';')->queryAll();

    		// Yii::$app->mailer->compose()
      //           ->setFrom("secretariat@worldcultureforum-bali.org")
      //           ->setTo($email_foto[$i]["email"])
      //           ->setSubject("WCF 2016 Attendants data validation")
      //           ->setHtmlBody("Dear Mr./Ms. " . $full_name[0]["full_name"] . ",</br></br></br>
      //               <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
      //               <p>Thank you for your cooperation. We hope to see you in October.</p>
      //               <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

      //               <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
      //               <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
      //               <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
      //               <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
      //               <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
      //               <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
      //           ->send();
    	}

    	echo "success";

    }

    public function actionKirimEmailEssay1(){

    	$email_essay = Yii::$app->db->createCommand('SELECT * FROM essay;')->queryAll();

    	for ($i=0; $i < 11; $i++) { 

    		Yii::$app->mailer->compose()
                ->setFrom("secretariat@worldcultureforum-bali.org")
                ->setTo($email_essay[$i]["email"])
                ->setSubject("WCF 2016 Attendants data validation")
                ->setHtmlBody("Dear Mr./Ms. " . $email_essay[$i]["full_name"] . ",</br></br></br>
                    <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
                    <p>Thank you for your cooperation. We hope to see you in October.</p>
                    <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->send();
    	}

    	echo "success";
    }

    public function actionKirimEmailEssay2(){

    	$email_essay = Yii::$app->db->createCommand('SELECT * FROM essay;')->queryAll();

    	for ($i=11; $i < 21; $i++) { 

    		Yii::$app->mailer->compose()
                ->setFrom("secretariat@worldcultureforum-bali.org")
                ->setTo($email_essay[$i]["email"])
                ->setSubject("WCF 2016 Attendants data validation")
                ->setHtmlBody("Dear Mr./Ms. " . $email_essay[$i]["full_name"] . ",</br></br></br>
                    <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
                    <p>Thank you for your cooperation. We hope to see you in October.</p>
                    <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->send();
    	}

    	echo "success";
    }

    public function actionKirimEmailEssay3(){

    	$email_essay = Yii::$app->db->createCommand('SELECT * FROM essay;')->queryAll();

    	for ($i=21; $i < 31; $i++) { 

    		Yii::$app->mailer->compose()
                ->setFrom("secretariat@worldcultureforum-bali.org")
                ->setTo($email_essay[$i]["email"])
                ->setSubject("WCF 2016 Attendants data validation")
                ->setHtmlBody("Dear Mr./Ms. " . $email_essay[$i]["full_name"] . ",</br></br></br>
                    <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
                    <p>Thank you for your cooperation. We hope to see you in October.</p>
                    <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->send();
    	}

    	echo "success";
    }

    public function actionKirimEmailEssay4(){

    	$email_essay = Yii::$app->db->createCommand('SELECT * FROM essay;')->queryAll();

    	for ($i=31; $i < 41; $i++) { 

    		Yii::$app->mailer->compose()
                ->setFrom("secretariat@worldcultureforum-bali.org")
                ->setTo($email_essay[$i]["email"])
                ->setSubject("WCF 2016 Attendants data validation")
                ->setHtmlBody("Dear Mr./Ms. " . $email_essay[$i]["full_name"] . ",</br></br></br>
                    <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
                    <p>Thank you for your cooperation. We hope to see you in October.</p>
                    <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->send();
    	}

    	echo "success";
    }

    public function actionKirimEmailEssay5(){

    	$email_essay = Yii::$app->db->createCommand('SELECT * FROM essay;')->queryAll();

    	for ($i=41; $i < 51; $i++) { 

    		Yii::$app->mailer->compose()
                ->setFrom("secretariat@worldcultureforum-bali.org")
                ->setTo($email_essay[$i]["email"])
                ->setSubject("WCF 2016 Attendants data validation")
                ->setHtmlBody("Dear Mr./Ms. " . $email_essay[$i]["full_name"] . ",</br></br></br>
                    <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
                    <p>Thank you for your cooperation. We hope to see you in October.</p>
                    <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->send();
    	}

    	echo "success";
    }

    public function actionKirimEmailEssay6(){

    	$email_essay = Yii::$app->db->createCommand('SELECT * FROM essay;')->queryAll();

    	for ($i=51; $i < 61; $i++) { 

    		Yii::$app->mailer->compose()
                ->setFrom("secretariat@worldcultureforum-bali.org")
                ->setTo($email_essay[$i]["email"])
                ->setSubject("WCF 2016 Attendants data validation")
                ->setHtmlBody("Dear Mr./Ms. " . $email_essay[$i]["full_name"] . ",</br></br></br>
                    <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
                    <p>Thank you for your cooperation. We hope to see you in October.</p>
                    <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->send();
    	}

    	echo "success";
    }

    public function actionKirimEmailEssay7(){

    	$email_essay = Yii::$app->db->createCommand('SELECT * FROM essay;')->queryAll();

    	for ($i=61; $i < 71; $i++) { 

    		Yii::$app->mailer->compose()
                ->setFrom("secretariat@worldcultureforum-bali.org")
                ->setTo($email_essay[$i]["email"])
                ->setSubject("WCF 2016 Attendants data validation")
                ->setHtmlBody("Dear Mr./Ms. " . $email_essay[$i]["full_name"] . ",</br></br></br>
                    <p>Due to deadline of confirming attendance at the upcoming event, World Culture Forum 2016. We would like you to validate and double check your registration data as it is will be used to arrange the logistics. Please login with your account at http://reg.worldcultureforum-bali.org and update your data if it is necessary, specifically your photograph and ID section. If you find some errors in the registration data which you have entered, please update and resubmit the data. If you find this inconvenience, we really sorry for this.</p>
                    <p>Thank you for your cooperation. We hope to see you in October.</p>
                    <p>Best regards,<br>Secretariat World Culture Forum 2016.</p><br>

                    <p style='color:#F89821; font-size:20px'>World Culture Forum</p>
                    <p style='font-style:italic'>Ministry of Education and Culture Republic of Indonesia</p>
                    <p style='font-style:italic'>Building E 6th Floor, Jl. Jenderal Sudirman, Senayan - Jakarta 10270</p>
                    <p><span style='color:#F89821'>p: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>f: </span>+62 21 572 5532</p>
                    <p><span style='color:#F89821'>w: </span>www.worldcultureforum-bali.org
                    <span style='color:#F89821; margin-left:5px'>e: </span>secretariat@worldcultureforum-bali.org</p><br/><br/><br/><br/><br/>")
                ->send();
    	}

    	echo "success";
    }

    public function actionKtpUpdateSubmit(){

    	$email_ktp = Yii::$app->db->createCommand('SELECT email FROM ktp;')->queryAll();

    	for ($i=0; $i < count($email_ktp); $i++) { 
    		// Yii::$app->db->createCommand('UPDATE participant SET submit = FALSE WHERE LOWER(email) LIKE \''.strtolower($email_ktp[$i]["email"]).'\';')->execute();
    	}
    	echo "success";
    }

    public function actionFotoUpdateSubmit(){

    	$email_ktp = Yii::$app->db->createCommand('SELECT email FROM foto;')->queryAll();

    	for ($i=0; $i < count($email_ktp); $i++) { 
    		Yii::$app->db->createCommand('UPDATE participant SET submit = FALSE WHERE LOWER(email) LIKE \''.strtolower($email_ktp[$i]["email"]).'\';')->execute();
    	}
    	echo "success";
    }

    public function actionEssayUpdateSubmit(){

    	$email_ktp = Yii::$app->db->createCommand('SELECT email FROM essay;')->queryAll();

    	for ($i=0; $i < count($email_ktp); $i++) { 
    		Yii::$app->db->createCommand('UPDATE participant SET submit = FALSE WHERE LOWER(email) LIKE \''.strtolower($email_ktp[$i]["email"]).'\';')->execute();
    	}
    	echo "success";
    }

}
