<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SymposiumguestbookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<h3 class="text-center">Daftar List Symposium</h3>
<div class="symposiumguestbook-index">
    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],



                    [
                        'attribute' => 'symposium_id',
                        'label'     => 'Symposium Name',
                        'value'     => function($model){
                            if(!empty($model->symposium_id)){
                                $symposium = $model->symposium->symposium_name;
                            }else{
                                $symposium = '-';
                            }
                            return $symposium;
                        }
                    ],
                    [
                        'attribute' => 'participant_id',
                        'label'     => 'Full Name',
                        'value'     => function($model){
                            if(!empty($model->participant_id)){
                                $participant = $model->participant->full_name;
                            }else{
                                $participant = '-';
                            }
                            return $participant;
                        }
                    ]

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
