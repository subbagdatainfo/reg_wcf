<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quota';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'         => 'Category',
                'attribute'     => 'variety',
                'contentOptions'=>['style'=>'width: 350px;']

            ],
            [
                'attribute' => 'format_invitation_code',
                'contentOptions'=>['style'=>'width: 100px;']

            ],
            [
                'attribute' => 'quota',
                'contentOptions'=>['style'=>'width: 40px;']

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
