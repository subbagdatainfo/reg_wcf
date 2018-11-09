<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VarietypartisipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Variety participant';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="varietypartisipant-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="pull-right">
        <?= Html::a('Create Variety participant', ['create'], ['class' => 'btn btn-warning ']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'variety',
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

            [
                'attribute'         => 'group_participant_id',
                'value'             => 'group.group_name',
                'contentOptions'    =>['style'=>'width: 160px;']

            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
