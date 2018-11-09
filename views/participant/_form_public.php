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
<script type="text/javascript">
$(function() {
  var chk = $('#check');
  var btn = $('#btncheck');

  chk.on('change', function() {
    btn.prop("disabled", !this.checked);//true: disabled, false: enabled
  }).trigger('change'); //page load trigger event
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
                              ]); ?>
                          </div>
                          <div class="col-sm-4">
                              <?= $form->field($model, 'full_name')->textInput(['placeholder' => 'Your Name','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Name should be exactly the same with your Passport or ID card. Please double check before submitting']) ?>
                          </div>
                          <div class="col-sm-4">
                              <?= $form->field($model, 'name_on_badge')->textInput(['placeholder' => 'Ex : John Doe, Ph.D.','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'This name will appear in ID card and name tag']) ?>
                          </div>
                    </div>

                    <div class="row">
                
                          <div class="col-sm-4">
                                  <?= $form->field($model, 'email')->textInput(['placeholder' => '','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Your email.','readOnly' =>true,'value' => $user['email']]) ?>
                          </div>

                          <div class="col-sm-4">
                                  <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Ex: +421 099 9999','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please input your home number.']) ?>
                          </div>

                          <div class="col-sm-4">
                                  <?= $form->field($model, 'handphone')->textInput(['placeholder' => 'Ex: +62 813 09090909','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please input your handphone number.']) ?>
                          </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                                <?= $form->field($model, 'fax')->textInput(['placeholder' => 'Ex: +621 099 9999','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please input your Fax number.']) ?>
                        </div>

                        
                        <div class="col-sm-6">
                                  <?= $form->field($model, 'organization')->textInput(['placeholder' => 'Please input your Organization.','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please input your Organization.']) ?>

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
                                      'title' => 'Please select gender'
                                  ],
                                  'pluginOptions' => [
                                      'allowClear' => true
                                  ],
                              ]); ?>
                        </div>
                        <div class="col-sm-6">
                              <?= $form->field($model, 'date_of_birth')->widget(DatePicker::classname(), [
                                      'name' => 'date_of_birth',
                                      'type' => DatePicker::TYPE_INPUT,
                                      'pluginOptions' => [
                                          'autoclose'=>true,
                                          'format' => 'yyyy-mm-dd'
                                      ],
                                      'options' => [
                                          'placeholder' => 'Your date of birth',
                                          'data-toggle' => 'tooltip',
                                          'data-placement' =>'right',
                                          'title' => 'Please input your date of birth'
                                      ],
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
                                        ]
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
                            ])->label("Nationality"); ?>

                        </div>
                        
                        
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                               <?= $form->field($model, 'pasport_ktp_number')->textInput()->label('Pasport Number', ['id' => 'pasport_ktp_number']) ?>
                        </div>
                        <div class="col-sm-6">
                                <?= $form->field($model, 'place_of_issue')->textInput() ?>
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
                                            'format' => 'yyyy-mm-dd',
                                            'todayHighlight' => true,
                                        ]

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
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                    ]

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
                                'title' => 'Please fill the address completely.'
                            ]) ?>
                            
                        </div>
                    </div>

                    
              </div><!-- jumbotron ADDRESS-->



              <div class="jumbotron">
                <h4 class="pull-left" style="font-weight:500px; font-size:24px; margin:0">Motivation and Expectation</h4>
                <hr class="style-one">
                     <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'tell_us')->textarea(['rows' => 6,'placeholder' => 'Please describe your motivation to join WCF 2016. Maximum character 250 words.','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Please describe your motivation to join WCF 2016. Maximum character 250 words.'])->label('Motivation') ?>
                        </div>

                        <div class="col-sm-6">
                              <?= $form->field($model, 'candidate_chosen')->textArea(['rows' => 6,'placeholder' => 'Why should you be considered as the best candidate to be chosen ? Maximum character 250 words.','data-toggle' => 'tooltip', 'data-placement' =>'right', 'title' => 'Why should you be considered as the best candidate to be chosen ?'])->label('Personal Statement') ?>          
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
                                        ]
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
                            <em><span style="font-size: 14px;" align="justify">* Accepted format : .pdf, .docx, .doc.</span></em>
                        </div>
                     </div>
                        
              </div><!-- jumbotron MOTIVATION-->

              <!-- SUBMIT AREA -->
              <div class="col-sm-12d">
                <div class=" thumbnail">
                    <div class="checkbox" style="margin-bottom:10px;">
                        <div class="col-xs-12" style="font-size: 14px; padding-left:35px; font-style: italic;">
                            <input id="check" name="checkbox" type="checkbox">
                            I hereby certify that all of the information is true and valid. <br>
                            Submission deadline is september 10th, 2016. Once submitted, you can not modify the data.
                            <br></br>
                        </div>
                    </div>
                    <div style="margin-top:20px;">
                        <div class="col-xs-4">
                            <?= Html::submitButton($model->isNewRecord ? 'Save Data' : 'Save Data', ['name' => 'savedata','class' => $model->isNewRecord ? 'btn btn-default btn-block' : 'btn btn-default btn-block', 'style' => 'color:black !important;']) ?>
                        </div>
                        <div class="col-xs-8">
                            <?= Html::submitButton($model->isNewRecord ? 'Submit Data' : 'Submit Your Data', ['name' => 'submitdata','class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-success btn-block', 'style' => 'color:white !important;', 'id' => 'btncheck']) ?>
                        </div>
                    </div>
                    
                    <br> &nbsp
                    
                </div><br>
            </div>
    </div>


        <!-- <div class="checkbox">
          <input id="check" name="checkbox" type="checkbox">
          <label for="check">Some Text Here</label>
        </div>
        <input type="submit" name="anmelden" class="button" id="btncheck" value="Send" /> -->

    </div>

    <?php ActiveForm::end(); ?>

<script type="text/javascript">

var pilihan = document.getElementById('participantpublic-nationality').value;

if(pilihan == 101){
    document.getElementById('pasport_ktp_number').innerHTML = "National ID";
    document.getElementById('start_date').style.display     = "none";
    document.getElementById('end_date').style.display       = "none";
}else{
    document.getElementById('pasport_ktp_number').innerHTML = "Pasport Number";
    document.getElementById('start_date').style.display     = "block";
    document.getElementById('end_date').style.display       = "block";
}


function GetDataNasionality(){
    var pilihan = document.getElementById('participantpublic-nationality').value;

    if(pilihan == 101){
        document.getElementById('pasport_ktp_number').innerHTML = "National ID";
        document.getElementById('start_date').style.display     = "none";
        document.getElementById('end_date').style.display       = "none";
    }else{
        document.getElementById('pasport_ktp_number').innerHTML = "Pasport Number";
        document.getElementById('start_date').style.display     = "block";
        document.getElementById('end_date').style.display       = "block";
    }
}

</script>