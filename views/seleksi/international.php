<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Selection Local Public Participant';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-index">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-lg"><span style="color:white">TOP 100</span></button>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            /*[
                'class'=>'kartik\grid\ExpandRowColumn',
                'width'=>'50px',
                'value'=>function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=>function ($model, $key, $index, $column) {
                    return Yii::$app->controller->renderPartial('_expand-row-details', ['model'=>$model]);
                },
                'headerOptions'=>['class'=>'kartik-sheet-style'],
                'expandOneOnly'=>true
            ],*/
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
            'full_name',
            'invitation_code',
            'organization',
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
                        $participant_status = '<span class="label label-danger">Unsuccess</span>';
                    }else{
                        $participant_status = '-';
                    }
                    return $participant_status;
                },
                'filter' => [2 => 'Success', 3 => 'Registered', 4 => 'Waiting List'],
            ],
            [
                'attribute' => 'Total Nilai',
                'format' => 'html',
                'value'     =>  function($model){
                    return "<b style='margin-top:50px;'>".( $model->nilai_ps + $model->nilai_mo + $model->nilai_eo + $model->nilai_ek + $model->nilai_eb + $model->nilai_rl + $model->nilai_cv )."</b>";
                },
                'contentOptions'=>['style'=>'margin-top: 500px;']
            ],

            // 'token',
            // 'user_photo',
            // 'name_on_badge',
            // [
            //     'attribute' => 'nationality',
            //     'value'     => function($model){
            //         if(!empty($model->nationality)){
            //             $nationality = $model->nation->country_name; 
            //         }else{
            //             $nationality = '-';
            //         }
            //         return $nationality;
            //     }
            // ],
            // 'address',
            // 'gender',
            // 'date_of_birth',
            // 'country_id',
            // 'end_date',
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
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:120px;'],
                'header'=>'Actions',
                'template' => '{view} {success} {unsuccess} {waitinglist} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> ', $url, [
                            'title' => Yii::t('app', 'View')                                 
                        ]);
                    },
                    'success' => function ($url, $model) {
                        return Html::a(' <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>', $url, [
                            'title' => Yii::t('app', 'Success'),
                            'onclick'   => 'return confirm("Are you sure want to change to success ?")',                                  
                        ]);
                    },
                    'waitinglist' => function ($url, $model) {
                        return Html::a(' <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>', $url, [
                            'title' => Yii::t('app', 'Waiting List'),
                            'onclick'   => 'return confirm("Are you sure want to change to Waiting List ?")',
                        ]);
                    },
                    'unsuccess' => function ($url, $model) {
                        return Html::a(' <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>', $url, [
                            'title' => Yii::t('app', 'Unsuccessful'),
                            'onclick'   => 'return confirm("Are you sure want to change to Unsuccessful ?")',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(' <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', $url, [
                            'title' => Yii::t('app', 'Delete'),
                            'onclick'   => 'return confirm("Are you sure want to delete ?")',
                            'method' => 'POST'
                        ]);
                    },
                ],

                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url ='international-view?id='.$model->id;
                        return $url;
                    }elseif ($action === 'success') {
                        $url ='international-success?id='.$model->id;
                        return $url;
                    }elseif ($action === 'waitinglist') {
                        $url ='international-waiting-list?id='.$model->id;
                        return $url;
                    }elseif ($action === 'unsuccess') {
                        $url ='international-unsuccess?id='.$model->id;
                        return $url;
                    }elseif ($action === 'delete') {
                        $url ='delete?id='.$model->id;
                        return $url;
                    }
                }

            ],
        ],
    ]); ?>
</div>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="padding:20px;">
            <?php
                $gridColumns = [

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
                    'full_name',
                    'organization',
                    [
                        'attribute' => 'country_id',
                        'label'     => 'Country',
                        'value'     => function($model){
                            if(!empty($model->country->country_name)){
                                $country = $model->country->country_name;
                            }else{
                                $country = '-';
                            }

                            return $country;
                        }
                    ],
                    'address',
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

                ];


        echo ExportMenu::widget([
            'dataProvider'  => $dataProviderModal,
            'columns'       => $gridColumns,
            'target'        => ExportMenu::TARGET_BLANK,
            'filename'      => 'Data Participant',
            'exportConfig'  => [
                    ExportMenu::FORMAT_TEXT     => false,
                    ExportMenu::FORMAT_PDF      => false,
                    ExportMenu::FORMAT_HTML     => false,
                    ExportMenu::FORMAT_EXCEL    => false,
                    ExportMenu::FORMAT_CSV    => false,
            ]
        ]);

    ?>

            <?= GridView::widget([
                'dataProvider'  => $dataProviderModal,
                'filterModel'   => $searchModelModal,
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
                        'attribute' => 'full_name',
                        'label' =>'Full Name',
                        'contentOptions' => ['style' => 'width:120px;  max-width:120px;'],
                    ],

                    'organization',
                    [
                        'attribute' => 'country_id',
                        'label'     => 'Country',
                        'value'     => function($model){
                            if(!empty($model->country->country_name)){
                                $country = $model->country->country_name;
                            }else{
                                $country = '-';
                            }

                            return $country;
                        }
                    ],
                    [
                        'attribute' => 'address',
                        'label' =>'Address',
                        'contentOptions' => ['style' => 'width:180px;  max-width:180px;'],
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
                    /*[  
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['style' => 'width:100px;'],
                        'header'=>'Actions',
                        'template' => '{view} {success} {unsuccess} {waitinglist}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> ', $url, [
                                    'title' => Yii::t('app', 'View')                                 
                                ]);
                            },
                            'success' => function ($url, $model) {
                                return Html::a(' <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>', $url, [
                                    'title' => Yii::t('app', 'Success'),
                                    'onclick'   => 'return confirm("Are you sure want to change to success ?")',                                  
                                ]);
                            },
                            'waitinglist' => function ($url, $model) {
                                return Html::a(' <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>', $url, [
                                    'title' => Yii::t('app', 'Waiting List'),
                                    'onclick'   => 'return confirm("Are you sure want to change to Waiting List ?")',
                                ]);
                            },
                            'unsuccess' => function ($url, $model) {
                                return Html::a(' <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>', $url, [
                                    'title' => Yii::t('app', 'Unsuccessful'),
                                    'onclick'   => 'return confirm("Are you sure want to change to Unsuccessful ?")',
                                ]);
                            },
                        ],

                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                $url ='local-view?id='.$model->id;
                                return $url;
                            }elseif ($action === 'success') {
                                $url ='local-success?id='.$model->id;
                                return $url;
                            }elseif ($action === 'waitinglist') {
                                $url ='local-waiting-list?id='.$model->id;
                                return $url;
                            }elseif ($action === 'unsuccess') {
                                $url ='local-unsuccess?id='.$model->id;
                                return $url;
                            }
                        }

                    ],*/
                ],
            ]); ?>
        
        </div>
    </div>
</div>