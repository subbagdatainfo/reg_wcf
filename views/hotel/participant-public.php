<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Hotel;
use yii\helpers\ArrayHelper;

//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HotelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Participant Hotels');
$this->params['breadcrumbs'][] = $this->title;

$data = ArrayHelper::map(Hotel::find()->all(), 'id', 'hotel_name');


?>
<div class="hotel-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'invitation_code',
            'full_name',
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
                        $participant_status = '<span class="label label-danger">Unsuccessful</span>';
                    }
                    return $participant_status;
                },
                'filter' => [2 => 'Success', 3 => 'Registered', 4 => 'Waiting List', 5 => 'Unsuccessful'],

            ],

            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute' =>'hotel_id', 
                'header'    => 'Hotel Name',
                'label'     => 'Hotel Name',
                'value' => function($model){
                    if(!empty($model->hotel_id)){
                        $hotel = $model->hotel->hotel_name;
                    }else{
                        $hotel = '-';
                    }

                    return $hotel;   
                },
                'options'   => ['class'=>'form-control', 'prompt'=>'Select Hotel...'],
                'editableOptions'=>[
                    'header'    => 'Hotel Name', 
                    'inputType' =>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data'      => $data,
                    
                ],
                'width'=>'100%',
                'pageSummary'=>true,
                
            ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
