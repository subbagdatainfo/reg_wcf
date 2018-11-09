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
