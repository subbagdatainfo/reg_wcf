<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Participant';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-index">
    <?php
        $gridColumns = [
            'variety.variety',
            'invitation_code',
            'token',
            [
                'label'     => 'Title',
                'attribute' => 'title',
                'value'     =>  function($model){
                    if($model->title == 1){
                        $title = "Mr";
                    }elseif($model->title == 2){
                        $title = "Mrs";
                    }elseif($model->title == 3){
                        $title = "Ms";
                    }elseif($model->title == 4){
                        $title = "Mdm";
                    }else{
                        $title = "Ms";
                    }
                    return $title;
                },
            ],
            'full_name',
            'name_on_badge',
            'email',
            'phone',
            'handphone',
            'fax',
            'organization',
            'gender',
            'date_of_birth',
            [
                'label'     => 'Country',
                'attribute' => 'country_id',
                'value'     => function($model){
                    return $model->country['country_name'];
                }
            ],
            [
                'label'     => 'Nationality',
                'attribute' => 'nationality',
                'value'     => function($model){
                    return $model->nation['country_name'];
                }
            ],
            'pasport_ktp_number',
            'place_of_issue',
            'start_date',
            'end_date',
            'address',
            [
                'label'     => 'Transportation',
                'attribute' => 'transportation',
                'value'     =>  function($model){
                    if($model->transportation == 1){
                        $transportation = "Air";
                    }else{
                        $transportation = "Non Air";
                    }
                    return $transportation;
                },
            ],
            'date_arrival',
            'time_arrival',
            'date_departure',
            'time_departure',
            'flight_number_arrival',
            'flight_number_departure',
            [
                'label'     => 'Symposium Day One',
                'attribute' => 'symposium_day_one_id',
                'value'     => function($model)
                {
                    if ($model->symposiumdayone) {
                       return $model->symposiumdayone['symposium_name'];
                    }
                        
                }
            ],
            [
                'label'     => 'Symposium Day Two',
                'attribute' => 'symposium_day_two_id',
                'value'     => function($model)
                {
                    if($model->symposiumdaytwo){
                        return $model->symposiumdaytwo['symposium_name'];
                    }
                }
            ],
            [
                'label'     => 'Attend',
                'attribute' => 'attend_id',
                'value'     =>  function($model){
                    if ($model->attend_id == 1) {
                        $attend_id      = '10 - 14 October 2016';
                    }elseif ($model->attend_id == 2) {
                        $attend_id      = '13 October 2016';
                    }elseif ($model->attend_id == 3) {
                        $attend_id      = '11 - 14 October 2016';
                    }elseif ($model->attend_id == 4) {
                        $attend_id      = '12 - 14 October 2016';
                    }elseif ($model->attend_id == 5) {
                        $attend_id      = '13 - 14 October 2016';
                    }else{
                        $attend_id      = '12 - 13 October 2016';
                    }
                    return $attend_id;
                },
            ],
            [
                'label'     => 'Visit Subak Bali',
                'attribute' => 'visit_subak_bali',
                'value'     =>  function($model){
                    if ($model->visit_subak_bali == TRUE) {
                        $visit_subak_bali      = 'Yes';
                    }else{
                        $visit_subak_bali      = 'No';
                    }
                    return $visit_subak_bali;
                },
            ],
            [
                'label'     => 'Cultural Visit',
                'attribute' => 'cultural_visit',
                'value'     =>  function($model){
                    if ($model->cultural_visit == TRUE) {
                        $cultural_visit      = 'Yes';
                    }else{
                        $cultural_visit      = 'No';
                    }
                    return $cultural_visit;
                },
            ],
            [
                'label'     => 'Room Type',
                'attribute' => 'room_type_id',
                'value'     =>  function($model){
                    if ($model->room_type_id == 1 || $model->room_type_id == 2) {
                        $room_type_id      = 'Single';
                    }else{
                        $room_type_id      = 'Twin Sharing';
                    }
                    return $room_type_id;
                },
            ],
            [
                'label'     => 'Dietary',
                'attribute' => 'dietary_id',
                'value'     => function($model)
                {
                    if($model->dietary_id){
                        return $model->dietary['special_preference'];
                    }
                }
            ],
            'dietary_specify'
        ];

        echo ExportMenu::widget([
            'dataProvider'  => $dataProvider,
            'columns'       => $gridColumns,
            'target'        => ExportMenu::TARGET_BLANK,
            'filename'      => 'Data Participant',
            'exportConfig'  => [
                    ExportMenu::FORMAT_TEXT     => false,
                    ExportMenu::FORMAT_PDF      => false,
                    ExportMenu::FORMAT_HTML     => false,
                    ExportMenu::FORMAT_EXCEL    => false,
            ]
        ]);

    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'title',
                'value'     =>  function($model){
                    if($model->title == 1){
                        $title = "Mr";
                    }elseif($model->title == 2){
                        $title = "Mrs";
                    }elseif($model->title == 3){
                        $title = "Ms";
                    }elseif($model->title == 4){
                        $title = "Mdm";
                    }
                    return $title;
                },
                'contentOptions'=>['style'=>'width: 50px;']
            ],
            'full_name',
            [
                'label'     => 'Attending As',
                'attribute' => 'variety_id',
                'value'     => 'variety.variety'
            ],
            [
                'label'     => 'Attend On',
                'attribute' => 'attend_id',
                'value'     => 'attend.information'
            ],
            'invitation_code',
            'token',
            // 'full_name',
            // 'user_photo',
            // 'name_on_badge',
            // 'address',
            // 'gender',
            // 'date_of_birth',
            // 'country_id',
            // 'nationality',
            // 'pasport_ktp_number',
            // 'place_of_issue',
            // 'start_date',
            // 'end_date',
            // 'phone',
            // 'fax',
            // 'email:email',
            // 'partisipant:boolean',
            // 'category',
            // 'organization',
            // 'speaker:boolean',
            // 'abstract',
            // 'file_prensentation',
            // 'full_paper',
            // 'photo',
            // 'participant_status',
            // 'variety_id',
            // 'dietary_id',
            // 'symposium_day_one_id',
            // 'symposium_day_two_id',
            // 'date_arrival',
            // 'time_arrival',
            // 'flight_number_arrival',
            // 'eta',
            // 'date_departure',
            // 'time_departure',
            // 'flight_number_departure',
            // 'etd',
            // 'start_date_attend',
            // 'end_date_attend',
            // 'visit_subak_bali:boolean',
            // 'cultural_visit:boolean',

        ],
    ]); ?>
</div>
