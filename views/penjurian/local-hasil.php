<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Selection Local Public Participant';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
.kv-editable-link{
    padding: 0px 10px 10px 10px;
}
.input-group
.form-control{
    padding: 6px 6px;
    margin-bottom: 0px;
}
</style>
<div class="participant-index" style="margin-top:100px;">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
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
            ],
            /*[
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
            ],*/
            'invitation_code',
            'full_name',
            // 'organization',
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'nilai_ps', 
                'header' => 'Personal State',
                'editableOptions'=>[
                    'header'=>'Personal State Rating', 
                    'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                    'options'=>[
                        'pluginOptions'=>['min'=>0, 'max'=>10]
                    ]
                ],
                'hAlign'=>'center', 
                'vAlign'=>'middle',
                'width'=>'7%',
                'pageSummary'=>true
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'nilai_mo', 
                'header' => 'Motivation',
                'editableOptions'=>[
                    'header'=>'Motivation Rating', 
                    'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                    'options'=>[
                        'pluginOptions'=>['min'=>0, 'max'=>10]
                    ]
                ],
                'hAlign'=>'center', 
                'vAlign'=>'middle',
                'width'=>'7%',
                'pageSummary'=>true
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'nilai_eb', 
                'header' => 'Essay1',
                'editableOptions'=>[
                    'header'=>'Essay 1 Rating', 
                    'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                    'options'=>[
                        'pluginOptions'=>['min'=>0, 'max'=>10]
                    ]
                ],
                'hAlign'=>'center', 
                'vAlign'=>'middle',
                'width'=>'7%',
                'pageSummary'=>true
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'nilai_ek',
                'header' => 'Essay2',
                'editableOptions'=>[
                    'header'=>'Essay 2 Rating', 
                    'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                    'options'=>[
                        'pluginOptions'=>['min'=>0, 'max'=>30]
                    ]
                ],
                'hAlign'=>'center', 
                'vAlign'=>'middle',
                'width'=>'7%',
                'pageSummary'=>true
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'nilai_eo', 
                'header' => 'Essay3',
                'editableOptions'=>[
                    'header'=>'Essay 3 Rating', 
                    'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                    'options'=>[
                        'pluginOptions'=>['min'=>0, 'max'=>30]
                    ]
                ],
                'hAlign'=>'center', 
                'vAlign'=>'middle',
                'width'=>'7%',
                'pageSummary'=>true
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'nilai_cv', 
                'header' => 'CV',
                'editableOptions'=>[
                    'header'=>'Curriculum Vitae Rating', 
                    'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                    'options'=>[
                        'pluginOptions'=>['min'=>0, 'max'=>5]
                    ]
                ],
                'hAlign'=>'center', 
                'vAlign'=>'middle',
                'width'=>'7%',
                'pageSummary'=>true
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'nilai_rl', 
                'header' => 'Recomendation',
                'editableOptions'=>[
                    'header'=>'Recomendation Letter Rating', 
                    'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                    'options'=>[
                        'pluginOptions'=>['min'=>0, 'max'=>5]
                    ]
                ],
                'hAlign'=>'center', 
                'vAlign'=>'middle',
                'width'=>'7%',
                'pageSummary'=>true
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
                'attribute' => 'participant_status',
                'format' => 'Html',
                'value' => function($model){
                    if($model->participant_status == 2){
                        $participant_status = '<span class="label label-success">Success</span>';
                    }elseif($model->participant_status == 3){
                        $participant_status = '<span class="label label-info">Registered</span>';
                    }elseif($model->participant_status == 4){
                        $participant_status = '<span class="label label-danger">Waiting List</span>';
                    }elseif($model->participant_status == 5){
                        $participant_status = '<span class="label label-danger">Unsuccessful</span>';
                    }
                    return $participant_status;
                },
                'filter' => [2 => 'Success', 3 => 'Registered', 4 => 'Waiting List', 5 => 'Unsuccessful'],
            ],*/
            // 'invitation_code',
            // 'token',
            // 'user_photo',
            // 'name_on_badge',
            // 'address',
            // 'gender',
            // 'date_of_birth',
            // 'country_id',
            // 'nation.country_name',
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
            /*[  
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:100px;'],
                'header'=>'Actions',
                'template' => '{view} {success} {unsuccess}',
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
