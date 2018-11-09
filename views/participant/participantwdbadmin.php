<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use kartik\widgets\DatePicker;
use app\models\Varietypartisipant;
use app\models\Attend;
use app\models\Symposium;
use app\models\Dietarypreferences;
use app\models\Country;
use kartik\widgets\FileInput;
use kartik\widgets\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Participant */
/* @var $form yii\widgets\ActiveForm */

$title                  = [1 => 'Mr', 2 => 'Mrs', 3 => 'Ms', 4 => 'Mdm'];

?>

<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
<script>
   $(function() {
       $( "[title]" ).tooltip();
   });
</script>

<div class="participant-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    
    <div class="row">
        <div class=col-md-12>
             <div align="center"><h4 style="font-weight:bold; text-decoration:underline; margin: 25px 0">Information</h4></div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'title')->widget(Select2::classname(), [
                'data' => $title,
                'options' => [
                    'placeholder' => 'Your title',
                    'data-toggle' => 'tooltip',
                    'data-placement' =>'top',
                    'title' => 'Please select from the dropdown menu'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-md-7">
            <?= $form->field($model, 'full_name')->textInput(['placeholder' => 'Your Name','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Name should be exactly the same with your Passport or ID card. Please double check before submitting']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'name_on_badge')->textInput(['placeholder' => 'Ex : John Doe, Ph.D.','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'This name will appear in ID card and name tag']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'address')->textArea([
                'rows' => '4',
                'placeholder' => 'Your Address',
                'data-toggle' => 'tooltip',
                'data-placement' =>'top',
                'title' => 'Please fill the address completely.'
            ]) ?>
            
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
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
                                'data-placement' =>'top',
                                'title' => 'Please input your date of birth'
                            ],
                    ]); ?>

                    <?= $form->field($model, 'nationality')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Country::find()->all(), 'id', 'country_name'),
                        'options' => [
                            'placeholder' => 'Your nationality',
                            'data-toggle' => 'tooltip',
                            'data-placement' =>'top',
                            'title' => 'Please select your nationality'
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label("Nationality"); ?>
                   
                </div>
                <div class="col-md-6">
                     <?= $form->field($model, 'gender')->widget(Select2::classname(), [
                        'data' => [0 => 'Male', 1 => 'Female'],
                        'options' => [
                            'placeholder' => 'Your gender',
                            'data-toggle' => 'tooltip',
                            'data-placement' =>'top',
                            'title' => 'Please select gender'
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                    <?= $form->field($model, 'country_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Country::find()->all(), 'id', 'country_name'),
                        'options' => [
                            'placeholder' => 'Your location',
                            'data-toggle' => 'tooltip',
                            'data-placement' =>'top',
                            'title' => 'Please select your location'
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label("Location"); ?>
                </div>
            </div>
        </div>
        <div class=col-md-12>
             <div align="center"><h4 style="font-weight:bold; text-decoration:underline; margin: 25px 0">Information Of Identity</h4></div>
        </div>
        <div class="col-md-12">
                <?= $form->field($model, 'pasport_ktp_number')->textInput() ?>
        </div>
        <div class="col-md-12">
                <?= $form->field($model, 'place_of_issue')->textInput() ?>
            
        </div>

                
         
        <div class="col-md-6">
                <?= $form->field($model, 'start_date')->widget(DatePicker::classname(),[
                    'name' => 'start_date',
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'options' => [
                        'placeholder' => 'Expired Date',
                        'data-toggle' => 'tooltip',
                        'data-placement' =>'top',
                        'title' => 'Expired Date'

                    ],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd-M-yyyy',
                        'todayHighlight' => true,
                    ]

                ])->label('Date Of Issue') ?>

            

        </div>
        <div class="col-md-6">
            
                <?= $form->field($model, 'end_date')->widget(DatePicker::classname(),[
                    'name' => 'end_date',
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'options' => [
                        'placeholder' => 'Expired Date',
                        'data-toggle' => 'tooltip',
                        'data-placement' =>'top',
                        'title' => 'Expired Date'

                    ],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd-M-yyyy',
                        'todayHighlight' => true,
                    ]

                ])->label('Expired Date') ?>
        </div>
 

        <div class="col-md-6">
                <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Ex: +621 099 9999','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Please input your home number.']) ?>
        </div>

        <div class="col-md-6">
                <?= $form->field($model, 'handphone')->textInput(['placeholder' => 'Ex: +62 813 09090909','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Please input your handphone number.']) ?>
        </div>

        <div class="col-md-6">
                <?= $form->field($model, 'fax')->textInput(['placeholder' => 'Ex: +621 099 9999','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Please input your Fax number.']) ?>
        </div>

        <div class="col-md-6">
                <?= $form->field($model, 'email')->textInput(['placeholder' => '','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Please input your email.']) ?>
        </div>


        <div class="col-md-12">
                <?= $form->field($model, 'organization')->textInput(['placeholder' => 'Please input your Organization.','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Please input your Organization.']) ?>
        </div>

        <?php if($model->speaker === TRUE){ ?>

                <div class=col-md-12>
                     <div align="center"><h4 style="font-weight:bold; text-decoration:underline; margin: 25px 0">Speaker</h4></div>
                </div>

                <div class="col-md-6">
                        <?= $form->field($model, 'tittle')->textInput(['placeholder' => 'Tittle Of Abstract','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Tittle Of Abstract.']) ?>
                </div>

                <div class="col-md-6">
                        <?= $form->field($model, 'author')->textInput(['placeholder' => 'Author Of Abstract','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Author Of Abstract.']) ?>
                </div>

                <div class="col-md-12">
                        <?= $form->field($model, 'content')->textArea(['rows' => '6','placeholder' => 'Content Of Abstract','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Content Of Abstract.']) ?>
                </div>
        <?php }else{ ?>
                <?php echo '' ;?>
        <?php } ?>

        <div class=col-md-12>
             <div align="center"><h4 style="font-weight:bold; text-decoration:underline; margin: 25px 0">Attend As</h4></div>
        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'attend_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Attend::find()->all(), 'id', 'information'),
                'disabled' => true,
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label("Attend As"); ?>
        </div>

        <div class="col-md-4">

                <?= $form->field($model, 'visit_subak_bali')->widget(SwitchInput::classname(), [
                    'name'=>'visit_subak_bali',
                    'options' => [
                        'data-toggle' => 'tooltip',
                        'data-placement' =>'top',
                        'title' => 'Participant Status'

                    ],
                    'pluginOptions'=>[
                        'handleWidth'=>108,
                        'onText'=>'Visit ',
                        'offText'=>'Not Subak Bali'
                        ]
                ]); ?>

        </div>

        <div class="col-md-4">
            
                <?= $form->field($model, 'cultural_visit')->widget(SwitchInput::classname(), [
                    'name'=>'cultural_visit',
                    'options' => [
                        'data-toggle' => 'tooltip',
                        'data-placement' =>'top',
                        'title' => 'Participant Status'

                    ],
                    'pluginOptions'=>[
                        'handleWidth'=>108,
                        'onText'=>'Cultural Visit',
                        'offText'=>'No Cultural Visit'
                        ]
                ]); ?>
        </div>

        <div class=col-md-12>
             <div align="center"><h4 style="font-weight:bold; text-decoration:underline; margin: 25px 0">Symposium</h4></div>
        </div>
        <div class="col-md-6">
                <?= $form->field($model, 'symposium_day_one_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Symposium::find()->where(['what_day' => 1])->all(), 'id', 'symposium_name'),
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label("Symposium Day One"); ?>

        </div>
        <div class="col-md-6">
                <?= $form->field($model, 'symposium_day_two_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Symposium::find()->where(['what_day' => 2])->all(), 'id', 'symposium_name'),
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label("Symposium Day Two"); ?>

        </div>
    
        <div class=col-md-12>
             <div align="center"><h4 style="font-weight:bold; text-decoration:underline; margin: 25px 0">Arrival & Departure</h4></div>
        </div>

        <div class="col-md-6">
                  <?= $form->field($model, 'date_arrival')->widget(DatePicker::classname(),[
                       'name' => 'date_arrival',
                       'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                       'options' => [
                           'placeholder' => 'Date Arrival',
                           'data-toggle' => 'tooltip',
                           'data-placement' =>'top',
                           'title' => 'Date Arrival'
                   
                       ],
                       'pluginOptions' => [
                           'autoclose'=>true,
                           'format' => 'dd-M-yyyy',
                           'todayHighlight' => true,
                       ]
                   
                   ])->label('Date Arrival') ?>
        </div>
        <div class="col-md-6">
            
                    <?= $form->field($model, 'date_departure')->widget(DatePicker::classname(),[
                       'name' => 'date_departure',
                       'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                       'options' => [
                           'placeholder' => 'Date Departure',
                           'data-toggle' => 'tooltip',
                           'data-placement' =>'top',
                           'title' => 'Date Departure'
                   
                       ],
                       'pluginOptions' => [
                           'autoclose'=>true,
                           'format' => 'dd-M-yyyy',
                           'todayHighlight' => true,
                       ]
                   
                   ])->label('Date Departure') ?>
        </div>
        <div class="col-md-6">
                                    
                   <?= $form->field($model, 'time_arrival')->widget(TimePicker::classname(),[ 
                       'name' => 'time_arrival',
                           'options' => [
                               'placeholder' => 'Time Arrival',
                               'data-toggle' => 'tooltip',
                               'data-placement' =>'top',
                               'title' => 'Time Arrival'
                   
                           ],
                           'pluginOptions' => [
                               'showSeconds' => true,
                               'showMeridian' => false,
                               'minuteStep' => 1,
                               'secondStep' => 5,
                           ]
                   
                   ]); ?>
   

        </div>
        <div class="col-md-6">
            

                    <?= $form->field($model, 'time_departure')->widget(TimePicker::classname(),[ 
                       'name' => 'time_arrival',
                           'options' => [
                               'placeholder' => 'Time Departure',
                               'data-toggle' => 'tooltip',
                               'data-placement' =>'top',
                               'title' => 'Time Departure'
                   
                           ],
                           'pluginOptions' => [
                               'showSeconds' => true,
                               'showMeridian' => false,
                               'minuteStep' => 1,
                               'secondStep' => 5,
                           ]
                   
                   ]); ?>
        </div>
        <div class="col-md-6">
                    <?= $form->field($model, 'flight_number_arrival')->textInput(['placeholder' => 'Flight Number Arrival','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Flight Number Arrival.']) ?>
        </div>
        <div class="col-md-6">
                    <?= $form->field($model, 'flight_number_departure')->textInput(['placeholder' => 'Flight Number Departure','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Flight Number Departure.']) ?>
        </div>
    </div>



    <div class=col-md-12>
            <div align="center"><h4 style="font-weight:bold; text-decoration:underline; margin: 25px 0">Dietary Preference</h4></div>
    </div>
    <?= $form->field($model, 'dietary_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Dietarypreferences::find()->all(), 'id', 'special_preference'),
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
       

      <!-- <?= $form->field($model, 'partisipant')->widget(SwitchInput::classname(), [
        'name'=>'status_41',
        'options' => [
            'data-toggle' => 'tooltip',
            'data-placement' =>'top',
            'title' => 'Participant Status'

        ],
        'pluginOptions'=>[
            'handleWidth'=>150,
            'onText'=>'Particippant',
            'offText'=>'Non Participant'
        ]
    ]); ?> -->


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Submit Data', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>