<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use barcode\barcode\BarcodeGenerator;

/* @var $this yii\web\View */
/* @var $model app\models\Participant */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Participant', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

/*supported types  ean8, ean13, upc, std25, int25, code11, code39, code93, code128, codabar, msi, datamatrix*/

$optionsArray = array(
    'elementId'=> 'showBarcode', /* div or canvas id*/
    'value'=> '"'.$model->invitation_code.'"', /* value for EAN 13 be careful to set right values for each barcode type */
    'type'=>'code128',/*supported types  ean8, ean13, upc, std25, int25, code11, code39, code93, code128, codabar, msi, datamatrix*/
);

echo BarcodeGenerator::widget($optionsArray);

if($model->title == 1){
    $title = "Mr";
}elseif($model->title == 2){
    $title = "Mrs";
}elseif($model->title == 3){
    $title = "Ms";
}elseif($model->title == 4){
    $title = "Mdm";
}else{
    $title = '-';
}

if($model->room_type_approve == FALSE){
    $room_type_approve = 'No';
}elseif($model->room_type_approve == TRUE){
    $room_type_approve = 'Yes';
}

if($model->gender == 0){
    $gender = 'Male';
}elseif($model->gender == 1){
    $gender = 'Female';
}

if($model->country_id == 101){
    $identity_name = 'National ID';
}else{
    $identity_name = 'Pasport Number';
}


if ($model->transportation == 1) {
    $transportation_value = "Air";
}elseif ($model->transportation == 2) {
    $transportation_value = "Non Air";
}else{
    $transportation_value = "-";
}

?>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<div class="participant-view">

    <div class="col-md-12">
        <div class="col-md-3">
            <div id="showBarcode" style="margin-top:10px;"></div>
            <!-- <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?> -->
        </div>
        <div class="col-md-9 nopadding">
            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'invitation_code',
                'token',
             ],
        ]) ?>
        </div>
    </div>

    <div class="col-md-12 jumbotron">
        <h4>Personal Details</h4>
        <hr class="style-one"></hr>
        <div class="col-md-6">
            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                [
                    'attribute' => 'title',
                    'value'     => $title,
                ],
                'full_name',
                
                'name_on_badge',
                'address',
                [
                    'attribute' => 'gender',
                    'value'     => $gender
                ],
                'date_of_birth',
                [
                    'label'     => 'Location',
                    'attribute' => 'country_id',
                    'value'     => $model->country['country_name']
                ],

                [
                    'label'     => 'Nationality',
                    'attribute' => 'nationality',
                    'value'     => $model->nation['country_name']
                ],
                [
                    'label'     => $identity_name,
                    'attribute' => 'pasport_ktp_number',
                ],
                // 'location',
             ],
        ]) ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                
                'place_of_issue',
                [
                    'label'     => 'Date Of Issue',
                    'attribute' => 'start_date',
                ],

                [
                    'label'     => 'Expired Date',
                    'attribute' => 'end_date',
                ],
                'organization',
                'phone',
                'handphone',
                'fax',
                'email:email',
             ],
        ]) ?>
        </div>
    </div>

    <div class="col-md-12 jumbotron">
        <h4>Arrival & Departure</h4>
        <hr class="style-one"></hr>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                        [
                            'label'     => 'Transportation',
                            'attribute' => 'transportation',
                            'value'      => $transportation_value,
                        ],
                        'date_arrival',
                        'date_departure',
                        'time_arrival',

                        // 'etd',
                        // 'end_date_attend',
                ]
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                        'time_departure',
                        'flight_number_arrival',
                        'flight_number_departure',
                        // 'visit_subak_bali:boolean',
                        // 'cultural_visit:boolean',
                        // 'eta',
                ]
            ]) ?>
        </div>
    </div>

    <div class="col-md-12 jumbotron">
        <h4>Symposium</h4>
        <hr class="style-one"></hr>
        <div class="col-md-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label'     => 'Symposium day one',
                        'attribute' => 'symposium_day_one_id',
                        'value'     => $model->symposiumdayone['symposium_name'],
                    ],

                    [
                        'label'     => 'Symposium day two',
                        'attribute' => 'symposium_day_two_id',
                        'value'     => $model->symposiumdaytwo['symposium_name'],
                    ], 

                ],
            ]) ?>
        </div>
    </div>


    <div class="col-md-12 jumbotron">
        <h4>Attend</h4>
        <hr class="style-one"></hr>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

                    [
                        'attribute' => 'attend_id',
                        'value'     => $model->attends['information'],
                    ],
                    'visit_subak_bali:boolean',
                    
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'cultural_visit:boolean',
                ],
            ]) ?>
        </div>
    </div>

    <div class="col-md-12 jumbotron">
        <h4>Accommodation</h4>
        <div class="col-md-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

                    [
                        'attribute' => 'room_type_approve',
                        'value'     => $room_type_approve,
                    ],                    
                ],
            ]) ?>
        </div>
    </div>

    <div class="col-md-12 jumbotron">
        <h4>Motivation and Expectation</h4>
        <div class="col-md-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'tell_us',
                    'candidate_chosen',
                    [
                        'attribute' => 'essay',
                        'format' => 'url',
                        'value'     => Url::home(true).'uploads/essay/'.$model->essay,
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>
