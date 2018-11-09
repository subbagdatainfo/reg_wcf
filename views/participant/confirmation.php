<?php

use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use kartik\widgets\DatePicker;
use app\models\Varietypartisipant;
use app\models\Attend;
use app\models\Country;
use app\models\Participant;

/* @var $this yii\web\View */
/* @var $model app\models\Participant */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Confirmation';
$this->params['breadcrumbs'][] = $this->title;

$Participant = Participant::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

?>

<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
<script>
   $(function() {
       $( "[title]" ).tooltip();
   });
</script>

<div class="participant-form">
    <div class="container" style="margin-top: 70px;">
        <?php if ($Participant) { ;?>
            <div class="alert alert-success" role="alert" align="center">Thanks for confirming the World Culture Forum 2016 Invitation. Please Fill Biodata form in menu ‘Biodata’ .
             
            </div>
        <?php }else{ ;?>
            <?php Pjax::begin(); ?>
                <?= Html::beginForm(['participant/confirmation'], 'post', ['data-pjax' => '']); ?>
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6 col-xs-12 thumbnail" style="padding: 20px;">
                            <?= Html::input('invitation_code', 'invitation_code', Yii::$app->request->post('invitation_code'), ['class' => 'form-control','placeholder' => 'Insert your Invitation Code','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Enter the invitation code as the invitation card','id' => 'invitation_code']) ?><br>
                            <?= Html::input('token', 'token', Yii::$app->request->post('token'), ['class' => 'form-control','placeholder' => 'Insert your Token','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Enter the token as the invitation card','id' => 'token']) ?><br>
                            <?= Html::submitButton('Submit', ['onclick'=>'Spinner()','class' => 'btn btn-warning pull-right', 'name' => 'submit-button']) ?>
                            <center><br><div id="spinner"></div></center>
                            <?php if (!empty($ParticipantCandidate) && $ParticipantCandidate->full_name !== 'This invitation code is already in use.' && $ParticipantCandidate->full_name !== 'Invalid invitation code or token.') { ;?>
                                <br><br><hr>
                                <b>Your name is :</b><br><div id="full_name"><?= $ParticipantCandidate->full_name ;?> <b>?</b></div><br><br>
                                <?= Html::input('yes', 'yes', Yii::$app->request->post('yes'), ['class' => 'form-control','style' => 'display: none;', 'value' => 'yes']) ?><br>
                                <?= Html::submitButton('Yes', ['class' => 'btn btn-success pull-right', 'name' => 'submit-button-yes']) ?>
                                <a onclick="return confirm('Please report the error/mistake to admin@worldcultureforum-bali.org or call +6221 5725532')" class="btn btn-danger" href="<?= Url::to('confirmation');?>" role="button">No</a>
                            <?php }elseif (!empty($ParticipantCandidate) && $ParticipantCandidate->full_name == 'This invitation code is already in use.') { ;?>
                                <hr><br><div class="alert alert-info" role="alert"><b><?= $ParticipantCandidate->full_name ;?></b></div>
                            <?php }elseif (!empty($ParticipantCandidate) && $ParticipantCandidate->full_name == 'Invalid invitation code or token.') { ;?>
                                <hr><br><div class="alert alert-danger" role="alert"><b>Invalid invitation code or token.</b></div>
                            <?php };?>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                <?= Html::endForm() ?>
            <?php Pjax::end(); ?>
        <?php }; ?>
    </div>
</div>

<script>
function Spinner(){
    document.getElementById('spinner').innerHTML = '<img src="<?= Yii::$app->homeUrl;?>spinner.gif" height="150" />';
}

// function myFunction() {
//     // var invitation_code = document.getElementById('invitation_code').value;
//     // var token           = document.getElementById('token').value;
//     // var full_name       = document.getElementById('full_name').innerHTML;

//     // swal({
//     //     title: "Please check again your invitation code & token or contact administrator",   
//     //     type: "warning",   
//     //     showCancelButton: true,   
//     //     confirmButtonColor: "#DD6B55",   
//     //     confirmButtonText: "Contact Administrator",   
//     //     closeOnConfirm: false 
//     // }, 

//     alert('')

//     // function(){
//     //     swal('You have been contact administrator'); 
//     //     $.ajax({
//     //         url: '../participant/contact-administrator',
//     //         data: {
//     //             "full_name": full_name,
//     //             "invitation_code": invitation_code,
//     //             "token": token
//     //         },
//     //         dataType: "json"
//     //     });
//     // });
// } 
</script> 