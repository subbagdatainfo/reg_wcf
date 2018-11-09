<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RepresentativeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Representatives Request';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="representative-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'full_name',
            'name',
            // 'organization',
            // 'position',
            // 'assignment_letter',
            // 'title',
            
            // 'room_type',
            // 'attend',
            // 'speaker:boolean',
            // 'approval:boolean',
            [
                'attribute' => 'approval',
                'format'=>'raw',
                'value'=> function ($model) {
                    // return $model->approval;
                    if($model->approval == FALSE){
                        return '<div class="alert alert-danger" role="alert">Not Approved</div>';
                    } elseif ($model->approval == TRUE) {
                        return '<div class="alert alert-success" role="alert">Approved</div>';
                    }
                },
            ],
            // 'id_category_participant',

            // ['class' => 'yii\grid\ActionColumn'],
            [  
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>', $url, [
                            'title' => Yii::t('app', 'View')                                 
                        ]);
                    },
                ],

                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url ='view?id='.$model->id;
                        return $url;
                    }
                }

            ],
        ],
    ]); ?>
</div>
