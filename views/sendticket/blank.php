<?php

use yii\helpers\Url;

$this->title = 'blank';
$this->params['breadcrumbs'][] = $this->title;


?>


<div class="alert alert-danger" role="alert">Please submit your application in order to get World Culture Forum 2016 Send Ticket To Email.  <a href="<?= Url::to(['participant/re-registration', 'id' => Yii::$app->user->identity->id]); ?>" style="text-decoration:none; color:blue">Click Here to Complete your registration</a></div>