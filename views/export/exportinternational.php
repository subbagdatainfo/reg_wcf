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
            'invitation_code',
            'token',
            'name_on_badge',
            'address',
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
            'phone',
            'fax',
            'email',
            'organization',
            'variety.variety',
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
            'date_arrival',
            'time_arrival',
            'flight_number_arrival',
            'eta',
            'date_departure',
            'time_departure',
            'flight_number_arrival',
            'etd',

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
                'label'     => 'Attending On',
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
