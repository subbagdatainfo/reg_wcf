<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;
use dektrium\user\widgets\Connect;
$this->title = 'Registration Participant';
?>
<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
<script>
   $(function() {
       $( "[title]" ).tooltip();
   });
</script>

	<header id="header" style="margin-top:50px; margin-bottom:20px;">
			<div class="container2">
				<div class="col-sm-6">
					<div class="pull-right capslock hilang">
						<h1 align="right">
							World<br>Culture<br>Forum<br>2016
						</h1>
					</div>
					
				</div>
				<div class="col-sm-4">
					<div class="tab-content">
						  <div id="home" class="tab-pane fade in active">
						    <div class="form-login">
								<?php $form = ActiveForm::begin([
						                    'id'                     => 'registration-form',
						                    //'enableAjaxValidation'   => true,
						                    //'enableClientValidation' => false,
						                ]); ?>

						                <?= $form->field($model, 'email') ?>

						                <?= $form->field($model, 'username') ?>

						                <?php if ($module->enableGeneratingPassword == false): ?>
						                    <?= $form->field($model, 'password')->passwordInput(['data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Password must contain Alphanumeric']) ?>
						                <?php endif ?>

						                <?= $form->field($model, 'captcha')->widget(Captcha::className(), [
					                        'captchaAction' => ['/site/captcha']
					                    ])->label('<p style="font-size:12px; padding:0; margin:0;">Please click on the image to get new code</p>') ?>


						                <input type="checkbox" id="accept" onclick="calc()"> I Accept
						                <p style="font-size:12px; color:#ffffff;">By clicking "I Accept" below, you acknowledge, understand and further agree that you will observe and be willing to be bound by the World Culture Forum 2016 <a  style="color:blue" href="https://worldcultureforum-bali.org/general-terms-and-conditions-for-participants/" target="_blank">Terms & Condition.</a></p>
			
						                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['id' => 'signup', 'class' => 'btn btn-warning btn-block', 'disabled'=>true]) ?>

						        <?php ActiveForm::end(); ?>
							</div>
						  </div>

						  	<br/>
							<div class="row">
									<div class="col-md-12">
											<p class="text-center" style="font-size: 14px;"><?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?></p>
					        		</div>
							</div>
					        
					        <?= Connect::widget([
					            'baseAuthUrl' => ['/user/security/auth'],
					        ]) ?>
						  
					</div>
				</div>
				
			</div>
		</header>
<script type="text/javascript">
function calc()
{
	if (document.getElementById('accept').checked) 
	{
		document.getElementById('signup').disabled = false;
	}else{
		document.getElementById('signup').disabled = true;
	}
}
</script>
