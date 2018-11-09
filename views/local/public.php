<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Public';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-index">
    <div class="container">
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
                            $title = "-";

                        }
                        return $title;
                    },
                    'contentOptions'=>['style'=>'width: 50px;']
                ],
                [
                    'attribute' => 'user_id',
                    'value'     => function($model){
                        if(!empty($model->user_id)){
                            $email = $model->users->email; 
                        }else{
                            $email = '-';
                        }
                        return $email;
                    }
                ],
                'full_name',
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
                [  
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => 'width:60px;'],
                    'header'=>'Actions',
                    'template' => '{view} {badge} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>', $url, [
                                'title' => Yii::t('app', 'View')                                 
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', $url, [
                                'title'     => Yii::t('app', 'Update'),
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', $url, [
                                'title' => Yii::t('app', 'Delete'),
                                'onclick'   => 'return confirm("Are you sure want to Delete this data ?")',
                                
                            ]);
                        },
                        'badge' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>', $url, [
                                'title' => Yii::t('app', 'Badge'), 'target' => '_blank'
                            ]);
                        },
                    ],

                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            $url ='publicview?id='.$model->id;
                            return $url;
                        }elseif ($action === 'update') {
                            $url ='publicupdate?id='.$model->id;
                            return $url;
                        }elseif ($action === 'delete') {
                            $url ='publicdelete?id='.$model->id;
                            return $url;
                        }elseif ($action === 'badge') {
                            $url ='badge?id='.$model->id;
                            return $url;
                        }
                    }

                ],
            ],
        ]); ?>
    </div>
</div>
