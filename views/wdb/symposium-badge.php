<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

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
            [

                'attribute' => 'variety_id',
                'label'     => 'Variety Participant',
                'value'     => function($model){
                    if(!empty($model->variety_id)){
                        $variety = $model->variety->variety;
                    }else{
                        $variety = 'Variety Tidak Tersedia';
                    }
                    return $variety;
                }
            ],
            /*[
                'class'=>'kartik\grid\EditableColumn',
                'attribute' =>'name_on_badge', 
                'header'    => 'Name On Badge',
                'value'     => 'name_on_badge',
                'options'   => ['class'=>'form-control', 'prompt'=>'Select Hotel...'],
                'editableOptions'=>[
                    'header'    => 'Name On Badge', 
                    'inputType' =>\kartik\editable\Editable::INPUT_TEXT,
                    
                ],
                'width'=>'100%',
                'pageSummary'=>true,
                
            ],*/
            /*[  
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:260px;'],
                'header'=>'Actions',
                'template' => '{badge}',
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

            ],*/
            'counter',
            [  
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => 'width:60px;'],
                    'header'=>'Actions',
                    'template' => '{badge}',
                    'buttons' => [
                        /*'view' => function ($url, $model) {
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
                        },*/
                        'badge' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>', $url, [
                                'title' => Yii::t('app', 'Badge'), 'target' => '_blank'
                            ]);
                        },
                    ],

                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'badge') {
                            $url ='badge?id='.$model->id;
                            return $url;
                        }/*elseif ($action === 'update') {
                            $url ='publicupdate?id='.$model->id;
                            return $url;
                        }elseif ($action === 'delete') {
                            $url ='publicdelete?id='.$model->id;
                            return $url;
                        }elseif ($action === 'vie') {
                            $url ='publicview?id='.$model->id;
                            return $url;
                        }*/
                    }

                ],
        ],
    ]); ?>
</div>
