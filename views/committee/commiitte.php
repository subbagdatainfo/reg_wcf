<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use app\models\Varietypartisipant;
use app\models\Groupvarietyparticipant;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Public';
$this->params['breadcrumbs'][] = $this->title;

$group_variety = Groupvarietyparticipant::find()->select('id')->where(['id' => 4])->asArray()->Column();
?>
<div class="participant-index">
    <div class="container">
        <?php
            $gridColumns = [
                
                [
                    'attribute' => 'full_name',
                    'value'     =>  'full_name',
                    'contentOptions'=>['style'=>'width: 100px;']
                ],
                [
                    'attribute' => 'invitation_code',
                    'value'     =>  'invitation_code',
                    'contentOptions'=>['style'=>'width: 100px;']
                ],
                [
                    'attribute' => 'token',
                    'value'     =>  'token',
                    'contentOptions'=>['style'=>'width: 100px;']
                ],

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
                ['class' => 'yii\grid\SerialColumn','contentOptions'=>['style'=>'width: 10px;']],

                // 'id',
                // 'full_name',
                // 'invitation_code',
                // 'token',
                [
                    'attribute' => 'full_name',
                    'value'     =>  'full_name',
                    //'contentOptions'=>['style'=>'width: 100px;']
                ],
                [
                    'attribute' => 'invitation_code',
                    'value'     =>  'invitation_code',
                    //'contentOptions'=>['style'=>'width: 100px;']
                ],
                [
                    'attribute' => 'token',
                    'value'     =>  'token',
                    //'contentOptions'=>['style'=>'width: 100px;']
                ],
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

                    'attribute' => 'variety_id',
                    'label'     => 'Variety Participant',
                    'value'     => 'variety.variety',
                    'filter' => Html::activeDropDownList($searchModel,'variety_id',Arrayhelper::map(Varietypartisipant::find()->where(['group_participant_id' => $group_variety])->asArray()->all(), 'id', 'variety'),['class'  => 'form-control','prompt'  => '-- Select Variety Participant --']),
                ],
                'counter',
                [  
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => 'width:60px;'],
                    'header'=>'Actions',
                    'template' => '{badge}',
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
