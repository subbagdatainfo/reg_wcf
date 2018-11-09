<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use kartik\widgets\DatePicker;
use app\models\Varietypartisipant;
use app\models\Attend;
use app\models\Dietarypreferences;
use app\models\Country;
use kartik\widgets\FileInput;
use kartik\widgets\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Participant */
/* @var $form yii\widgets\ActiveForm */

$title                  = [1 => 'Mr', 2 => 'Ms'];
?>

<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
<script>
   $(function() {
       $( "[title]" ).tooltip();
   });
</script>

<?php if(Yii::$app->session->getFlash('success')){?>
        <div class="alert alert-success alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin:-15px 10px 0 0"><span aria-hidden="true">&times;</span></button>
          <strong><?php echo Yii::$app->session->getFlash('success'); ?></strong> 
        </div>
<?php }else{ ?>
    <?php echo ''; ?>
<?php } ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
     <div class="row">
        
        <div class="col-sm-12">

              <div class="jumbotron">
                <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Personal Details</h4>
                <hr class="style-one">
                    <div class="row">
                          <div class="col-sm-4">
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
                          <div class="col-sm-4">
                              <?= $form->field($model, 'full_name')->textInput(['readOnly' =>true,'placeholder' => 'Your Name','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Name should be exactly the same with your Passport or ID card. Please double check before submitting']) ?>
                          </div>
                          <div class="col-sm-4">
                              <?= $form->field($model, 'name_on_badge')->textInput(['readOnly' =>true,'placeholder' => 'Ex : John Doe, Ph.D.','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'This name will appear in ID card and name tag']) ?>
                          </div>
                    </div>

                    <div class="row">
                
                          <div class="col-sm-4">
                                  <?= $form->field($model, 'email')->textInput(['placeholder' => '','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Your email.','readOnly' =>true,'value' => $user['email']]) ?>
                          </div>

                          <div class="col-sm-4">
                                  <?= $form->field($model, 'phone')->textInput(['readOnly' =>true,'placeholder' => 'Ex: +421 099 9999','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please input your home number.']) ?>
                          </div>

                          <div class="col-sm-4">
                                  <?= $form->field($model, 'handphone')->textInput(['readOnly' =>true,'placeholder' => 'Ex: +62 813 09090909','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please input your handphone number.']) ?>
                          </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                                <?= $form->field($model, 'fax')->textInput(['readOnly' =>true,'placeholder' => 'Ex: +621 099 9999','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please input your Fax number.']) ?>
                        </div>

                        
                        <div class="col-sm-6">
                                  <?= $form->field($model, 'organization')->textInput(['readOnly' =>true,'placeholder' => 'Please input your Organization.','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please input your Organization.']) ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                          
                              <?= $form->field($model, 'gender')->widget(Select2::classname(), [
                                  'data' => [0 => 'Male', 1 => 'Female'],
                                  'options' => [
                                      'placeholder' => 'Your gender',
                                      'data-toggle' => 'tooltip',
                                      'data-placement' =>'right',
                                      'title' => 'Please select gender',
                                  ],
                                  'pluginOptions' => [
                                      'allowClear' => true,
                                  ],
                                  'disabled' =>true,
                              ]); ?>
                        </div>
                        <div class="col-sm-6">
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

                          <div class="col-sm-12">
            
                              <?php if(!$model->isNewRecord){ ?>

                                    <?= $form->field($model, 'user_photo')->widget(FileInput::classname(), [
                                        'options' => [
                                            'accept' =>'image/*'
                                        ],
                                        'pluginOptions' => [
                                            'initialPreview'=>[
                                            Html::img('@web/uploads/user_photo/'.$model['user_photo'],['target'=>'_blank','style' => 'text-decoration:none; font-weight:bold; height:180px; width:250px;'])
                                            ],
                                            'overwriteInitial'=>true
                                        ],
                                        'disabled' =>true,
                                    ]);?>

                              <?php }else{ ?>

                                    <?= $form->field($model, 'user_photo')->widget(FileInput::classname(), [
                                        'options' => [
                                            'accept' => 'image/*'
                                        ],
                                        // 'pluginOptions' => [
                                        //     'initialPreview'=>[
                                        //         Html::img('@web/uploads/user_photo/'.$model['user_photo'],['target'=>'_blank','style' => 'text-decoration:none; font-weight:bold; height:180px; width:250px;'])
                                        //     ],
                                        // ]
                                    ])->label('Upload Photo'); ?>

                              <?php } ?>
                          </div>
                    </div>
              </div><!-- jumbotron PERSONAL DETAILS-->

              <div class="jumbotron">
                <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Current Address</h4>
                <hr class="style-one">
                     <div class="row">
                        <div class="col-sm-6">
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

                        <div class="col-sm-6">
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
                                    "change" => "function(){
                                                    GetDataNasionality() 
                                                 }",
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
                                        'format' => 'dd-M-yyyy',
                                        'todayHighlight' => true,
                                    ],
                                    'disabled' =>true,
                                ])->label('Expired Date') ?>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <?= $form->field($model, 'address')->textArea([
                                'rows' => '4',
                                'placeholder' => 'Your Address',
                                'data-toggle' => 'tooltip',
                                'data-placement' =>'right',
                                'title' => 'Please fill the address completely.',
                                'readOnly' =>true,
                            ]) ?>
                            
                        </div>
                    </div>

                    
              </div><!-- jumbotron ADDRESS-->



              <div class="jumbotron">
                <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Motivation and Expectation</h4>
                <hr class="style-one">
                     <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'tell_us')->textarea(['readOnly' =>true,'rows' => 6,'placeholder' => 'Please describe your motivation to join WCF 2016. Maximum character 250 words.','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please describe your motivation to join WCF 2016. Maximum character 250 words.'])->label('Motivation') ?>
                        </div>

                        <div class="col-sm-6">
                              <?= $form->field($model, 'candidate_chosen')->textArea(['readOnly' =>true,'rows' => 6,'placeholder' => 'Why you should be considered as the best candidate to be chosen ? Maximum character 250 words.','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Why you should be considered as the best candidate to be chosen ?'])->label('Personal Statement') ?>          
                        </div>
                     </div>

                     <div class="row">
                           
                        <div class="col-sm-12">
                             <?php if(!$model->isNewRecord){ ?>

                                    <?= $form->field($model, 'essay')->widget(FileInput::classname(), ['options' => ['accept' =>'pdf'],
                                        'pluginOptions' => [
                                            'initialPreview'=>[

                                                 '<embed class="kv-preview-data" src="../../uploads/essay/'.$model["essay"].'" width="160px" height="160px" type="application/pdf" internalinstanceid="106">'
                                            ],
                                            'showRemove' => false,
                                            'showUpload' => false,
                                            'overwriteInitial'=>true
                                        ],
                                        'disabled' =>true,
                                    ]);?>

                            <?php }else{ ?>
                                   
                                         <?= $form->field($model, 'essay')->widget(FileInput::classname(), [
                                            'options' => [
                                                    'accept' => 'pdf',
                                                    'placeholder' => 'Please upload an essay which is related to one of 6 WCF sub-theme symposia.',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' =>'right',
                                                    'title' => 'Please upload an essay which is related to one of 6 WCF sub-theme symposia.'
                                            ],
                                        ])->label('Please upload an essay which is related to one of 6 WCF sub-theme symposia.'); ?>
                                    
                            
                            <?php } ?>

                        </div>
                     </div>
                        
              </div><!-- jumbotron MOTIVATION-->

        </div>
    </div>    
  </div>

    <?php ActiveForm::end(); ?>

<script type="text/javascript">

var pilihan = document.getElementById('participantpublic-nationality').value;

    if(pilihan == 101){
                document.getElementById('pasport_ktp_number').innerHTML = "National ID";
                document.getElementById('start_date').style.display="none";
                document.getElementById('end_date').style.display="none";


    }else{
                document.getElementById('pasport_ktp_number').innerHTML = "Pasport Number";
    }


function GetDataNasionality(){
    var pilihan = document.getElementById('participantpublic-nationality').value;

    if(pilihan == 101){
                document.getElementById('pasport_ktp_number').innerHTML = "National ID";
                document.getElementById('start_date').style.display="none";
                document.getElementById('end_date').style.display="none";


    }else{
                document.getElementById('pasport_ktp_number').innerHTML = "Pasport Number";
    }
}

</script>