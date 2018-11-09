<?php

use yii\helpers\Url;
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
            [
                'attribute' => 'gender',
                'value'     => function($model){
                    if($model->gender == 0){
                        $gender = 'Male';
                    }elseif($model->gender == 1){
                        $gender = 'Female';
                    }else{
                        $gender = '-';
                    }
                    return $gender;
                }
            ],
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
            'tell_us',
            'candidate_chosen',
            [
                'label'     => 'Essay',
                'attribute' => 'essay',
                'value'     => function($model)
                {
                    if(!empty($model->essay)){
                        $essay =  'Sudah Unggah Essay';/*Url::home(true).'uploads/essay/'.$model->essay;*/
                    }else{
                        $essay =  'Belum unggah essay';
                    }
                    return $essay;
                }
            ],
            [
                    'attribute' => 'participant_status',
                    'format' => 'Html',
                    'value' => function($model){
                        if($model->participant_status == 2){
                            $participant_status = '<span class="label label-success">Success</span>';
                        }elseif($model->participant_status == 3){
                            $participant_status = '<span class="label label-info">Registered</span>';
                        }elseif($model->participant_status == 4){
                            $participant_status = '<span class="label label-warning">Waiting List</span>';
                        }elseif($model->participant_status == 5){
                            $participant_status = '<span class="label label-danger">Unsuccessful</span>';
                        }else{
                            $participant_status = '-';
                        }
                        return $participant_status;
                    },
                    'filter' => [2 => 'Success', 3 => 'Registered', 4 => 'Waiting List', 5 => 'Unsuccessful'],
                ],
                [
                    'attribute' => 'Total Nilai',
                    'format' => 'html',
                    'value'     =>  function($model){
                        return "<b style='margin-top:50px;'>".( $model->nilai_ps + $model->nilai_mo + $model->nilai_eo + $model->nilai_ek + $model->nilai_eb + $model->nilai_rl + $model->nilai_cv )."</b>";
                    },
                    'contentOptions'=>['style'=>'margin-top: 500px;']
                ],
                [
                    'attribute' => 'submit',
                    'label'     => 'Status Submit',
                    'format'    => 'html',
                    'value' => function($model){
                        if($model->submit == 1){
                            $submits = '<div class="btn btn-primary">TRUE</div>';
                        }elseif($model->submit == 0 ){
                            $submits = '<div class="btn btn-danger">FALSE</div>';
                        }

                        return $submits;
                    }
                ],
            /*[
                'attribute' => 'essay',
                'value'     => function($model){
                    if(empty($model->essay)){
                        $essay = 'Belum Upload';
                    }else{
                        $essay = 'Sudah Upload';
                    }
                    return $essay;
                }
            ]*/
            // [
            //     'label'     => 'Symposium Day One',
            //     'attribute' => 'symposium_day_one_id',
            //     'value'     => function($model)
            //     {
            //         if ($model->symposiumdayone) {
            //            return $model->symposiumdayone['symposium_name'];
            //         }
                        
            //     }
            // ],
            // [
            //     'label'     => 'Symposium Day Two',
            //     'attribute' => 'symposium_day_two_id',
            //     'value'     => function($model)
            //     {
            //         if($model->symposiumdaytwo){
            //             return $model->symposiumdaytwo['symposium_name'];
            //         }
            //     }
            // ],
            // 'date_arrival',
            // 'time_arrival',
            // 'flight_number_arrival',
            // 'eta',
            // 'date_departure',
            // 'time_departure',
            // 'flight_number_arrival',
            // 'etd',
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
                    }else{
                        $title = '-';
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
            /*'essay',*/
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
