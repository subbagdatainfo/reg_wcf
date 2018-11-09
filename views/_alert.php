<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Registration Participant';
?>

		<header id="headerw" style="margin-top:70px;">
			<div class="container">
				
					<div class="capslock">
						<h1 align="center">
							World Culture Forum 2016
						</h1>
					</div>

					<div class="tab-content">
							<?php if ($module->enableFlashMessages): ?>
							    <div class="row">
							        <div class="col-xs-12" align="center">
							            <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
							                <?php if (in_array($type, ['success', 'danger', 'warning', 'info'])): ?>
							                    <div align="center" class="alert alert-<?= $type ?>">
							                        <?= $message ?>
							                    </div>
							                <?php endif ?>
							            <?php endforeach ?>
							        </div>
							    </div>
							<?php endif ?>
					</div>
			</div>
		</header>
