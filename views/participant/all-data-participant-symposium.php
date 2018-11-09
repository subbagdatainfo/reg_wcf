<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use app\models\Varietypartisipant;
use app\models\Symposium;

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
            'variety.group.group_name',
            'variety.variety',
            [
                'attribute' => 'counter',
                'label'     => 'Attend',
                'format'    => 'html',
                'value'     => function($model){
                    if($model->counter >= 1){
                        $counter = 'Sudah Hadir';
                    }else{
                        $counter = 'Belum Hadir';
                    }
                    return $counter;
                },
            ],
            [
                'attribute' => 'symposium_day_one_id',
                'label'     => 'Symposium Day One',
                'value'     => function($model){
                    if(!empty($model->symposium_day_one_id)){
                            $symposium = $model->symposiumdayone->symposium_name;
                    }else{
                        $symposium = '-';
                    }
                    return $symposium;
                }

            ],
            [
                'attribute' => 'symposium_day_two_id',
                'label'     => 'Symposium Day Two',
                'value'     => function($model){
                  if(!empty($model->symposium_day_two_id)){
                            $symposium = $model->symposiumdaytwo->symposium_name;
                    }else{
                        $symposium = '-';
                    }
                    return $symposium;
                }
            ]
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
            'variety.group.group_name',
            [
                'attribute' => 'variety_id',
                'label'     => 'Variety Participant',
                'value'     => function($model){
                    if(!empty($model->variety_id)){
                            $variety_id = $model->variety->variety;
                    }else{
                        $variety_id = '-';
                    }
                    return $variety_id;
                },
                'filter' => Html::activeDropDownList($searchModel,'variety_id',Arrayhelper::map(Varietypartisipant::find()->AsArray()->all(), 'id', 'variety'),['class'  => 'form-control','prompt'  => '-- Select Variety Participant --']),

            ],
            [
                'attribute' => 'counter',
                'label'     => 'Attend',
                'format'    => 'html',
                'value'     => function($model){
                    if($model->counter >= 1){
                        $counter = '<span class="btn btn-info">Sudah Hadir</span>';
                    }else{
                        $counter = '<span class="btn btn-warning">Belum Hadir</span>';
                    }
                    return $counter;
                },
            ],
            [
                'attribute' => 'symposium_day_one_id',
                'label'     => 'Symposium Day One',
                'value'     => function($model){
                    if(!empty($model->symposium_day_one_id)){
                            $symposium = $model->symposiumdayone->symposium_name;
                    }else{
                        $symposium = '-';
                    }
                    return $symposium;
                },
                'filter' => Html::activeDropDownList($searchModel,'symposium_day_one_id',Arrayhelper::map(Symposium::find()->where(['what_day'  => 1])->asArray()->all(), 'id', 'symposium_name'),['class'  => 'form-control','prompt'  => '-- Select Symposium Day One --']),

            ],
            [
                'attribute' => 'symposium_day_two_id',
                'label'     => 'Symposium Day Two',
                'value'     => function($model){
                  if(!empty($model->symposium_day_two_id)){
                            $symposium = $model->symposiumdaytwo->symposium_name;
                    }else{
                        $symposium = '-';
                    }
                    return $symposium;
                },
                'filter' => Html::activeDropDownList($searchModel,'symposium_day_two_id',Arrayhelper::map(Symposium::find()->where(['what_day'  => 2])->asArray()->all(), 'id', 'symposium_name'),['class'  => 'form-control','prompt'  => '-- Select Symposium Day Two --']),
            ]
            /*'invitation_code',
            'token',*/
            /*[
                'attribute' => 'attend_id',
                'value'     =>  function($model){
                    if($model->attend_id){
                        return $model->attends->information;
                    }else{
                        return "-";
                    }
                },
                'contentOptions'=>['style'=>'width: 50px;']
            ],*/
            // 'attends.information',
            /*[

                    'attribute' => 'variety_id',
                    'label'     => 'Variety Participant',
                    'value'     => 'variety.variety',
                    'filter' => Html::activeDropDownList($searchModel,'variety_id',Arrayhelper::map(Varietypartisipant::find()->asArray()->all(), 'id', 'variety'),['class'  => 'form-control','prompt'  => '-- Select Variety Participant --']),
            ],*/
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

            // ['class' => 'yii\grid\ActionColumn'],
            //['class' => yii\grid\ActionColumn::className(),'template'=>'{view}' ],
            /*'counter',
            [  
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => 'width:60px;'],
                    'header'=>'Actions',
                    'template' => '{badge} {view}',
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
                            $url ='/web/participant/view?id='.$model->id;
                            return $url;
                        }elseif ($action === 'update') {
                            $url ='publicupdate?id='.$model->id;
                            return $url;
                        }elseif ($action === 'delete') {
                            $url ='publicdelete?id='.$model->id;
                            return $url;
                        }elseif ($action === 'badge') {
                            $url ='/web/participant/badge?id='.$model->id;
                            return $url;
                        }
                    }

                ],*/
        ],
    ]); ?>
</div>
