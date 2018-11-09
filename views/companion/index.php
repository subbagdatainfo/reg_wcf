<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-index">

    <?= Html::a('Add Companion', ['create'], ['class' => 'btn btn-warning']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            [
                'attribute' => 'is_companion_valid',
                'format' => 'html',
                'value' =>  function($model){
                    if($model->is_companion_valid == TRUE){
                        $title = '<center><span class="label label-success">Approved</span></center>';
                    }else{
                        $title = '<center><span class="label label-danger">Waiting for confirmation</span></center>';
                    }
                    return $title;
                },
                'contentOptions'=>['style'=>'width: 100px;']
            ],
            // ['class' => 'yii\grid\ActionColumn'],
            [  
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:100px;'],
                'header'=>'Actions',
                'template' => '{update-biodata}{ticket}',
                'buttons' => [
                    'update-biodata' => function ($url, $model) {
                        if ($model->is_companion_valid == TRUE) {
                            return Html::a('<center><span class="btn btn-primary btn-xs" aria-hidden="true">Registration Data</span></center>', $url, [
                                'title' => Yii::t('app', 'Update Registration Data'), 
                            ]);
                        }
                    },
                    'ticket' => function ($url, $model) {
                        if ($model->submit == TRUE) {
                            return Html::a('<center><span class="btn btn-warning btn-xs" aria-hidden="true">Print Ticket</span></center>', $url, [
                                'title' => Yii::t('app', 'Print Ticket'), 
                            ]);
                        }
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update-biodata') {
                        $url ='update?id='.$model->id;
                        return $url;
                    }elseif ($action === 'ticket') {
                        $url ='ticket?id='.$model->id;
                        return $url;
                    }
                }

            ],
        ],
    ]); ?>
</div>