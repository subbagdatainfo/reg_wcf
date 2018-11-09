<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SymposiumguestbookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<h3 class="text-center">List Opening Ceremony Participant</h3>
<div class="symposiumguestbook-index">
    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'id_particpant',
                        'label'     => 'Full Name',
                        'value'     => function($model){
                            if(!empty($model->id_particpant)){
                                $participant = $model->particpant->full_name;
                            }else{
                                $participant = '-';
                            }
                            return $participant;
                        }
                    ]
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>