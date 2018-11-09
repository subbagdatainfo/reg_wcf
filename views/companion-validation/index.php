<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companions Validation';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
            [
                'attribute' => 'title',
                'value'     =>  function($model){
                    if($model->title == 1){
                        $title = "Mr";
                    }else{
                        $title = "Ms";
                    }
                    return $title;
                },
                'contentOptions'=>['style'=>'width: 50px;']
            ],
            'full_name',
            'variety.variety'
            // 'invitation_code',
            // 'token',
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
            // 'file_presentation',
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
            // 'attend_id',
            // 'is_delete:boolean',
            // 'invitation_sent:boolean',
            // 'provinsi_id',
            // 'user_id',
            // 'handphone',
            // 'tell_us:ntext',
            // 'candidate_chosen:ntext',
            // 'essay',
            // 'tittle',
            // 'author',
            // 'content:ntext',
            // 'room_type_id',
            // 'room_type_approve:boolean',
            // 'transportation',
            // 'ktp_pasport',
            // 'submit:boolean',
            // 'is_representative:boolean',
            // 'dietary_specify',
            // 'is_companion:boolean',
            // 'is_companion_valid:boolean',
            // 'is_companion_from',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
