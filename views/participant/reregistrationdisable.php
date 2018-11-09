<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use kartik\widgets\DatePicker;
use app\models\Varietypartisipant;
use app\models\Participant;
use app\models\Attend;
use app\models\Symposium;
use app\models\Dietarypreferences;
use app\models\Country;
use app\models\Representative;
use kartik\widgets\FileInput;
use kartik\widgets\TimePicker;
use unclead\widgets\MultipleInput;

/* @var $this yii\web\View */
/* @var $model app\models\Participant */
/* @var $form yii\widgets\ActiveForm */

$title                  = [1 => 'Mr', 2 => 'Ms'];
$default_departure      = date('09-10-2016');

if ($model->attend_id == 1) {
    $default_departure      = date('09-10-2016');
}elseif ($model->attend_id == 1) {
    $default_departure      = date('12-10-2016');
}elseif ($model->attend_id == 1) {
    $default_departure      = date('10-10-2016');
}elseif ($model->attend_id == 1) {
    $default_departure      = date('11-10-2016');
}elseif ($model->attend_id == 1) {
    $default_departure      = date('12-10-2016');
}

if ($model->title == 1) {
    $titles = 'Mr';
}elseif ($model->title == 3) {
    $titles = 'Ms';
}else{
    $titles = 'Ms';
}

$status_representative  = Representative::find()->where(["user_id"=>Yii::$app->user->identity->id])->one();
$status_companion       = Participant::find()->where(["is_companion_from"=>$model->id])->one();

$this->title = 'Registration Data';
$this->params['breadcrumbs'][] = $this->title;

?>

<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
<script>
   $(function() {
       $( "[title]" ).tooltip();
   });
</script>

<?php if($model->submit == TRUE){?>
        <div class="alert alert-success alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin:-15px 10px 0 0"><span aria-hidden="true">&times;</span></button>
          <strong><?= 'Thank you for confirming your attendance to World Culture Forum 2016. Should you have any inquiry, you can contact the secretariat at +6221 5725532'; ?></strong> 
        </div>
<?php }else{ ?>
    <?php echo ''; ?>
<?php } ?>

<div class="participant-form">
    <?php $form = ActiveForm::begin(['options' => ['enableClientScript' => true, 'enctype' => 'multipart/form-data','id' => 'login-form']]) ?>
    
    <div class="row s">
        <div class="col-md-12 col-sm-12">
                <div class="jumbotron">
                    <div style="padding:5px;">
                        <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Personal Details</h4>
                        <hr class="style-one">

                        <!-- IF Representative -->
                        <?php if ($status_representative) { ;?>
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin:-15px 10px 0 0"><span aria-hidden="true">&times;</span></button>
                                <strong>Representative of <?= $status_representative->full_name;?></strong> 
                            </div>
                        <?php } ?>
                        <!-- IF Representative -->

                            <div class="row">
                                    <div class="col-md-2 col-sm-4">
                                        <?= $form->field($model, 'title')->widget(Select2::classname(), [
                                            'data' => $title,
                                            'options' => [
                                                'placeholder' => 'Your title',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' =>'right',
                                                'title' => 'Please select from the dropdown menu'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                            'disabled' =>true,
                                        ]); ?>
                                    </div>
                                    <div class="col-md-7 col-sm-4">
                                        <?= $form->field($model, 'full_name')->textInput(['readOnly' =>true,'placeholder' => 'Your Name','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Name should be exactly the same with your Passport or ID card. Please double check before submitting']) ?>
                                    </div>
                                    <div class="col-md-3 col-sm-4">
                                        <?= $form->field($model, 'name_on_badge')->textInput(['readOnly' =>true,'placeholder' => 'Ex : John Doe, Ph.D.','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'This name will appear in ID card and name tag']) ?>
                                    </div>
                            </div>

                            <div class="row">
                                    <div class="col-sm-4">
                                        <?= $form->field($model, 'phone')->textInput(['readOnly' =>true,'placeholder' => 'Ex: +621 099 9999','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please input your home number.']) ?>
                                    </div>

                                    <div class="col-sm-4">
                                        <?= $form->field($model, 'handphone')->textInput(['readOnly' =>true,'placeholder' => 'Ex: +62 813 09090909','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please input your handphone number.']) ?>
                                    </div>
                                    <div class="col-sm-4">
                                      <?= $form->field($model, 'email')->textInput(['readOnly' =>true,'placeholder' => '','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Your email.','value' => $user['email']]) ?>
                                    </div>
                            </div>

                            <div class="row">
                                     <div class="col-md-6 col-sm-6">
                                        <?= $form->field($model, 'fax')->textInput(['readOnly' =>true,'placeholder' => 'Ex: +621 099 9999','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please input your Fax number.']) ?>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <?= $form->field($model, 'organization')->textInput(['readOnly' =>true,'placeholder' => 'Please input your Organization.','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please input your Organization.']) ?>
                                    </div>
                            </div>  

                            <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <?= $form->field($model, 'gender')->widget(Select2::classname(), [
                                            'data' => [0 => 'Male', 1 => 'Female'],
                                            'options' => [
                                                'placeholder' => 'Your gender',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' =>'right',
                                                'title' => 'Please select gender'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                            'disabled' =>true,
                                        ]); ?>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <?= $form->field($model, 'date_of_birth')->widget(DatePicker::classname(), [
                                            'name' => 'date_of_birth',
                                            'type' => DatePicker::TYPE_INPUT,
                                            'value' => '23-Feb-1982',
                                            'pluginOptions' => [
                                                'autoclose'=>true,
                                                'format' => 'dd-M-yyyy'
                                            ],
                                            'options' => [
                                                'placeholder' => 'Your date of birth',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' =>'right',
                                                'title' => 'Please input your date of birth'
                                            ],
                                            'disabled' =>true,
                                        ]); ?>
                                    </div>
                            
                            </div>

                            

                    </div>

                        <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <?= $form->field($model, 'country_id')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map(Country::find()->all(), 'id', 'country_name'),
                                        'options' => [
                                            'placeholder' => 'Your location',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' =>'right',
                                            'title' => 'Please select your location'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                        'disabled' =>true,
                                    ])->label("Location"); ?>
                                </div>

                                <div class="col-md-6 col-sm-6">
                    
                                    <?= $form->field($model, 'nationality')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map(Country::find()->all(), 'id', 'country_name'),
                                        'options' => [
                                            'placeholder' => 'Your nationality',
                                            'data-toggle' => 'tooltip',
                                            'data-placement' =>'right',
                                            'title' => 'Please select your nationality'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                        'pluginEvents' => [
                                            "change" => "function(){GetDataNasionality(); }",
                                        ],
                                        'disabled' =>true,
                                    ])->label("Nationality"); ?>
                                   
                                </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($model, 'pasport_ktp_number')->textInput(['readOnly' =>true])->label('Pasport Number', ['id' => 'pasport_ktp_number']) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'place_of_issue')->textInput(['readOnly' =>true]) ?>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6" id="start_date">
                                <?= $form->field($model, 'start_date')->widget(DatePicker::classname(),[
                                    'name' => 'start_date',
                                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                    'options' => [
                                        'placeholder' => 'Expired Date',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' =>'right',
                                        'title' => 'Expired Date',

                                    ],
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                        'format' => 'dd-mm-yyyy',
                                        'todayHighlight' => true,
                                    ],
                                    'disabled' =>true,
                                ])->label('Date Of Issue') ?>
                            </div>
                            <div class="col-sm-6" id="end_date">
                                <?= $form->field($model, 'end_date')->widget(DatePicker::classname(),[
                                    'name' => 'end_date',
                                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                    'options' => [
                                        'placeholder' => 'Expired Date',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' =>'right',
                                        'title' => 'Expired Date'

                                    ],
                                    'pluginOptions' => [
                                        'autoclose'=>true,
                                        'format' => 'dd-mm-yyyy',
                                        'todayHighlight' => true,
                                    ],
                                    'disabled' =>true,
                                ])->label('Expired Date') ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <?= $form->field($model, 'address')->textArea([
                                    'readOnly' =>true,
                                    'rows' => '4',
                                    'placeholder' => 'Your Address',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' =>'right',
                                    'title' => 'Please fill the address completely.'
                                ]) ?>
                            </div>
                        </div>

                        <div class="row">
                                    
                            <div class="col-md-6">
                    
                                <?php if(!empty($model->user_photo)){ ?>

                                    <?= $form->field($model, 'user_photo')->widget(FileInput::classname(), [
                                        'options' => [
                                            'accept' =>'image/*'
                                        ],
                                        'pluginOptions' => [
                                            'initialPreview'=>[
                                               Html::img($model['user_photo'] == "" ? '@web/uploads/user_photo/no-img.jpg' : '@web/uploads/user_photo/'.$model['user_photo'],['target'=>'_blank','style' => 'text-decoration:none; font-weight:bold; height:180px; width:250px;'])
                                            ],
                                            'showRemove' => false,
                                            'showUpload' => false,
                                            'overwriteInitial'=>true
                                        ],
                                        'disabled' =>true,
                                    ]);?>

                                <?php }else{ ?>

                                    <?= $form->field($model, 'user_photo')->widget(FileInput::classname(), [
                                        'options' => [
                                                'accept' => 'image/*',
                                        ],
                                        'disabled' =>true,
                                    ])->label('Upload Photo'); ?>

                                <?php } ?>
                            </div>

                            <div class="col-md-6">
                    
                                <?php if(!empty($model->ktp_pasport)){ ?>

                                    <?= $form->field($model, 'ktp_pasport')->widget(FileInput::classname(), ['options' => ['accept' =>'image/*'],
                                        'pluginOptions' => [
                                            'initialPreview'=>[
                                               Html::img($model['ktp_pasport'] == "" ? '@web/images/blank.png' : '@web/uploads/ktp_pasport/'.$model['ktp_pasport'],['target'=>'_blank','style' => 'text-decoration:none; font-weight:bold; height:180px; width:250px;'])
                                            ],
                                            'showRemove' => false,
                                            'showUpload' => false,
                                            'overwriteInitial'=>true
                                        ],
                                        'disabled' =>true,
                                    ])->label('Upload Pasport', ['id' => 'ktp_pasport']);?>

                                <?php }else{ ?>

                                    <?= $form->field($model, 'ktp_pasport')->widget(FileInput::classname(), [
                                        'options' => [
                                            'accept' => 'image/*',
                                        ],
                                        'disabled' =>true,
                                    ])->label('Upload Pasport', ['id' => 'ktp_pasport']); ?>

                                <?php } ?>
                            </div>
                        </div>
                </div><!-- jumbotron current address AND PERSONAL DETAIL-->

                <?php if($model->speaker === TRUE){ ?>
                    <div class="jumbotron">

                        <div class="row">
                            <div class=col-sm-12>
                                <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Speaker</h4>
                                 <hr class="style-one">
                                <div align="center"><h5 style="font-weight:bold; font-size:16px; text-decoration:none; margin: 20px 0 30px 0">Abstract</h5></div>
                             </div>

                            <div class="col-sm-6">
                                    <?= $form->field($model, 'tittle')->textInput(['readOnly' =>true,'placeholder' => 'Tittle Of Abstract','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Tittle Of Abstract.']) ?>
                            </div>

                            <div class="col-sm-6">
                                    <?= $form->field($model, 'author')->textInput(['readOnly' =>true,'placeholder' => 'Author Of Abstract','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Author Of Abstract.']) ?>
                            </div>

                            <div class="col-sm-12">
                                    <?= $form->field($model, 'content')->textArea(['readOnly' =>true,'rows' => '6','placeholder' => 'Content Of Abstract','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Content Of Abstract.']) ?>
                            </div>

                            <div class="col-sm-4">
                                    <?php if(!$model->isNewRecord){ ?>

                                        <?= $form->field($model, 'abstract')->widget(FileInput::classname(), ['options' => ['accept' =>'image/*'],
                                            'pluginOptions' => [
                                                'initialPreview'=>[

                                                     '<embed class="kv-preview-data" src="../uploads/abstract/'.$model["abstract"].'" width="160px" height="160px" type="application/pdf" internalinstanceid="106">'
                                                ],
                                                'showRemove' => false,
                                                'showUpload' => false,
                                                'overwriteInitial'=>true
                                            ],
                                            'disabled' =>true,
                                        ]);?>

                                    <?php }else{ ?>

                                        <?= $form->field($model, 'abstract')->widget(FileInput::classname(), [
                                            'options' => [
                                                    'accept' => 'image/*',

                                            ],
                                            'disabled' =>true,
                                        ])->label('Upload Abstract'); ?>

                                    <?php } ?>
                            </div>

                            <div class="col-sm-4">
                                <?php if(!$model->isNewRecord){ ?>

                                    <?= $form->field($model, 'file_presentation')->widget(FileInput::classname(), ['options' => ['accept' =>'image/*'],
                                        'pluginOptions' => [
                                            'initialPreview'=>[

                                                 '<embed class="kv-preview-data" src="../uploads/presentation/'.$model["file_presentation"].'" width="160px" height="160px" type="application/pdf" internalinstanceid="106">'
                                            ],
                                            'showRemove' => false,
                                            'showUpload' => false,
                                            'overwriteInitial'=>true
                                        ],
                                        'disabled' =>true,
                                    ]);?>

                                <?php }else{ ?>

                                    <?= $form->field($model, 'file_presentation')->widget(FileInput::classname(), [
                                        'options' => [
                                                'accept' => 'image/*',
                                                
                                        ],
                                        'disabled' =>true,
                                    ])->label('File Presentation'); ?>


                                <?php } ?>
                            </div>

                            <div class="col-sm-4">

                                <?php if(!$model->isNewRecord){ ?>

                                    <?= $form->field($model, 'full_paper')->widget(FileInput::classname(), ['options' => ['accept' =>'image/*'],
                                        'pluginOptions' => [
                                            'initialPreview'=>[

                                                 '<embed class="kv-preview-data" src="../uploads/paper/'.$model["full_paper"].'" width="160px" height="160px" type="application/pdf" internalinstanceid="106">'
                                            ],
                                            'showRemove' => false,
                                            'showUpload' => false,
                                            'overwriteInitial'=>true
                                        ],
                                        'disabled' =>true,
                                    ]);?>

                                <?php }else{ ?>

                                    <?= $form->field($model, 'full_paper')->widget(FileInput::classname(), [
                                        'options' => [
                                            'accept' => 'image/*',
                                        ],
                                        'disabled' =>true,
                                    ])->label('Full Paper'); ?>

                                <?php } ?>
                            </div>

                            <div class="col-md-12" style="font-size:14px; color:red;">
                                <em><center>* If you haven’t had the file yet. You can login to your account for later upload. </center></em>
                            </div>

                        </div><!--close row -->

                    </div><!-- jumbotron speaker-->

                <?php }else{ ?>
                    <?php echo '' ;?>
                <?php } ?>


                    <div class="jumbotron">
                        <div class="row">
                             <div class=col-sm-12>
                                <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Arrival & Departure</h4>
                                <hr class="style-one">

                            </div>

                            <div class="col-md-12">
                                <?= $form->field($model, 'transportation')->widget(Select2::classname(), [
                                        'data' => [1 => 'Air', 2 => 'Non Air'],
                                        'hideSearch' => true,
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        ],
                                        'pluginEvents' => [
                                            "change" => "function(){GetTransportation()}",
                                        ],
                                        'disabled' =>true,
                                ])->label("Transportation"); ?>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <?= $form->field($model, 'date_arrival')->widget(DatePicker::classname(),[
                                   'name' => 'date_arrival',
                                   'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                   'disabled'   => false,
                                   'options' => [
                                       'placeholder' => 'Date Arrival',
                                       'data-toggle' => 'tooltip',
                                       'data-placement' =>'right',
                                       'title' => 'Date Arrival',
                                   ],
                                   'pluginEvents' => [
                                        "hide" => "function(e) {ConditionalForCulturalVisit()}",
                                    ],
                                   'pluginOptions' => [
                                       'autoclose'=>true,
                                       'format' => 'dd-M-yyyy',
                                       'todayHighlight' => true,
                                       'convertFormat' => true,
                                       'startDate' => date('09-10-2016'),
                                       'endDate' => date('15-10-2016'),
                                   ],
                                   'disabled' =>true,
                                ])->label('Date Arrival') ?>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <?= $form->field($model, 'date_departure')->widget(DatePicker::classname(),[
                                   'name' => 'date_departure',
                                   'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                   'options' => [
                                       'placeholder' => 'Date Departure',
                                       'data-toggle' => 'tooltip',
                                       'data-placement' =>'right',
                                       'title' => 'Date Departure'
                               
                                   ],
                                   'pluginOptions' => [
                                       'autoclose'=>true,
                                       'format' => 'dd-M-yyyy',
                                       'todayHighlight' => true,
                                       'startDate' => $default_departure,
                                       'endDate' => date('15-10-2016'),
                                   ],
                                   'disabled' =>true,
                               
                               ])->label('Date Departure') ?>
                            </div>
                            <div class="col-md-6 col-sm-6" onmouseover="ConditionalForCulturalVisit()">
                                <?= $form->field($model, 'time_arrival')->widget(TimePicker::classname(),[ 
                                    'name' => 'time_arrival',
                                    'options' => [
                                        'placeholder' => 'Time Arrival',
                                        'data-toggle' => 'tooltip',
                                        'data-placement' =>'right',
                                        'title' => 'Time Arrival'
                                    ],
                                    'pluginOptions' => [
                                        'showSeconds' => true,
                                        'showMeridian' => false,
                                        'minuteStep' => 1,
                                        'secondStep' => 5,
                                        'disableFocus' => true,
                                        'disableMousewheel' => true,
                                    ],
                                    'disabled' =>true,
                                ]); ?>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <?= $form->field($model, 'time_departure')->widget(TimePicker::classname(),[ 
                                   'name' => 'time_arrival',
                                   'options' => [
                                       'placeholder' => 'Time Departure',
                                       'data-toggle' => 'tooltip',
                                       'data-placement' =>'right',
                                       'title' => 'Time Departure'
                           
                                   ],
                                   'pluginOptions' => [
                                       'showSeconds' => true,
                                       'showMeridian' => false,
                                       'minuteStep' => 1,
                                       'secondStep' => 5,
                                   ],
                                   'disabled' =>true,
                               ]); ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'flight_number_arrival')->textInput(['readOnly' =>true,'placeholder' => 'Flight Number Arrival','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Flight Number Arrival.','disabled' => false, 'id' => 'flight_number_arrival']) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'flight_number_departure')->textInput(['readOnly' =>true,'placeholder' => 'Flight Number Departure','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Flight Number Departure.','disabled' => false, 'id' => 'flight_number_departure']) ?>
                            </div>

                        </div><!--close row -->
                        <em><span style="font-size: 14px;" align="justify">* The accommodation only available and valid for </strong> Date Departure = <?= $default_departure;?> and .</span></em>
                    </div><!-- close jumbotron -->
                    

                    <div class="jumbotron">
                        <div class="row">
                            <div class=col-sm-12>
                                <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Symposium</h4>
                                <hr class="style-one">
                            </div>
                            
                            <div class="col-sm-12" style="margin-bottom:10px;">
                                    
                                <?php $list_symposium_day_one = ArrayHelper::map(Symposium::find()->where(['id' => $symposium_day_one_id_is])->all(), 'id', 'symposium_name') ?>
                                    
                                <?php
                                    // menampung data list_ymposium_day_one dalam bentuk array 
                                    $olah_symposium_day_one = [];

                                    foreach ($list_symposium_day_one as $key => $value) {
                                        $olah_symposium_day_one[$key] = $value . " (" .Participant::find()->where(['symposium_day_one_id'=> $key])->count() . " / 200)";
                                    }
                                ?>

                                <?= $form->field($model, 'symposium_day_one_id')->radioList($olah_symposium_day_one, ['disabledItems'=>[1,2,3]])->label("Symposium Day One"); ?>

                            </div>

                            <div class="col-sm-12">

                                <?php $list_symposium_day_two = ArrayHelper::map(Symposium::find()->where(['id' => $symposium_day_two_id_is])->all(), 'id', 'symposium_name') ?>
                                    
                                <?php

                                    // menampung data list_ymposium_day_two dalam bentuk array 
                                    $olah_symposium_day_two = [];

                                    foreach ($list_symposium_day_two as $key => $value) {
                                        $olah_symposium_day_two[$key] = $value . " (" .Participant::find()->where(['symposium_day_two_id'=> $key])->count() . " / 200)";
                                            
                                } ?>

                                <?= $form->field($model, 'symposium_day_two_id')->radioList($olah_symposium_day_two, ['disabledItems'=>[4,5,6]])->label("Symposium Day Two"); ?>

                            </div>

                        </div><!--close row -->
                </div><!-- close jumbotron -->

                    <div class="jumbotron">

                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Attend</h4>
                                 <hr class="style-one">


                            </div>

                            <div class="col-md-4 col-sm-6">
                                 <?= $form->field($model, 'attend_id')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(Attend::find()->all(), 'id', 'information'),
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                    'disabled' =>true,
                                ])->label("Attend At"); ?>
                            </div>

                            <div class="col-md-12">
                                <em><span style="font-size: 14px;" align="justify">* The committe only provide accommodation on (attend -1 -- max 14okt)</em>
                                <p></p>
                            </div>
                            
                            <div class="col-md-6">

                                <?= $form->field($model, 'visit_subak_bali')->widget(SwitchInput::classname(), [
                                    'name'=>'visit_subak_bali',
                                    'disabled' => true,
                                    'options' => [
                                        'data-toggle' => 'tooltip',
                                        'data-placement' =>'right',
                                        'title' => 'Participant Status'
                                    ],
                                    'pluginOptions'=>[
                                        'handleWidth'=>160,
                                        'onText'=>'Attending Subak Visit ',
                                        'offText'=>'Not Attending Subak Visit'
                                    ],
                                    'disabled' =>true,
                                ]); ?>
                                <em><span style="font-size: 14px;" align="justify">* Subak Visit is a site-based excursion which aims to introduce the culture landscape of bali embodied by the Subak system that creates a sustainable water management system of the island. This visit is <strong>limited to Symposium Speakers, Symposium Discussants and Core Participants only</strong>. The maximum quota is 50 participants.</span></em>
                            </div>

                            <div class="col-md-6">
                                   
                                <?= $form->field($model, 'cultural_visit')->widget(SwitchInput::classname(['id'    => 'cultural']), [
                                    'name'=>'cultural_visit',
                                    'options'   => ['id' => 'cultural_visit_id'],
                                    'pluginOptions'=>[
                                        'handleWidth'=>160,
                                        'onText'=>'Attending Cultural Visit',
                                        'offText'=>'Not Attending Cultural Visit'
                                    ],
                                    'disabled' =>true,
                                ]); ?>
                                   
                                <em><span style="font-size: 14px;">* Cultural Visit welcomes the participants of the forum with a series of cultural dance and musical performances, arts installation, and an Indonesian traditional culinary festival.<strong>This visit is available for the participant which arrives before 11.30 AM, October 10th, 2016. The quota is limited to 600 participants only.</strong> </span></em>
                            </div>



                        </div><!-- close row -->
                </div><!-- close jumbotron-->
                    <?php if ($model->room_type_id == 5) { echo ""; }else{;?>
                        <?php
                        if ($model->room_type_id == 1 || $model->room_type_id == 2) {
                            $type_bad = 'Single';
                        }else{
                            $type_bad = 'Twin Sharing';
                        }?>
                        <div class="jumbotron">
                            <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Accommodation</h4>
                            <hr class="style-one">
                            <div class="pull-left"><em><span style="font-size: 18px;">* Your accommodation type is <strong><?= $type_bad;?>.</strong></span></em></div>
                            </br>
                            <strong>Would you like to accept the accommodation ?</strong>

                            <?= $form->field($model,'room_type_approve')->radioList([0 => 'No, I will fund my own accommodation.', 1 => 'Yes'], ['disabledItems'=>[0,1]])->label(''); ?>
                        </div>
                    <?php };?>

                    <div class="jumbotron">
                        <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Dietary Preference</h4>
                        <hr class="style-one">
                        
                        <?= $form->field($model, 'dietary_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(Dietarypreferences::find()->all(), 'id', 'special_preference'),
                            'disabled'  => true,
                            'options' => [
                                'placeholder' => 'Please specify if you have any dietary preferences.',
                                'data-toggle' => 'tooltip',
                                'data-placement' =>'top',
                                'title' => 'Please specify if you have any dietary preferences.'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label("Dietary Preference"); ?>

                        <?= $form->field($model,'dietary_specify')->textArea(['rows' => '6','disabled' => true])->label('Please Specify'); ?>
                    </div>

        </div><!-- close col-md-12 -->

    </div><!-- CLOSE ROW -->

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">

var pilihan = document.getElementById('participantregistration-nationality').value;

if(pilihan == 101){
    document.getElementById('pasport_ktp_number').innerHTML     = "National ID";
    document.getElementById('start_date').style.display         = "none";
    document.getElementById('end_date').style.display           = "none";
    document.getElementById('ktp_pasport').innerHTML            = "Uploads National ID (KTP)";
}else{
    document.getElementById('pasport_ktp_number').innerHTML     = "Pasport Number";
    document.getElementById('ktp_pasport').innerHTML            = "Uploads Pasport";
}

var transportation = document.getElementById('participantregistration-transportation').value;

if(transportation == 2){
    document.getElementById("flight_number_arrival").disabled   = true;
    document.getElementById("flight_number_departure").disabled = true;        
}else{
    document.getElementById("flight_number_arrival").disabled   = false;
    document.getElementById("flight_number_departure").disabled = false;
}

function GetDataNasionality()
{
    var data_pilihan = document.getElementById('participantregistration-nationality').value;

    if(data_pilihan == 101){
        document.getElementById('pasport_ktp_number').innerHTML = "National ID";
        document.getElementById('ktp_pasport').innerHTML        = "Uploads National ID (KTP)";
        document.getElementById('start_date').style.display     = "none";
        document.getElementById('end_date').style.display       = "none";
    }else{
        document.getElementById('pasport_ktp_number').innerHTML = "Pasport Number";
        document.getElementById('ktp_pasport').innerHTML        = "Uploads Pasport";
    }
}

function ConditionalForCulturalVisit()
{
    var quota_now   = Number(<?= $quota_culturalvisit;?>);
    var dateArrival = document.getElementById('participantregistration-date_arrival').value;
    var TimeArrival = document.getElementById('participantregistration-time_arrival').value;
    var TimeArrival = TimeArrival.split(':');
    var TimeNumber  = Number(TimeArrival[0]+TimeArrival[1]);
    
    if(dateArrival == '10-Oct-2016' && TimeNumber < 1130 && quota_now < 600){
        $("[id='cultural_visit_id']").bootstrapSwitch('disabled',false);
    }else{
        $("[id='cultural_visit_id']").bootstrapSwitch('disabled',true);
    }
}

function GetTransportation()
{
    var transportation = document.getElementById('participantregistration-transportation').value;

    if(transportation == 2){
        document.getElementById("flight_number_arrival").disabled   = true;
        document.getElementById("flight_number_departure").disabled = true;        
    }else{
        document.getElementById("flight_number_arrival").disabled   = false;
        document.getElementById("flight_number_departure").disabled = false;
    }
}

</script>