<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use app\models\Varietypartisipant;
use app\models\Attend;
use app\models\RoomType;


/* @var $this yii\web\View */
/* @var $model app\models\Participant */
/* @var $form yii\widgets\ActiveForm */

$title                  = [1 => 'Mr', 3 => 'Ms'];

$role_user = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
foreach ($role_user as $key => $value) {
    $role_user = $key;
}

// TODO : Kondisi untuk tiap role user
if ($role_user == 'rolesuper') {
    $data_variety_participant = ArrayHelper::map(Varietypartisipant::find()->orderBy(['variety' => SORT_ASC])->all(), 'id', 'variety');
}elseif ($role_user == 'roleadmin') {
    $data_variety_participant = ArrayHelper::map(Varietypartisipant::find()->orderBy(['variety' => SORT_ASC])->all(), 'id', 'variety');
}elseif ($role_user == 'rolewdb') {
    $data_variety_participant = ArrayHelper::map(Varietypartisipant::find()->where(['group_participant_id' => 1])->orderBy(['variety' => SORT_ASC])->all(), 'id', 'variety');
}elseif ($role_user == 'rolelocal') {
    $data_variety_participant = ArrayHelper::map(Varietypartisipant::find()->where(['group_participant_id' => [2,4]])->orderBy(['variety' => SORT_ASC])->all(), 'id', 'variety');
}elseif ($role_user == 'roleinternational') {
    $data_variety_participant = ArrayHelper::map(Varietypartisipant::find()->where(['group_participant_id' => [3,4]])->orderBy(['variety' => SORT_ASC])->all(), 'id', 'variety');
}

?>
<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
<script>
   $(function() {
       $( "[title]" ).tooltip();
   });
</script>

<div class="col-xs-12">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-2 col-xs-12">
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
                ]
            ]); ?>
        </div>
        <div class="col-md-7 col-xs-12">
            <?= $form->field($model, 'full_name')->textInput(['placeholder' => 'Your Name','data-toggle' => 'tooltip', 'data-placement' =>'top', 'title' => 'Name should be exactly the same with your Passport or ID card. Please double check before submitting']) ?>
        </div>
        <div class="col-md-3 col-xs-12">
            <?= $form->field($model, 'room_type_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(RoomType::find()->all(), 'id', 'room_type'),
                'options' => [
                    'placeholder' => 'Room Type',
                    'data-toggle' => 'tooltip',
                    'data-placement' =>'top',
                    'title' => 'Please select from the dropdown menu'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label("Room of Type"); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <?= $form->field($model, 'variety_id')->widget(Select2::classname(), [
                'data' => $data_variety_participant,
                'options' => [
                    'placeholder' => 'Category',
                    'data-toggle' => 'tooltip',
                    'data-placement' =>'top',
                    'title' => 'Please select from the dropdown menu'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label("Category of Participant"); ?>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <?= $form->field($model, 'attend_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Attend::find()->all(), 'id', 'information'),
                        'options' => ['placeholder' => 'Attend'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label("Attend At"); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'speaker')->widget(SwitchInput::classname(),[
                            'name'=>'speaker',
                            'pluginOptions'=>[
                                // 'handleWidth'=>70,
                                'onText'=>'Speaker',
                                'offText'=>'Non Speaker'
                            ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

   
    <!--
    
    <?= $form->field($model, 'full_name')->textInput() ?>
    
    <?= $form->field($model, 'speaker')->checkbox() ?>

    <?= $form->field($model, 'visit_subak_bali')->checkbox() ?>

    <?= $form->field($model, 'invitation_code')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'full_name')->textInput() ?>
    
    <?= $form->field($model, 'user_photo')->textInput() ?>
    
    <?= $form->field($model, 'name_on_badge')->textInput() ?>
    
    <?= $form->field($model, 'address')->textInput() ?>
    
    <?= $form->field($model, 'gender')->textInput() ?>
    
    <?= $form->field($model, 'date_of_birth')->textInput() ?>
    
    <?= $form->field($model, 'country_id')->textInput() ?>
    
    <?= $form->field($model, 'nationality')->textInput() ?>
    
    <?= $form->field($model, 'pasport_ktp_number')->textInput() ?>
    
    <?= $form->field($model, 'place_of_issue')->textInput() ?>
    
    <?= $form->field($model, 'start_date')->textInput() ?>
    
    <?= $form->field($model, 'end_date')->textInput() ?>
    
    <?= $form->field($model, 'phone')->textInput() ?>
    
    <?= $form->field($model, 'fax')->textInput() ?>
    
    <?= $form->field($model, 'email')->textInput() ?>
    
    <?= $form->field($model, 'partisipant')->checkbox() ?>
    
    <?= $form->field($model, 'category')->textInput() ?>
    
    <?= $form->field($model, 'organization')->textInput() ?>
    
    <?= $form->field($model, 'speaker')->checkbox() ?>
    
    <?= $form->field($model, 'abstract')->textInput() ?>
    
    <?= $form->field($model, 'file_presentation')->textInput() ?>
    
    <?= $form->field($model, 'full_paper')->textInput() ?>
    
    <?= $form->field($model, 'participant_status')->textInput() ?>
    
    <?= $form->field($model, 'variety_id')->textInput() ?>
    
    <?= $form->field($model, 'dietary_id')->textInput() ?>
    
    <?= $form->field($model, 'symposium_day_one_id')->textInput() ?>
    
    <?= $form->field($model, 'symposium_day_two_id')->textInput() ?>
    
    <?= $form->field($model, 'date_arrival')->textInput() ?>
    
    <?= $form->field($model, 'time_arrival')->textInput() ?>
    
    <?= $form->field($model, 'date_departure')->textInput() ?>
    
    <?= $form->field($model, 'time_departure')->textInput() ?>
    
    <?= $form->field($model, 'start_date_attend')->textInput() ?>
    
    <?= $form->field($model, 'end_date_attend')->textInput() ?>
    
    <?= $form->field($model, 'visit_subak_bali')->checkbox() ?>
    
    <?= $form->field($model, 'cultural_visit')->checkbox() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
