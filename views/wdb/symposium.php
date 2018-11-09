<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Symposium';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-index">

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
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:260px;'],
                'header'=>'Actions',
                'template' => '{view} {update} {delete} {update-invitation}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>', $url, [
                            'title' => Yii::t('app', 'View'),                               
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', $url, [
                            'title' => Yii::t('app', 'Update'),                               
                        ]);
                    },

                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true" onclick="return confirm("are you sure?")></span>', $url, [
                            'title' => Yii::t('app', 'Delete'),
                            'onclick'   => 'return confirm("Are you sure want to Delete this data ?")',                             
                        ]);
                    },
                    'update-invitation' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary btn-xs" aria-hidden="true"> Update Invitation</span>', $url, [
                            'title' => Yii::t('app', 'Update Symposium'), 
                           
                        ]);
                    },

                ],

                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url ='symposiumview?id='.$model->id;
                        return $url;
                    }elseif ($action === 'update') {
                        $url ='symposiumupdate?id='.$model->id;
                        return $url;
                    }elseif ($action === 'delete') {
                        $url ='symposiumdelete?id='.$model->id;
                        return $url;
                    }elseif ($action === 'update-invitation') {
                        $url ='symposiumupdateinvitation?id='.$model->id;
                        return $url;
                    }
                }

            ],
        ],
    ]); ?>
</div>
