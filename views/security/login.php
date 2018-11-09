<?php 
use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?> 
	<!-- <div class="container">
		<div align="center" class="col-md-12" style="position:fixed; z-index;9999; margin-top:100px;">
			 Please login to your account if you already have registered.
		</div>
	</div> -->
	<style type="text/css">
		.has-error .help-block, .has-error .control-label, .has-error .radio, .has-error .checkbox, .has-error .radio-inline, .has-error .checkbox-inline, .has-error.radio label, .has-error.checkbox label, .has-error.radio-inline label, .has-error.checkbox-inline label {
		    color: #000;
		}
	</style>
	<body id="top">
		
		<!-- Header -->
		<header id="header">
			
			<div class="container2">
				<div class="col-lg-12">
					 <!-- <div align="center" class="alert alert-warning"> 
					    <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#000;">&times;</a>
					    Please login to your account if you already have registered.
					 </div> -->
				</div>

				<div class="col-sm-6">
					<div class="pull-right capslock hilang" >
						<h1 align="right">
							World<br>Culture<br>Forum<br>2016
						</h1>
					</div>
					
				</div>
				<div class="col-sm-4 mob-50">
					<!-- <ul class="nav nav-tabs">
					  <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
					  <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
					</ul>
 					-->
					<div class="tab-content">
						<div align="center" class="alert alert-warning"> 
						    <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color:#000;">&times;</a>
						    Please login to your account if you already have registered or Sign up a new account if you do not have yet.
						 </div>
					
					 
						<div id="home" class="tab-pane fade in active">
						    <div class="form-login">
								<?php $form = ActiveForm::begin([
				                    'id'                     => 'login-form',
				                    'enableAjaxValidation'   => true,
				                    'enableClientValidation' => false,
				                    'validateOnBlur'         => false,
				                    'validateOnType'         => false,
				                    'validateOnChange'       => false,
				                ]) ?>

				                <?= $form->field($model, 'login', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1','placeholder' => 'Username']]) ?>

				                <?= $form->field($model, 'password', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2','placeholder' => 'Password']])->passwordInput()->label(Yii::t('user', 'Password') . ($module->enablePasswordRecovery ? ' (' . Html::a(Yii::t('user', 'Forgot password?'), ['/user/recovery/request'], ['tabindex' => '5']) . ')' : '')) ?>

				                <?= Html::submitButton(Yii::t('user', 'Sign in'), ['class' => 'btn btn-warning col-md-12', 'tabindex' => '3']) ?>

				                <?php ActiveForm::end(); ?>
							</div>
						</div>

						<div class="row" style="margin-top:80px;">
								<div class="col-md-12">
										<?php if ($module->enableConfirmation): ?>
								            <p class="text-center" style="font-size: 14px;">
								                <?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?>
								            </p>
								        <?php endif ?>
				        		</div>
								<div class="col-md-12">
										<?php if ($module->enableRegistration): ?>
								            <p class="text-center" style="font-size: 14px;">
								                <?= Html::a(Yii::t('user', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
								            </p>
								        <?php endif ?>
								</div>

						</div>
					  	
				        
				        <?= Connect::widget([
				            'baseAuthUrl' => ['/user/security/auth'],
				        ]) ?>
					  
					</div>
				</div>
			</div>
		</header>
	</body>