<?php

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
}

?>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<div class="participant-view">

    <p>
        <div id="showBarcode"></div>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'invitation_code',
            'token',
            'title',
            'full_name',
            'user_photo',
            'name_on_badge',
            'address',
            [
                'attribute' => 'gender',
                'value'     => $title,
                       
            
            ],
            'date_of_birth',
            'country_id',
            'nationality',
            'pasport_ktp_number',
            'place_of_issue',
            'start_date',
            'end_date',
            'phone',
            'fax',
            'email:email',
            'partisipant:boolean',
            'category',
            'organization',
            'speaker:boolean',
            'abstract',
            'file_presentation',
            'full_paper',
            'photo',
            'participant_status',
            'variety_id',
            'dietary_id',
            'symposium_day_one_id',
            'symposium_day_two_id',
            'date_arrival',
            'time_arrival',
            'flight_number_arrival',
            'eta',
            'date_departure',
            'time_departure',
            'flight_number_departure',
            'etd',
            'start_date_attend',
            'end_date_attend',
            'visit_subak_bali:boolean',
            'cultural_visit:boolean',
        ],
    ]) ?>

</div>
