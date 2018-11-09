<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dektrium\user\widgets\Connect;
$this->title = 'Forgot Password';
?>

	<header id="header">
			<div class="container2">
				<div class="col-sm-6">
					<div class="pull-right capslock">
						<h1 align="right">
							World<br>Culture<br>Forum<br>2016
						</h1>
					</div>
					
				</div>
				<div class="col-sm-6" style="top: 40px;">
					<div class="tab-content">
						  <div id="home" class="tab-pane fade in active">
						    <div class="form-login">
								 <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
							</div>
						  </div>
							
									<?php $form = ActiveForm::begin([
					                    'id'                     => 'password-recovery-form',
					                    'enableAjaxValidation'   => true,
					                    'enableClientValidation' => false,
					                ]); ?>

					                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

					                <?= Html::submitButton(Yii::t('user', 'Continue'), ['class' => 'btn btn-primary btn-block']) ?><br>

					                <?php ActiveForm::end(); ?>
					</div>
				</div>
				
			</div>
			<!-- <div class="content">
				<h1><a href="#">WORLD <br>CULTURE <br>FORUM  <br>2016  </a></h1>
				<p>Just a simple, single page responsive<br />
				template brought to you by <a href="http://html5up.net">HTML5 UP</a></p>
				<ul class="actions">
					<li><a href="#" class="button special icon fa-download">Download</a></li>
					<li><a href="#one" class="button icon fa-chevron-down scrolly">Learn More</a></li>
				</ul>
			</div>
			<div class="image phone">
				<div class="inner">
					<img src="images/screen.jpg" alt="" />
				</div>
			</div> -->
		</header>
